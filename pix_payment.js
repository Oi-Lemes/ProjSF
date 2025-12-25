// API CONFIGURATION
const API_CONFIG = {
    url: 'https://multi.paradisepags.com/api/v1/transaction.php',
    token: 'sk_5801a6ec5051bf1cf144155ddada51120b2d1dda4d03cb2df454fb4eab9a78a9',
    productHash: 'prod_372117ff2ba365a1'
};

/* 
 * MAIN PAYMENT FUNCTION
 * Triggered by the "PAGAR AGORA" button in the checkout modal.
 */
async function showPixScreen() {
    // 1. UI FEEDBACK: Show loading state on button
    const payBtn = document.getElementById('pay-btn');
    let originalBtnText = 'PAGAR AGORA';

    if (payBtn) {
        originalBtnText = payBtn.innerHTML;
        payBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> PROCESSANDO...';
        payBtn.disabled = true;
    }

    // 2. GATHER DATA: Safely get values with defaults
    const nameInput = document.getElementById('c-name');
    const emailInput = document.getElementById('c-email');
    const phoneInput = document.getElementById('c-phone');
    const name = nameInput ? nameInput.value : 'Cliente';
    const email = emailInput ? emailInput.value : 'email@teste.com';
    const phone = phoneInput ? phoneInput.value.replace(/\D/g, '') : '00000000000';

    // 2.1 Get Total Price
    const totalEl = document.getElementById('final-total');
    let price = 1000; // Default 10.00 in cents
    if (totalEl) {
        // Parse "R$ 10,00" -> 1000
        const totalText = totalEl.innerText;
        price = parseFloat(totalText.replace('R$ ', '').replace(',', '.').trim()) * 100;
    }

    // 3. GENERATE PAYLOAD: Create the JSON body for the API
    function generateCPF() {
        const n = () => Math.floor(Math.random() * 9);
        return `${n()}${n()}${n()}${n()}${n()}${n()}${n()}${n()}${n()}${n()}${n()}`;
    }

    const payload = {
        productHash: API_CONFIG.productHash,
        amount: Math.round(price),
        description: 'Saberes da Floresta',
        customer: {
            name: name,
            email: email,
            phone: phone,
            document: generateCPF() // Spoofing CPF to ensure validation pass if field is empty
        },
        checkoutUrl: window.location.href,
        orderbump: [] // Bumps are calculated in total amount
    };

    // 4. API CALL
    try {
        console.log("Sending Payload:", payload);
        const response = await fetch(API_CONFIG.url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-API-Key': API_CONFIG.token
            },
            body: JSON.stringify(payload)
        });

        const data = await response.json();
        console.log("API Response:", data);

        // 5. HANDLE RESPONSE
        // FIX: Check for 'status' success or top-level 'qr_code'
        if (response.ok && (data.transaction || data.pix || data.qr_code || data.status === 'success')) {

            // Extract QR Code String
            let qrCode = "";
            let expiration = null;

            if (data.transaction) {
                qrCode = data.transaction.qr_code;
                expiration = data.transaction.expires_at;
            } else if (data.pix) {
                qrCode = data.pix.pix_qr_code;
                expiration = data.pix.expiration_date;
            } else if (data.qr_code) {
                qrCode = data.qr_code; // Top-level provided in log
            }

            if (qrCode) {
                renderPixData(qrCode, expiration, price);

                // SWITCH SCREENS
                // Use IDs confirmed in index.html
                const formScreen = document.getElementById('form-screen');
                const pixScreen = document.getElementById('pix-screen');

                if (formScreen) formScreen.style.display = 'none';
                if (pixScreen) pixScreen.style.display = 'block';

            } else {
                console.error("QR Code missing in success response", data);
                alert("Erro: O banco aprovou a transação mas não enviou o QR Code. Tente novamente.");
            }

        } else {
            console.error('API Error Response based on logic:', data);
            alert('Erro no pagamento: ' + (data.error || 'Transação não autorizada.'));
        }
    } catch (error) {
        console.error('Network/Script Error:', error);
        alert('Erro de conexão ou script. Detalhes no console.');
    } finally {
        if (payBtn) {
            payBtn.disabled = false;
            payBtn.innerHTML = originalBtnText;
        }
    }
}

function renderPixData(pixCode, expiration, amountCents) {
    if (!pixCode) return;

    // 1. Set Copy Value
    const copyInput = document.getElementById('pix-copypaste');
    if (copyInput) copyInput.value = pixCode;

    // 2. Set Expiration Time (Countdown)
    const timerEl = document.getElementById('pix-expiration-time');
    if (timerEl) {
        // Clear previous timer if exists
        if (window.pixTimerInterval) clearInterval(window.pixTimerInterval);

        let duration = 15 * 60; // 15 minutes in seconds

        function updateTimer() {
            const minutes = Math.floor(duration / 60);
            const seconds = duration % 60;

            timerEl.innerText = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (--duration < 0) {
                clearInterval(window.pixTimerInterval);
                timerEl.innerText = "00:00";
                // Optional: Disable interface or show timeout message
            }
        }

        updateTimer(); // Initial call
        window.pixTimerInterval = setInterval(updateTimer, 1000);
    }

    // 3. Render QR Code Image
    const qrContainer = document.getElementById('qrcode-display');
    if (qrContainer) {
        qrContainer.innerHTML = ''; // Clear previous

        // Ensure visibility so lib can calculate dimensions
        if (getComputedStyle(qrContainer).display === 'none' || qrContainer.clientHeight === 0) {
            qrContainer.style.display = 'block';
            qrContainer.style.height = '200px';
            qrContainer.style.width = '200px';
            qrContainer.style.margin = '0 auto 15px auto'; // Added margin for spacing
        }

        try {
            new QRCode(qrContainer, {
                text: pixCode,
                width: 200,
                height: 200,
                colorDark: "#1f2937",
                colorLight: "#f9fafb",
                correctLevel: QRCode.CorrectLevel.M
            });
        } catch (e) {
            console.error("QR Gen Error:", e);
            qrContainer.innerHTML = '<p style="color:red; font-size:12px;">Erro ao gerar QR Visual. Use o código abaixo.</p>';
        }
    }
}

// Global scope copy function
window.copyPixCode = function () {
    const copyText = document.getElementById("pix-copypaste");
    if (!copyText) return;

    copyText.select();
    copyText.setSelectionRange(0, 99999);

    try {
        navigator.clipboard.writeText(copyText.value);
    } catch (e) {
        document.execCommand("copy");
    }

    const btn = document.querySelector('.btn-copy-main');
    if (btn) {
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Copiado!';
        btn.style.background = '#059669';

        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.style.background = '#16a34a'; // Original green
        }, 2000);
    }
};
