// Função para scroll suave até os planos
function scrollToPlans() {
    document.getElementById('plans').scrollIntoView({
        behavior: 'smooth'
    });
}

// Função para toggle do FAQ
function toggleFaq(element) {
    const faqItem = element.parentElement;
    const isActive = faqItem.classList.contains('active');

    // Fecha todos os outros FAQs
    document.querySelectorAll('.faq-item').forEach(item => {
        item.classList.remove('active');
    });

    // Se não estava ativo, ativa este
    if (!isActive) {
        faqItem.classList.add('active');
    }
}

// Contador regressivo dos planos - inicia em 1:35:33
function startPlansCountdown() {
    // Define o tempo inicial: 1 hora, 35 minutos e 33 segundos
    const initialTime = (1 * 60 * 60) + (35 * 60) + 33; // em segundos
    const now = new Date().getTime();
    const countdownTime = now + (initialTime * 1000);

    const timer = setInterval(function () {
        const now = new Date().getTime();
        const distance = countdownTime - now;

        // Calcula horas, minutos e segundos
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Atualiza o display dos planos
        const plansHours = document.getElementById('plans-hours');
        const plansMinutes = document.getElementById('plans-minutes');
        const plansSeconds = document.getElementById('plans-seconds');

        if (plansHours && plansMinutes && plansSeconds) {
            plansHours.textContent = hours.toString().padStart(2, '0');
            plansMinutes.textContent = minutes.toString().padStart(2, '0');
            plansSeconds.textContent = seconds.toString().padStart(2, '0');
        }

        // Se o contador chegou a zero, para o timer
        if (distance < 0) {
            clearInterval(timer);
            if (plansHours && plansMinutes && plansSeconds) {
                plansHours.textContent = '00';
                plansMinutes.textContent = '00';
                plansSeconds.textContent = '00';
            }
        }
    }, 1000);
}

// Contador regressivo do final da página
function startCountdown() {
    // Define 24 horas a partir de agora
    const now = new Date().getTime();
    const countdownTime = now + (24 * 60 * 60 * 1000);

    const timer = setInterval(function () {
        const now = new Date().getTime();
        const distance = countdownTime - now;

        // Calcula horas, minutos e segundos
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Atualiza o display do final da página
        const finalHours = document.getElementById('hours');
        const finalMinutes = document.getElementById('minutes');
        const finalSeconds = document.getElementById('seconds');

        if (finalHours && finalMinutes && finalSeconds) {
            finalHours.textContent = hours.toString().padStart(2, '0');
            finalMinutes.textContent = minutes.toString().padStart(2, '0');
            finalSeconds.textContent = seconds.toString().padStart(2, '0');
        }

        // Se o contador chegou a zero, para o timer
        if (distance < 0) {
            clearInterval(timer);
            if (finalHours && finalMinutes && finalSeconds) {
                finalHours.textContent = '00';
                finalMinutes.textContent = '00';
                finalSeconds.textContent = '00';
            }
        }
    }, 1000);
}

// Animações de entrada quando o elemento fica visível
function animateOnScroll() {
    const elements = document.querySelectorAll('.benefit-card, .exclusive-card, .bonus-card, .testimonial-card, .plan-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-on-scroll', 'visible');
            }
        });
    }, {
        threshold: 0.1
    });

    elements.forEach(element => {
        element.classList.add('animate-on-scroll');
        observer.observe(element);
    });
}

// Efeito de parallax suave no hero
function parallaxEffect() {
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero');
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });
}

// Adiciona efeito de click nos botões de plano
function addPlanButtonEffects() {
    const planButtons = document.querySelectorAll('.plan-button');

    planButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            if (this.classList.contains('basic-button') || this.getAttribute('href') === '#') {
                e.preventDefault();
            }

            // Check if checkout modal is open
            if (typeof isCheckoutOpen !== 'undefined' && isCheckoutOpen) {
                return;
            }

            // Cria efeito de ripple
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;

            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255,255,255,0.5)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.pointerEvents = 'none';

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            // Remove o efeito após a animação
            setTimeout(() => {
                ripple.remove();
            }, 600);

            // Se for botão básico, mostra o pop-up de upgrade
            if (this.classList.contains('basic-button')) {
                setTimeout(() => {
                    showUpgradePopup();
                }, 400);
            }
        });
    });
}

// Adiciona CSS para animação do ripple
function addRippleAnimation() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}

// Efeito de digitação no hero title
function typewriterEffect() {
    const title = document.querySelector('.hero-title');
    if (title) {
        const text = title.textContent;
        title.textContent = '';
        title.style.borderRight = '2px solid white';

        let i = 0;
        const timer = setInterval(() => {
            title.textContent += text.charAt(i);
            i++;

            if (i === text.length) {
                clearInterval(timer);
                setTimeout(() => {
                    title.style.borderRight = 'none';
                }, 1000);
            }
        }, 100);
    }
}

// Smooth scroll para links internos
function setupSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Adiciona contadores animados para estatísticas
function animateCounters() {
    const counters = document.querySelectorAll('.stat strong');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const text = counter.textContent;
                const number = parseInt(text.replace(/\D/g, ''));

                if (number > 0) {
                    let current = 0;
                    const increment = number / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= number) {
                            counter.textContent = text;
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(current) + (text.includes('+') ? '+' : '');
                        }
                    }, 30);
                }

                observer.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        observer.observe(counter);
    });
}

// Adiciona efeito de hover nos cards
function addCardHoverEffects() {
    const cards = document.querySelectorAll('.benefit-card, .exclusive-card, .bonus-card, .testimonial-card, .plan-card');

    cards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.boxShadow = '0 15px 35px rgba(0,0,0,0.2)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 5px 20px rgba(0,0,0,0.1)';
        });
    });
}

// Função para adicionar partículas de fundo (opcional)
function addBackgroundParticles() {
    const hero = document.querySelector('.hero');
    if (hero) {
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.style.position = 'absolute';
            particle.style.width = '4px';
            particle.style.height = '4px';
            particle.style.background = 'rgba(255,255,255,0.1)';
            particle.style.borderRadius = '50%';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animation = `float ${3 + Math.random() * 4}s ease-in-out infinite`;
            particle.style.animationDelay = Math.random() * 2 + 's';
            hero.appendChild(particle);
        }

        // Adiciona CSS para animação das partículas
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(180deg); }
            }
        `;
        document.head.appendChild(style);
    }
}

// Função para lazy loading de imagens (se houver)
function setupLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');

    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// Função para salvar preferências do usuário (localStorage)
function saveUserPreferences() {
    // Salva qual plano o usuário visualizou mais tempo
    const plans = document.querySelectorAll('.plan-card');

    plans.forEach((plan, index) => {
        plan.addEventListener('mouseenter', () => {
            localStorage.setItem('lastViewedPlan', index);
        });
    });
}

// Função para definir a data atual no banner
function setCurrentDate() {
    const dateElement = document.getElementById('current-date');
    if (dateElement) {
        const now = new Date();
        const day = now.getDate().toString().padStart(2, '0');
        const month = (now.getMonth() + 1).toString().padStart(2, '0');
        const year = now.getFullYear();
        dateElement.textContent = `${day}/${month}/${year}`;
    }
}

// Função principal que inicializa tudo
function initializeApp() {
    // Espera o DOM carregar completamente
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeApp);
        return;
    }

    // Define a data atual no banner
    setCurrentDate();

    // Inicializa todas as funcionalidades
    startCountdown();
    animateOnScroll();
    // parallaxEffect(); // Comentado para melhor performance em dispositivos móveis
    addPlanButtonEffects();
    addRippleAnimation();
    // typewriterEffect(); // Comentado para não interferir com SEO
    setupSmoothScroll();
    animateCounters();
    addCardHoverEffects();
    // addBackgroundParticles(); // Comentado para melhor performance
    setupLazyLoading();
    saveUserPreferences();

    // Adiciona classes para animações CSS
    document.body.classList.add('loaded');

    // Analytics de eventos (simulado)
    console.log('Página de vendas carregada com sucesso');

    // Simula tracking de eventos importantes
    trackEvents();
}

// Função para tracking de eventos (simulado)
function trackEvents() {
    // Track scroll depth
    let maxScroll = 0;
    window.addEventListener('scroll', () => {
        const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
        if (scrollPercent > maxScroll) {
            maxScroll = scrollPercent;

            // Marcos importantes de scroll
            if (maxScroll > 25 && !localStorage.getItem('scroll_25')) {
                console.log('Usuário scrollou 25% da página');
                localStorage.setItem('scroll_25', 'true');
            }
            if (maxScroll > 50 && !localStorage.getItem('scroll_50')) {
                console.log('Usuário scrollou 50% da página');
                localStorage.setItem('scroll_50', 'true');
            }
            if (maxScroll > 75 && !localStorage.getItem('scroll_75')) {
                console.log('Usuário scrollou 75% da página');
                localStorage.setItem('scroll_75', 'true');
            }
        }
    });

    // Track time on page
    const startTime = Date.now();
    window.addEventListener('beforeunload', () => {
        const timeSpent = Math.round((Date.now() - startTime) / 1000);
        console.log(`Tempo na página: ${timeSpent} segundos`);
        localStorage.setItem('timeOnPage', timeSpent);
    });

    // Track CTA clicks
    const ctaButtons = document.querySelectorAll('.cta-button');
    ctaButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            console.log(`CTA ${index + 1} clicado`);
            localStorage.setItem('lastCtaClicked', index);
        });
    });

    // Track FAQ interactions
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach((question, index) => {
        question.addEventListener('click', () => {
            console.log(`FAQ ${index + 1} aberto`);
            const openedFaqs = JSON.parse(localStorage.getItem('openedFaqs') || '[]');
            if (!openedFaqs.includes(index)) {
                openedFaqs.push(index);
                localStorage.setItem('openedFaqs', JSON.stringify(openedFaqs));
            }
        });
    });
}

// Sistema de Notificações Premium
const notificationMessages = [
    { name: 'João Paulo', city: 'Belo Horizonte', state: 'MG', time: 'há 2 minutos', plan: 'Plano Premium' },
    { name: 'Maria Silva', city: 'São Paulo', state: 'SP', time: 'há 5 minutos', plan: 'Plano Premium' },
    { name: 'Fernanda M.', city: 'Rio de Janeiro', state: 'RJ', time: 'há 10 minutos', plan: 'Plano Básico' },
    { name: 'Ana Costa', city: 'Salvador', state: 'BA', time: 'há 12 minutos', plan: 'Plano Premium' },
    { name: 'Pedro Lucas', city: 'Brasília', state: 'DF', time: 'há 15 minutos', plan: 'Plano Premium' },
    { name: 'Carlos E.', city: 'Curitiba', state: 'PR', time: 'há 20 minutos', plan: 'Plano Básico' },
    { name: 'Juliana R.', city: 'Porto Alegre', state: 'RS', time: 'há 25 minutos', plan: 'Plano Premium' },
    { name: 'Lucas O.', city: 'Fortaleza', state: 'CE', time: 'há 32 minutos', plan: 'Plano Premium' },
    { name: 'Patrícia S.', city: 'Manaus', state: 'AM', time: 'há 40 minutos', plan: 'Plano Básico' },
    { name: 'Ricardo M.', city: 'Recife', state: 'PE', time: 'há 45 minutos', plan: 'Plano Premium' }
];

let notificationIndex = 0;

function createNotification(data) {
    const container = document.getElementById('notification-container');
    if (!container) {
        // Create container if it doesn't exist
        const newContainer = document.createElement('div');
        newContainer.id = 'notification-container';
        document.body.appendChild(newContainer);
        return createNotification(data);
    }

    const notification = document.createElement('div');
    notification.className = 'premium-notification';

    // Play subtle sound (optional, muted by default for UX)
    // const audio = new Audio('notification.mp3'); audio.play().catch(()=>{});

    notification.innerHTML = `
        <div class="notification-avatar icon-only">
            <i class="fas fa-leaf"></i>
        </div>
        <div class="notification-content">
            <div class="notification-header">
                <span class="notification-name">${data.name}</span>
                <span class="notification-time">${data.time}</span>
            </div>
            <div class="notification-body">
                <span class="notification-action">Comprou:</span>
                <span class="notification-product">${data.plan}</span>
            </div>
            <div class="notification-location">
                <i class="fas fa-map-marker-alt"></i> ${data.city}, ${data.state}
            </div>
        </div>
        <div class="notification-close" onclick="this.parentElement.remove()">×</div>
    `;

    container.appendChild(notification);

    // Animate In
    setTimeout(() => notification.classList.add('visible'), 100);

    // Remove automatically
    setTimeout(() => {
        notification.classList.remove('visible');
        setTimeout(() => notification.remove(), 500); // Wait for transition
    }, 6000);
}

function startNotificationSystem() {
    // Primeira notificação rápida para engajamento
    setTimeout(() => {
        createNotification(notificationMessages[0]);
        notificationIndex = 1;
    }, 4000);

    // Loop subsequente
    setInterval(() => {
        createNotification(notificationMessages[notificationIndex]);
        notificationIndex = (notificationIndex + 1) % notificationMessages.length;
    }, 12000); // A cada 12 segundos
}


// Funções do Pop-up de Upgrade
function showUpgradePopup(event) {
    if (typeof isCheckoutOpen !== 'undefined' && isCheckoutOpen) return;

    if (event) event.preventDefault();

    const popup = document.getElementById('upgrade-popup');
    if (popup) {
        popup.style.display = 'flex';
        // Force reflow
        void popup.offsetWidth;
        popup.classList.add('active');
        startPopupTimer();
    }
}

function hideUpgradePopup() {
    const popup = document.getElementById('upgrade-popup');
    if (popup) {
        popup.style.display = 'none';
        popup.classList.remove('active');
        document.body.style.overflow = 'auto';
    }
}

// Event listeners para o pop-up
document.addEventListener('DOMContentLoaded', function () {
    const popup = document.getElementById('upgrade-popup');

    // Fecha o pop-up ao clicar fora do card
    if (popup) {
        popup.addEventListener('click', function (e) {
            if (e.target === popup) {
                hideUpgradePopup();
            }
        });
    }
});

// Controle do vídeo - Card escuro com play overlay
function setupVideoPlayer() {
    const video = document.getElementById('hero-video');
    const playOverlay = document.getElementById('play-overlay');
    const caption = document.querySelector('.video-caption');

    if (!video || !playOverlay) return;

    // Pré-carrega o vídeo
    video.preload = 'auto';
    video.load();

    function playVideo() {
        playOverlay.classList.add('hidden');
        if (caption) caption.textContent = 'Clique para pausar';

        video.play().catch(function () {
            video.muted = true;
            video.play();
        });
    }

    function pauseVideo() {
        video.pause();
        playOverlay.classList.remove('hidden');
        if (caption) caption.textContent = 'Clique para continuar';
    }

    function resetVideo() {
        playOverlay.classList.remove('hidden');
        if (caption) caption.textContent = 'Clique para assistir';
        video.currentTime = 0;
    }

    // Clique no overlay para iniciar
    playOverlay.addEventListener('click', function (e) {
        // --- VISUAL ELEGANCE: FLOATING PARTICLES ---
        function initFloatingParticles() {
            // Disable on mobile for performance
            if (window.innerWidth < 640) return;

            const targetSections = document.querySelectorAll('.hero, .what-you-get, .testimonials');
            const icons = ['fa-leaf', 'fa-seedling', 'fa-spa']; // Theme appropriate icons

            targetSections.forEach(section => {
                // Create container
                const container = document.createElement('div');
                container.className = 'floating-container';
                section.appendChild(container); // Ensure section has relative positioning in CSS

                // Create 12 particles per section
                for (let i = 0; i < 12; i++) {
                    const particle = document.createElement('i');
                    const randomIcon = icons[Math.floor(Math.random() * icons.length)];

                    particle.className = `fas ${randomIcon} floating-particle`;

                    // Randomize properties
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDuration = (15 + Math.random() * 20) + 's'; // Slow float (15-35s)
                    particle.style.animationDelay = (Math.random() * 10) + 's';
                    particle.style.fontSize = (1 + Math.random()) + 'rem';
                    particle.style.opacity = 0; // Handled by keyframe

                    // Add slight variation in color type (handled by CSS classes too)
                    if (Math.random() > 0.7) particle.classList.add('sparkle');
                    else particle.classList.add('leaf');

                    container.appendChild(particle);
                }
            });
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            initFloatingParticles();

            // Refined Scroll Observer for .animate-on-scroll
            const observerOptions = {
                threshold: 0.15,
                rootMargin: "0px 0px -50px 0px" // Trigger slightly before element is fully in view
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target); // Only animate once
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.animate-on-scroll, .benefit-card, .exclusive-card, .bonus-card, .testimonial-card').forEach(el => {
                el.classList.add('animate-on-scroll'); // Ensure class exists
                observer.observe(el);
            });
        });
        playVideo();
    });

    // Clique no vídeo para pausar/continuar
    video.addEventListener('click', function () {
        if (video.paused) {
            playVideo();
        } else {
            pauseVideo();
        }
    });

    // Quando o vídeo terminar
    video.addEventListener('ended', function () {
        resetVideo();
    });
}

// Inicializa a aplicação
initializeApp();

// Inicia o cronômetro dos planos quando a página carrega
startPlansCountdown();

// Inicia o sistema de notificações
startNotificationSystem();

// Configura o player de vídeo customizado
document.addEventListener('DOMContentLoaded', setupVideoPlayer);

// --- VISUAL ELEGANCE: FLOATING PARTICLES ---
function initFloatingParticles() {
    // Disable on mobile for performance
    if (window.innerWidth < 640) return;

    const targetSections = document.querySelectorAll('.hero, .what-you-get, .testimonials');
    const icons = ['fa-leaf', 'fa-seedling', 'fa-spa']; // Theme appropriate icons

    targetSections.forEach(section => {
        // Create container
        const container = document.createElement('div');
        container.className = 'floating-container';
        section.appendChild(container); // Ensure section has relative positioning in CSS

        // Create 12 particles per section
        for (let i = 0; i < 12; i++) {
            const particle = document.createElement('i');
            const randomIcon = icons[Math.floor(Math.random() * icons.length)];

            particle.className = `fas ${randomIcon} floating-particle`;

            // Randomize properties
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDuration = (15 + Math.random() * 20) + 's'; // Slow float (15-35s)
            particle.style.animationDelay = (Math.random() * 10) + 's';
            particle.style.fontSize = (1 + Math.random()) + 'rem';
            particle.style.opacity = 0; // Handled by keyframe

            // Add slight variation in color type (handled by CSS classes too)
            if (Math.random() > 0.7) particle.classList.add('sparkle');
            else particle.classList.add('leaf');

            container.appendChild(particle);
        }
    });
}

// Initialize Visual Effects
document.addEventListener('DOMContentLoaded', () => {
    initFloatingParticles();

    // Refined Scroll Observer for .animate-on-scroll
    const observerOptions = {
        threshold: 0.15,
        rootMargin: "0px 0px -50px 0px" // Trigger slightly before element is fully in view
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Only animate once
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll, .benefit-card, .exclusive-card, .bonus-card, .testimonial-card').forEach(el => {
        el.classList.add('animate-on-scroll'); // Ensure class exists
        observer.observe(el);
    });
});