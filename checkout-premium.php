<?php

$API_TOKEN         = 'sk_5801a6ec5051bf1cf144155ddada51120b2d1dda4d03cb2df454fb4eab9a78a9';
$OFFER_HASH        = '';
$PRODUCT_HASH      = 'prod_372117ff2ba365a1';
$BASE_AMOUNT       = 2700;
$PRODUCT_TITLE     = 'Mestre dos Chás - Acesso Completo';
$IS_DROPSHIPPING   = false;
$THREE_STEP_CHECKOUT = false;
$TIMER_TEXT        = 'Esta oferta expira em: {{tempo}}';
$TIMER_BG_COLOR    = '#111827';
$TIMER_TEXT_COLOR  = '#ffffff';
$PIX_EXPIRATION_MINUTES = 5;

if (isset($_GET['action']) && $_GET['action'] === 'check_status') {
    header('Content-Type: application/json');
    $hash = $_GET['hash'] ?? '';
    if (!$hash) { echo json_encode(['error' => 's']); exit; }

    $ch = curl_init('https://multi.paradisepags.com/api/v1/check_status.php?hash=' . $hash);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-API-Key: ' . $API_TOKEN
    ]);
   
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $data = json_decode($response, true);

 
    if ($httpCode === 200 && ($data['payment_status'] ?? '') === 'paid') {
        $upsellUrl = '';
        if (!empty($upsellUrl)) {
            $data['upsell_url'] = $upsellUrl;
        }
    }

    echo json_encode($data);
    exit;
}

$ELEMENT_BG_COLOR       = '#FFFFFF';
$ELEMENT_BORDER_RADIUS  = 12;
$CARD_RADIUS            = $ELEMENT_BORDER_RADIUS . 'px';
$BUTTON_RADIUS          = round($ELEMENT_BORDER_RADIUS * 0.8) . 'px';
$INPUT_RADIUS           = round($ELEMENT_BORDER_RADIUS * 0.66) . 'px';

$PIX_MODAL_TITLE                     = 'Pagamento via PIX';
$PIX_MODAL_COPY_BUTTON_TEXT          = 'Copiar código PIX';
$PIX_MODAL_VALUE_TEXT                = '💰 Valor:';
$PIX_MODAL_EXPIRATION_TEXT           = '🕒 Válido até:';
$PIX_MODAL_SECURE_PAYMENT_TEXT       = 'Pagamento seguro via PIX';
$PIX_MODAL_BG_COLOR                  = '#FFFFFF';
$PIX_MODAL_TEXT_COLOR                = '#1f2937';
$PIX_MODAL_INFO_TEXT_COLOR           = '#0f172a';
$PIX_MODAL_SECURE_PAYMENT_TEXT_COLOR = '#00c27a';
$PIX_MODAL_BUTTON_COLOR              = '#00c27a';
$PIX_MODAL_BUTTON_TEXT_COLOR         = '#FFFFFF';
$PIX_MODAL_INPUT_BG_COLOR            = '#f9fafb';
$PIX_MODAL_INPUT_BORDER_COLOR        = '#d1d5db';
$PIX_MODAL_INPUT_TEXT_COLOR          = '#374151';

$ALL_ORDER_BUMPS      = json_decode(base64_decode('W3siaWQiOiJmNGJmYThhOC02OGZjLTRiYjQtYTNlMS0wODM5MDVmMzA4N2QiLCJ0aXRsZSI6IlNpbSwgcXVlcm8gcmVjZWJlciBvIGd1aWEgc29icmUgw6FsY29vbCBkZSBjZXJlYWlzIiwiZGVzY3JpcHRpb24iOiJTaW0sIGV1IHF1ZXJvISIsInByaWNlIjoxMjkwLCJsb2dvVXJsIjoiaHR0cHM6Ly9pbWFnZTJ1cmwuY29tL2ltYWdlcy8xNzY2MzQ3NDQzODkyLTdkYjEwNGNiLTc3ODQtNDVlMC1hZDJiLTgxMmE4YWNlMWVmNS5wbmciLCJvZmZlckhhc2giOiJvYl83MGIwNjY0ZjQ4YjYxZTNmIiwicHJvZHVjdEhhc2giOiIifSx7ImlkIjoiMzU2NjdiYWMtMTM0My00MDMzLTgxMDUtMWZiOTAyNGYyZWEzIiwidGl0bGUiOiJTaW0sIHF1ZXJvIGxldmFyIHRhbWLDqW0gbWV1IGd1aWEgcGFyYSBjdWx0aXZhciBwbGFudGFzIG1lZGljaW5haXMgZW0gY2FzYSIsImRlc2NyaXB0aW9uIjoiU2ltLCBldSBxdWVybyEiLCJwcmljZSI6OTkwLCJsb2dvVXJsIjoiaHR0cHM6Ly9pbWFnZTJ1cmwuY29tL2ltYWdlcy8xNzY2MzQ3Mzk0ODU5LWMwMjEyNGRmLTNiY2MtNDNiYi1hOTgyLTAxYzVjZTE0MjM2MC5wbmciLCJvZmZlckhhc2giOiJvYl85M2FmNWMxMjc4ZDc1YzUzIiwicHJvZHVjdEhhc2giOiIifV0='), true);
$ALL_COUPONS = json_decode(base64_decode('W10='), true);
$ALL_TESTIMONIALS     = json_decode(base64_decode('W10='), true);
$ALL_BANNERS          = json_decode(base64_decode('W10='), true);
$ALL_VIDEOS           = json_decode(base64_decode('W10='), true);
$ALL_TEXT_BLOCKS      = json_decode(base64_decode('W10='), true);
$COMPONENT_ORDER      = json_decode(base64_decode('WyJzaW5nbGV0b25faWRlbnRpdHkiLCJzaW5nbGV0b25fYnVtcHMiLCJzaW5nbGV0b25fcGF5bWVudCJd'), true);
$SOCIAL_PROOF_SETTINGS = json_decode(base64_decode('eyJlbmFibGVkIjpmYWxzZSwibmFtZXMiOltdLCJwYXlvdXRNZXNzYWdlIjoie3tuYW1lfX0gYWNhYm91IGRlIHBhZ2FyIHt7dmFsdWV9fSIsInBheW91dE1pbiI6MTUwLCJwYXlvdXRNYXgiOjUwMCwiaW5pdGlhbERlbGF5Ijo1LCJkaXNwbGF5RHVyYXRpb24iOjQsImludGVydmFsTWluIjo4LCJpbnRlcnZhbE1heCI6MjB9'), true);
$SECURITY_SEAL_SETTINGS = json_decode(base64_decode('eyJlbmFibGVkIjp0cnVlLCJiYWNrZ3JvdW5kQ29sb3IiOiIjRkZGRkZGIiwiaXRlbXMiOlt7ImlkIjoic2VhbC0xIiwiaWNvbiI6ImV5ZS1zbGFzaCIsInRpdGxlIjoiRGFkb3MgcHJvdGVnaWRvcyIsInRleHQiOiJPcyBzZXVzIGRhZG9zIHPDo28gY29uZmlkZW5jaWFpcyBlIHNlZ3Vyb3MuIn0seyJpZCI6InNlYWwtMiIsImljb24iOiJsb2NrIiwidGl0bGUiOiJQYWdhbWVudG8gMTAwJSBTZWd1cm8iLCJ0ZXh0IjoiQXMgaW5mb3JtYcOnw7VlcyBkZXN0YSBjb21wcmEgc8OjbyBjcmlwdG9ncmFmYWRhcy4ifSx7ImlkIjoic2VhbC0zIiwiaWNvbiI6ImFjYWRlbWljLWNhcCIsInRpdGxlIjoiQ29udGXDumRvIEFwcm92YWRvIiwidGV4dCI6IjEwMCUgcmV2aXNhZG8gZSBhcHJvdmFkbyBwb3IgcHJvZmlzc2lvbmFpcyJ9LHsiaWQiOiJzZWFsLTQiLCJpY29uIjoic2hpZWxkIiwidGl0bGUiOiJHYXJhbnRpYSBkZSA3IGRpYXMiLCJ0ZXh0IjoiVm9jw6ogZXN0YSBwcm90ZWdpZG8gcG9yIHVtYSBnYXJhbnRpYSBkZSBzYXRpc2Zhw6fDo28ifV19'), true);
$STEP_ORDERS          = json_decode(base64_decode('eyJzdGVwMSI6WyJzaW5nbGV0b25faWRlbnRpdHkiXSwic3RlcDIiOlsic2luZ2xldG9uX2FkZHJlc3MiXSwic3RlcDMiOlsic2luZ2xldG9uX3N1bW1hcnkiLCJzaW5nbGV0b25fYnVtcHMiLCJzaW5nbGV0b25fcGF5bWVudCIsInNpbmdsZXRvbl9zZWN1cml0eV9zZWFsIl19'), true);
$SHIPPING_SETTINGS = json_decode(base64_decode('W10='), true);
$QUANTITY_SELECTOR_SETTINGS = json_decode(base64_decode('W10='), true);

$checkout_settings = [
    'buttonColor' => '#21bfeb',
    'hash' => 'prod_372117ff2ba365a1',
    'productHash' => 'prod_372117ff2ba365a1',
    'offerHash' => '',
    'headerColor' => '#21bfeb',
    'headerTextColor' => '#ffffff',
    'headerText' => 'Compra Segura e Rápida',
    'summaryText' => 'Você está adquirindo:',
    'productLogoURL' => 'checkout-product.jpg',
    'title' => 'Mestre dos Chás - Acesso Completo',
    'amountFormatted' => 'R$ ' . number_format(2700 / 100, 2, ',', '.'),
    'buttonText' => 'PAGAR AGORA',
    'fields' => [
        'name' => true,
        'email' => true,
        'phone' => true,
        'document' => false,
        'cep' => false
    ]
];

$banners_map = array_column($ALL_BANNERS, null, 'id');
$videos_map = array_column($ALL_VIDEOS, null, 'id');
$testimonials_map = array_column($ALL_TESTIMONIALS, null, 'id');
$text_blocks_map = array_column($ALL_TEXT_BLOCKS, null, 'id');
$all_components_map = [
    'banners' => $banners_map,
    'videos' => $videos_map,
    'testimonials' => $testimonials_map,
    'text_blocks' => $text_blocks_map
];

$php_globals = [
    'ELEMENT_BG_COLOR' => $ELEMENT_BG_COLOR,
    'CARD_RADIUS' => $CARD_RADIUS,
    'INPUT_RADIUS' => $INPUT_RADIUS,
    'BUTTON_RADIUS' => $BUTTON_RADIUS,
    'ALL_ORDER_BUMPS' => $ALL_ORDER_BUMPS,
    'IS_DROPSIPPING' => $IS_DROPSIPPING,
    'THREE_STEP_CHECKOUT' => $THREE_STEP_CHECKOUT,
    'SECURITY_SEAL_SETTINGS' => $SECURITY_SEAL_SETTINGS,
    'QUANTITY_SELECTOR_SETTINGS' => $QUANTITY_SELECTOR_SETTINGS,

    
    'SHIPPING_SETTINGS' => $SHIPPING_SETTINGS
];


if (isset($_GET['action']) && $_GET['action'] === 'validate_coupon' && !$THREE_STEP_CHECKOUT) {
    header('Content-Type: application/json');
    $code = $_GET['code'] ?? '';
    $found_coupon = null;
    foreach ($ALL_COUPONS as $coupon) {
        if (strcasecmp($coupon['code'], $code) === 0) {
            $found_coupon = $coupon;
            break;
        }
    }

    if ($found_coupon) {
        echo json_encode(['success' => true, 'coupon' => $found_coupon]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Cupom inválido ou expirado.']);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $api_url = 'https://multi.paradisepags.com/api/v1/transaction.php';
    $customer_data = $_POST;
    $utms = $_POST['utms'] ?? [];

 
    $cpfs = ['42879052882', '07435993492', '93509642791', '73269352468', '35583648805', '59535423720', '77949412453', '13478710634', '09669560950', '03270618638'];
    $firstNames = ['João', 'Marcos', 'Pedro', 'Lucas', 'Mateus', 'Gabriel', 'Daniel', 'Bruno', 'Maria', 'Ana', 'Juliana', 'Camila', 'Beatriz', 'Larissa', 'Sofia', 'Laura'];
    $lastNames = ['Silva', 'Santos', 'Oliveira', 'Souza', 'Rodrigues', 'Ferreira', 'Alves', 'Pereira', 'Lima', 'Gomes', 'Costa', 'Ribeiro', 'Martins', 'Carvalho'];
    $ddds = ['11', '21', '31', '41', '51', '61', '71', '81', '85', '92', '27', '48'];
    $emailProviders = ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com.br', 'uol.com.br', 'terra.com.br'];
    $generatedName = null;

    if (empty($customer_data['name']) && !true) {
        $randomFirstName = $firstNames[array_rand($firstNames)];
        $randomLastName = $lastNames[array_rand($lastNames)];
        $generatedName = $randomFirstName . ' ' . $randomLastName;
        $customer_data['name'] = $generatedName;
    }
    if (empty($customer_data['email']) && !true) {
        $nameForEmail = $generatedName ?? ($customer_data['name'] ?? ($firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)]));
        $nameParts = explode(' ', (string)$nameForEmail, 2);
        
        $normalize = fn($str) => preg_replace('/[^w]/', '', strtolower(iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str) ?? ''));
        
        $emailUserParts = [];
        if (!empty($nameParts[0])) {
            $part1 = $normalize($nameParts[0]);
            if (strlen($part1) > 0) $emailUserParts[] = $part1;
        }
        if (isset($nameParts[1])) {
            $part2 = $normalize($nameParts[1]);
            if (strlen($part2) > 0) $emailUserParts[] = $part2;
        }

        if (empty($emailUserParts)) {
            $emailUserParts[] = 'cliente';
        }

        $emailUser = implode('.', $emailUserParts) . mt_rand(100, 999);
        $customer_data['email'] = $emailUser . '@' . $emailProviders[array_rand($emailProviders)];
    }
  
    if (empty($customer_data['phone_number'])) {
        $customer_data['phone_number'] = $ddds[array_rand($ddds)] . '9' . mt_rand(10000000, 99999999);
    }
    if (empty($customer_data['document']) && !false) {
        $customer_data['document'] = $cpfs[array_rand($cpfs)];
    }
 

    if (!$IS_DROPSHIPPING) {
        $customer_data['street_name'] = $customer_data['street_name'] ?? 'Rua do Produto Digital'; $customer_data['number'] = $customer_data['number'] ?? '0'; $customer_data['complement'] = $customer_data['complement'] ?? 'N/A'; $customer_data['neighborhood'] = $customer_data['neighborhood'] ?? 'Internet'; $customer_data['city'] = $customer_data['city'] ?? 'Brasil'; $customer_data['state'] = $customer_data['state'] ?? 'BR';
        if (empty($customer_data['zip_code'])) { $customer_data['zip_code'] = '00000000'; }
    }



// 1. Inicia com o valor base (produto x quantidade)
$quantity = isset($_POST['quantity']) && is_numeric($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
$total_amount = $BASE_AMOUNT * $quantity;
$order_bumps_value = 0;
// 2. SOMA OS ORDER BUMPS para formar o subtotal
if (!empty($_POST['orderbump']) && is_array($_POST['orderbump'])) {
    $all_bumps_map = array_column($ALL_ORDER_BUMPS, null, 'offerHash');
    foreach ($_POST['orderbump'] as $bump_hash) {
        if (isset($all_bumps_map[$bump_hash])) {
            $total_amount += $all_bumps_map[$bump_hash]['price'];
            $order_bumps_value += $all_bumps_map[$bump_hash]['price'];
        }
    }
}

// 3. APLICA O CUPOM (CERTO) sobre o subtotal (produto + bumps)
if (!$THREE_STEP_CHECKOUT && isset($_POST['coupon_code']) && !empty($_POST['coupon_code'])) {
    $applied_coupon = null;
    foreach ($ALL_COUPONS as $c) {
        if (strcasecmp($c['code'], $_POST['coupon_code']) === 0) {
            $applied_coupon = $c;
            break;
        }
    }

    if ($applied_coupon) {
        if ($applied_coupon['type'] === 'fixed') {
            $total_amount -= $applied_coupon['value'];
        } elseif ($applied_coupon['type'] === 'percentage') {
            // O desconto agora é calculado sobre o total que já inclui os bumps
            $discount_value = $total_amount * ($applied_coupon['value'] / 100);
            $total_amount -= $discount_value;
        }
    }
}

// 4. SOMA O FRETE POR ÚLTIMO (não recebe desconto)
if ($IS_DROPSHIPPING && isset($_POST['shipping_price']) && is_numeric($_POST['shipping_price'])) {
    $total_amount += (int)$_POST['shipping_price'];
}

// 5. Garante que o total não seja negativo
$total_amount = max(0, $total_amount);




    $reference = $_POST['event_id'] ?? 'CKO-' . uniqid();
    $clean_document = preg_replace('/\D/', '', $customer_data['document'] ?? '');
    $clean_phone = preg_replace('/\D/', '', $customer_data['phone_number'] ?? '');

    $payload = [
      "amount" => round($total_amount - $order_bumps_value),
        "description" => $PRODUCT_TITLE,
        "reference" => $reference,
      "checkoutUrl" => $_POST['checkout_url'] ?? '',
        "productHash" => $PRODUCT_HASH,
        "orderbump" => array_values(array_filter($_POST['orderbump'] ?? [])),
        "customer" => [
            'name' => $customer_data['name'] ?? 'N/A',
            'email' => $customer_data['email'] ?? 'na@na.com',
            'document' => $clean_document,
            'phone' => $clean_phone
        ]
    ];


    if (!empty($utms)) {
        $payload['tracking'] = [];
      $tracking_keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'src', 'sck', 'fbc', 'fbp'];
        foreach ($tracking_keys as $key) {
            if (!empty($utms[$key])) {
                $payload['tracking'][$key] = $utms[$key];
            }
        }

        if (empty($payload['tracking'])) {
            unset($payload['tracking']);
        }
    }


    if (($IS_DROPSHIPPING || !$IS_DROPSHIPPING) && !empty($customer_data['zip_code'])) {
        $payload['address'] = [

            "street" => $customer_data['street_name'] ?? 'Rua do Produto Digital',
            "number" => $customer_data['number'] ?? '0',
            "neighborhood" => $customer_data['neighborhood'] ?? 'Internet',
            "city" => $customer_data['city'] ?? 'Brasil',
            "state" => $customer_data['state'] ?? 'BR',
            "zipcode" => preg_replace('/\D/', '', $customer_data['zip_code'] ?? ''),
            "complement" => $customer_data['complement'] ?? ''
        ];
    }

  


    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'X-API-Key: ' . $API_TOKEN
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    

    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);

    if ($curl_error) { http_response_code(500); echo json_encode(['error' => 'cURL Error: ' . $curl_error]); exit; }
    
    $response_data = json_decode($response, true);
    if ($response_data && $http_code >= 200 && $http_code < 300) {

        $transaction_data = $response_data['transaction'] ?? $response_data;


        $frontend_response = [
            'hash' => $transaction_data['id'] ?? $reference,
            'pix' => [
                'pix_qr_code' => $transaction_data['qr_code'] ?? '',
                'expiration_date' => $transaction_data['expires_at'] ?? null
            ],
            'amount_paid' => round($total_amount)
        ];
        http_response_code($http_code);
        echo json_encode($frontend_response);
    } else {
        http_response_code($http_code);
        echo $response;
    }
    exit;
}

function render_checkout_component($component_id, $all_components_map, $checkout_settings, $php_globals) {

    extract($php_globals);
    
    $checkout_settings = [
        'buttonColor' => '#21bfeb',
        'headerColor' => '#21bfeb',
        'headerTextColor' => '#ffffff',
        'headerText' => 'Compra Segura e Rápida',
        'summaryText' => 'Você está adquirindo:',
        'productLogoURL' => 'checkout-product.jpg',
        'title' => 'Saberes da Floresta',
        'amountFormatted' => 'R$ ' . number_format(1000 / 100, 2, ',', '.'),
        'buttonText' => 'PAGAR AGORA',
        'hash' => '9b7d69dcb4',
        'fields' => [
            'name' => true,
            'email' => true,
            'phone' => true,
            'document' => false,
            'cep' => false
        ]
    ];
    
    $is_full_width = in_array($component_id, ['singleton_header']);
    if (!$is_full_width) echo '<div class="constrained-width">';


    if ($component_id === 'singleton_header') {
        if (!empty($checkout_settings['headerText'])) {
            echo '<header style="background-color: ' . htmlspecialchars($checkout_settings['headerColor'] ?? '#1f2937') . '; color: ' . htmlspecialchars($checkout_settings['headerTextColor'] ?? '#ffffff') . ';" class="w-full p-3 text-center text-sm font-semibold shadow-md">' . htmlspecialchars($checkout_settings['headerText']) . '</header>';
        }
    } elseif (strpos($component_id, 'banner-') === 0 && isset($all_components_map['banners'][$component_id])) {
        $banner = $all_components_map['banners'][$component_id];
        echo '<div class="w-full bg-gray-200 overflow-hidden" style="border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';"><img src="' . htmlspecialchars($banner['path']) . '" alt="Banner" class="w-full object-cover"></div>';
    } elseif (strpos($component_id, 'video-') === 0 && isset($all_components_map['videos'][$component_id])) {
        $video = $all_components_map['videos'][$component_id];
        echo '<div class="overflow-hidden shadow-lg" style="border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';"><div class="video-container">' . ($video['type'] === 'url' ? '<video controls playsinline src="' . htmlspecialchars($video['content']) . '"></video>' : $video['content']) . '</div></div>';
    } elseif (strpos($component_id, 'textBlock-') === 0 && isset($all_components_map['text_blocks'][$component_id])) {
        $text_block = $all_components_map['text_blocks'][$component_id];
        $bg_color = !empty($text_block['backgroundColor']) ? htmlspecialchars($text_block['backgroundColor']) : $ELEMENT_BG_COLOR;
        $text_color = !empty($text_block['textColor']) ? 'color: ' . htmlspecialchars($text_block['textColor']) . ';' : '';
        echo '<div class="prose text-center max-w-none shadow-lg p-6" style="background-color: ' . $bg_color . '; ' . $text_color . ' border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">' . $text_block['content'] . '</div>';
    } elseif ($component_id === 'singleton_summary') {
        echo '<div class="shadow-lg p-5" style="background-color: ' . htmlspecialchars($ELEMENT_BG_COLOR) . '; border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">';
        if (!empty($checkout_settings['summaryText'])) echo '<p class="text-sm font-medium mb-4 opacity-80">' . htmlspecialchars($checkout_settings['summaryText']) . '</p>';
        echo '<div class="flex items-center space-x-4">';
        if (!empty($checkout_settings['productLogoURL'])) echo '<img src="checkout-product.jpg" alt="' . htmlspecialchars($checkout_settings['title']) . '" class="w-16 h-16 object-cover flex-shrink-0 border border-gray-200 p-1" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';">';
      
        echo '<div class="flex-grow"><h3 class="font-bold">' . htmlspecialchars($checkout_settings['title']) . '</h3><p class="text-lg font-semibold text-green-600">' . $checkout_settings['amountFormatted'] . '</p></div></div>';

    if ($QUANTITY_SELECTOR_SETTINGS['enabled']) {
        echo '<div class="mt-4 flex items-center justify-between">';
        echo '<label class="text-sm font-medium opacity-80">Quantidade</label>';
        echo '<div class="flex items-center border border-gray-200 rounded-md overflow-hidden" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';">';
        echo '<button type="button" id="quantity-minus-' . $checkout_settings['hash'] . '" class="px-3 h-8 text-base font-bold text-gray-500 bg-gray-50 hover:bg-gray-100 transition-colors">-</button>';
        echo '<input type="text" name="quantity" id="quantity-input-' . $checkout_settings['hash'] . '" value="' . $QUANTITY_SELECTOR_SETTINGS['default'] . '" min="' . $QUANTITY_SELECTOR_SETTINGS['min'] . '" max="' . $QUANTITY_SELECTOR_SETTINGS['max'] . '" class="w-10 h-8 text-center text-sm font-semibold text-gray-800 bg-white border-x border-gray-200 focus:outline-none" readonly>';
        echo '<button type="button" id="quantity-plus-' . $checkout_settings['hash'] . '" class="px-3 h-8 text-base font-bold text-gray-500 bg-gray-50 hover:bg-gray-100 transition-colors">+</button>';
        echo '</div></div>';
    }
        
        echo '<div id="order-bump-summary-' . $checkout_settings['hash'] . '"></div><div id="coupon-summary-' . $checkout_settings['hash'] . '" class="hidden text-sm mt-3 pt-3 border-t border-dashed"></div><hr class="my-4">';
        echo '<div class="flex justify-between items-center"><p class="font-bold text-lg">Total:</p><p id="total-price-' . $checkout_settings['hash'] . '" class="font-bold text-lg">' . $checkout_settings['amountFormatted'] . '</p></div></div>';
    } elseif ($component_id === 'singleton_bumps' && !empty($ALL_ORDER_BUMPS)) {
        echo '<div class="shadow-lg p-4 sm:p-8 space-y-4" style="background-color: ' . htmlspecialchars($ELEMENT_BG_COLOR) . '; border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">';
        foreach($ALL_ORDER_BUMPS as $bump) {
            echo '<label class="block p-4 border-2 border-dashed border-gray-300 hover:border-[' . $checkout_settings['buttonColor'] . '] hover:bg-violet-50 transition-all cursor-pointer has-[:checked]:border-[' . $checkout_settings['buttonColor'] . '] has-[:checked]:ring-2 has-[:checked]:ring-[' . $checkout_settings['buttonColor'] . '] has-[:checked]:bg-violet-50" style="border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">';
         echo '<div class="flex items-start"><input type="checkbox" name="orderbump[]" value="' . htmlspecialchars($bump['offerHash'] ?? '') . '" data-price="' . $bump['price'] . '" class="order-bump-checkbox form-checkbox h-6 w-6 text-[' . $checkout_settings['buttonColor'] . '] mt-1 mr-4 rounded-md border-gray-400 focus:ring-[' . $checkout_settings['buttonColor'] . ']">';
            echo '<div class="flex-grow flex items-center space-x-4">';
            if(!empty($bump['logoUrl'])) echo '<img src="' . htmlspecialchars($bump['logoUrl']) . '" alt="' . htmlspecialchars($bump['title']) . '" class="w-12 h-12 object-cover flex-shrink-0" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';">';
            echo '<div class="flex-grow"><div class="flex items-center justify-between"><h4 class="font-bold text-lg">' . htmlspecialchars($bump['title']) . '</h4><p class="font-semibold text-green-600 whitespace-nowrap">+ R$ ' . number_format($bump['price'] / 100, 2, ',', '.') . '</p></div>';
            echo '<p class="text-sm opacity-80 mt-1">' . htmlspecialchars($bump['description']) . '</p></div></div></div></label>';
        }
        echo '</div>';


} elseif ($component_id === 'singleton_coupons' && !$THREE_STEP_CHECKOUT) {
    echo '<div class="shadow-lg p-4 sm:p-8" style="background-color: ' . htmlspecialchars($ELEMENT_BG_COLOR) . '; border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">';
    echo '<div id="coupon-area-' . $checkout_settings['hash'] . '"><label for="coupon-code-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Cupom de Desconto</label>';
    echo '<div class="flex gap-2"><input type="text" id="coupon-code-' . $checkout_settings['hash'] . '" placeholder="Insira seu cupom" class="flex-grow p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';">';
    echo '<button type="button" id="apply-coupon-btn-' . $checkout_settings['hash'] . '" class="px-5 py-2 font-semibold text-white" style="background-color: ' . $checkout_settings['buttonColor'] . '; border-radius: ' . htmlspecialchars($BUTTON_RADIUS) . ';">Aplicar</button></div>';
    echo '<p id="coupon-message-' . $checkout_settings['hash'] . '" class="text-sm mt-2"></p></div></div>';
    } elseif ($component_id === 'singleton_identity' || $component_id === 'singleton_address') {
        $is_identity = $component_id === 'singleton_identity';
        echo '<div class="shadow-lg p-4 sm:p-8" style="background-color: ' . htmlspecialchars($ELEMENT_BG_COLOR) . '; border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">';
        echo '<div class="flex items-center mb-6"><span class="text-white rounded-full h-8 w-8 flex items-center justify-center font-bold text-lg mr-3 flex-shrink-0" style="background-color: ' . $checkout_settings['buttonColor'] . ';">';
        echo $is_identity ? '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" /></svg>' : '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5h10.5a2.25 2.25 0 002.25-2.25V6.75a2.25 2.25 0 00-2.25-2.25H3.375A2.25 2.25 0 001.125 6.75v10.5a2.25 2.25 0 002.25 2.25z" /></svg>';
        echo '</span><h2 class="text-xl font-bold">' . ($is_identity ? 'Identifique-se' : 'Endereço de Entrega') . '</h2></div>';
        echo '<div class="space-y-4">';
        if ($is_identity) {
            if ($checkout_settings['fields']['name']) echo '<div><label for="name-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Nome e sobrenome</label><input type="text" id="name-' . $checkout_settings['hash'] . '" name="name" placeholder="Nome e sobrenome" required value="' . htmlspecialchars(preg_replace('/[0-9]/', '', $_GET['name'] ?? ''), ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
            if ($checkout_settings['fields']['email']) echo '<div><label for="email-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">E-mail</label><input type="email" id="email-' . $checkout_settings['hash'] . '" name="email" placeholder="E-mail" required value="' . htmlspecialchars($_GET['email'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
            if ($checkout_settings['fields']['phone']) echo '<div><label for="phone-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Telefone/WhatsApp</label><input type="tel" id="phone-' . $checkout_settings['hash'] . '" name="phone_number" placeholder="(21) 99999-9999" required maxlength="15" value="' . htmlspecialchars(preg_replace('/D/', '', $_GET['phone'] ?? $_GET['whatsapp'] ?? ''), ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
            if ($checkout_settings['fields']['document']) echo '<div><label for="document-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">CPF</label><input type="text" id="document-' . $checkout_settings['hash'] . '" name="document" placeholder="000.000.000-00" required maxlength="14" value="' . htmlspecialchars(preg_replace('/D/', '', $_GET['document'] ?? $_GET['cpf'] ?? ''), ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
            if (!$THREE_STEP_CHECKOUT && $IS_DROPSIPPING) {
              
                echo '</div><div class="pt-4 border-t border-gray-200 space-y-4 mt-4">';
                echo '<div><label for="zip_code-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">CEP</label><input type="text" id="zip_code-' . $checkout_settings['hash'] . '" name="zip_code" placeholder="00000-000" required value="' . htmlspecialchars($_GET['zip_code'] ?? $_GET['cep'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
                echo '<div><label for="street_name-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Rua</label><input type="text" id="street_name-' . $checkout_settings['hash'] . '" name="street_name" required value="' . htmlspecialchars($_GET['street_name'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
              
            } elseif (!$THREE_STEP_CHECKOUT && !$IS_DROPSIPPING && $checkout_settings['fields']['cep']) {
                 echo '<div><label for="zip_code_optional-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">CEP</label><input type="text" id="zip_code_optional-' . $checkout_settings['hash'] . '" name="zip_code" placeholder="00000-000" value="' . htmlspecialchars($_GET['zip_code'] ?? $_GET['cep'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
            }
        } else {
             echo '<div><label for="zip_code-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">CEP</label><input type="text" id="zip_code-' . $checkout_settings['hash'] . '" name="zip_code" placeholder="00000-000" required value="' . htmlspecialchars($_GET['zip_code'] ?? $_GET['cep'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
             echo '<div><label for="street_name-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Rua / Logradouro</label><input type="text" id="street_name-' . $checkout_settings['hash'] . '" name="street_name" placeholder="Ex: Av. Brasil" required value="' . htmlspecialchars($_GET['street_name'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
             echo '<div class="grid grid-cols-2 gap-4"> <div><label for="number-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Número</label><input type="text" id="number-' . $checkout_settings['hash'] . '" name="number" required value="' . htmlspecialchars($_GET['number'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div> <div><label for="complement-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Complemento</label><input type="text" id="complement-' . $checkout_settings['hash'] . '" name="complement" placeholder="Ex: Apto 101" value="' . htmlspecialchars($_GET['complement'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div> </div>';
             echo '<div><label for="neighborhood-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Bairro</label><input type="text" id="neighborhood-' . $checkout_settings['hash'] . '" name="neighborhood" placeholder="Ex: Centro" required value="' . htmlspecialchars($_GET['neighborhood'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div>';
             echo '<div class="grid grid-cols-3 gap-4"> <div class="col-span-2"><label for="city-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Cidade</label><input type="text" id="city-' . $checkout_settings['hash'] . '" name="city" required value="' . htmlspecialchars($_GET['city'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div> <div><label for="state-' . $checkout_settings['hash'] . '" class="block text-sm font-medium mb-1">Estado</label><input type="text" id="state-' . $checkout_settings['hash'] . '" name="state" placeholder="UF" required maxlength="2" value="' . htmlspecialchars($_GET['state'] ?? '', ENT_QUOTES) . '" class="w-full p-3 bg-gray-50 border border-gray-300 text-gray-900 focus:outline-none focus:ring-2 focus:ring-[' . $checkout_settings['buttonColor'] . '] transition" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';"></div> </div>';
        }

if ($component_id === 'singleton_address') {
if (!empty($SHIPPING_SETTINGS['options'])) {
    echo '<div class="pt-4 mt-4 border-t border-gray-200">';
    echo '<h3 class="text-lg font-bold mb-3">Opções de Frete</h3>';
    echo '<div class="space-y-3">';
    foreach($SHIPPING_SETTINGS['options'] as $index => $option) {
        $checked = $index === 0 ? 'checked' : '';
        echo '<label class="flex items-center justify-between p-4 border border-gray-200 has-[:checked]:border-[' . $checkout_settings['buttonColor'] . '] has-[:checked]:bg-violet-50 rounded-lg cursor-pointer" style="border-radius: ' . htmlspecialchars($INPUT_RADIUS) . ';">';
        echo '<div class="flex items-center">';
        echo '<input type="radio" name="shipping_price" value="' . $option['price'] . '" data-price="' . $option['price'] . '" class="form-radio h-5 w-5 text-[' . $checkout_settings['buttonColor'] . '] shipping-option" ' . $checked . '>';
        echo '<div class="ml-3"><span class="block font-semibold">' . htmlspecialchars($option['name']) . '</span><span class="block text-sm opacity-70">' . htmlspecialchars($option['estimatedDeliveryTime']) . '</span></div>';
        echo '</div>';
        echo '<span class="font-semibold">R$ ' . number_format($option['price'] / 100, 2, ',', '.') . '</span>';
        echo '</label>';
    }
    echo '</div></div>';
    }
}
        
        echo '</div></div>';
    } elseif ($component_id === 'singleton_payment') {
        $pix_svg = '<svg class="h-6 w-6 text-[#32BCAD] mr-2 flex-shrink-0" viewBox="0 0 258 258" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M129 258C200.24 258 258 200.24 258 129C258 57.76 200.24 0 129 0C57.76 0 0 57.76 0 129C0 200.24 57.76 258 129 258Z" fill="#32BCAD"/><path d="M136.291 149.337L153.375 132.228H174.19L143.513 162.905H168.083V184.225H89.9174V162.905H114.487L83.8099 132.228H104.625L129 156.618L153.375 132.228L129 107.837L104.625 132.228H83.8099L114.487 101.551H89.9174V80.2305H168.083V101.551H143.513L174.19 132.228L136.291 149.337Z" fill="white"/></svg>';
        echo '<div class="shadow-lg p-4 sm:p-8" style="background-color: ' . htmlspecialchars($ELEMENT_BG_COLOR) . '; border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">';
        echo '<div class="flex items-center mb-4"><span class="text-white rounded-full h-8 w-8 flex items-center justify-center font-bold text-lg mr-3 flex-shrink-0" style="background-color: ' . $checkout_settings['buttonColor'] . ';"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15A2.25 2.25 0 002.25 6.75v10.5A2.25 2.25 0 004.5 21z" /></svg></span><h2 class="text-xl font-bold">Pagamento</h2></div>';
        echo '<button type="submit" id="pay-button-' . $checkout_settings['hash'] . '" style="background-color: ' . $checkout_settings['buttonColor'] . '; border-radius: ' . htmlspecialchars($BUTTON_RADIUS) . ';" class="w-full p-4 text-white font-bold text-lg uppercase hover:opacity-90 flex items-center justify-center"><span>' . htmlspecialchars($checkout_settings['buttonText']) . '</span></button>';
        echo '<div class="mt-4 text-center text-sm opacity-80 flex items-center justify-center gap-2">'  . '<span>Pagamento seguro via <strong>PIX</strong> com aprovação imediata.</span></div>';
        echo '</div>';
    } elseif ($component_id === 'singleton_testimonials' && !$THREE_STEP_CHECKOUT) {
        if (!empty($all_components_map['testimonials'])) {
            echo '<div class="space-y-6">';
            foreach($all_components_map['testimonials'] as $testimonial) {
             render_checkout_component($testimonial['id'], $all_components_map, $checkout_settings, $php_globals);
            }
            echo '</div>';
        }
    } elseif (strpos($component_id, 'testimonial-') === 0 && isset($all_components_map['testimonials'][$component_id])) {
        $testimonial = $all_components_map['testimonials'][$component_id];
        echo '<div class="shadow-lg p-6" style="background-color: ' . htmlspecialchars($ELEMENT_BG_COLOR) . '; border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">';
        echo '<div class="flex items-start space-x-4">';
        if (!empty($testimonial['avatarUrl'])) {
            echo '<img src="' . htmlspecialchars($testimonial['avatarUrl']) . '" alt="' . htmlspecialchars($testimonial['author']) . '" class="w-12 h-12 rounded-full object-cover">';
        } else {
            echo '<div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-xl flex-shrink-0">' . strtoupper(substr($testimonial['author'], 0, 1)) . '</div>';
        }
        echo '<div><p class="italic opacity-80">"' . htmlspecialchars($testimonial['text']) . '"</p><p class="font-bold mt-3">- ' . htmlspecialchars($testimonial['author']) . '</p></div></div></div>';
    } elseif ($component_id === 'singleton_security_seal' && $SECURITY_SEAL_SETTINGS['enabled']) {
        $icons = [
            'shield' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.286zm0 13.036h.008v.008h-.008v-.008z" /></svg>',
            'lock' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" /></svg>',
            'academic-cap' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 21.75l-3.75-3.75m3.75 3.75V3.75m0 18l3.75-3.75M4.5 6.75A2.25 2.25 0 016.75 4.5h10.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25H6.75a2.25 2.25 0 01-2.25-2.25V6.75z" /></svg>',
            'eye-slash' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243l-4.243-4.243" /></svg>'
        ];
        echo '<div class="shadow-lg" style="background-color: ' . htmlspecialchars($SECURITY_SEAL_SETTINGS['backgroundColor'] ?? $ELEMENT_BG_COLOR) . '; border-radius: ' . htmlspecialchars($CARD_RADIUS) . ';">';
        echo '<div class="divide-y divide-gray-200">';
        foreach ($SECURITY_SEAL_SETTINGS['items'] as $item) {
            echo '<div class="p-4 flex items-center space-x-4">';
            echo '<div class="flex-shrink-0 w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center text-green-600">' . ($icons[$item['icon']] ?? '') . '</div>';
            echo '<div><h4 class="font-bold">' . htmlspecialchars($item['title']) . '</h4><p class="text-sm opacity-80">' . htmlspecialchars($item['text']) . '</p></div>';
            echo '</div>';
        }
        echo '</div></div>';
    }

    if (!$is_full_width) echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo htmlspecialchars($checkout_settings['title']); ?> - Checkout</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; color: #1f2937; -webkit-font-smoothing: antialiased; }
        .constrained-width { width: 100%; max-width: 500px; margin: 0 auto; }
        input[type="text"], input[type="email"], input[type="tel"] { width: 100%; transition: all 0.2s; }
        .loader { border: 3px solid #f3f3f3; border-radius: 50%; border-top: 3px solid <?php echo $checkout_settings['buttonColor']; ?>; width: 20px; height: 20px; -webkit-animation: spin 1s linear infinite; animation: spin 1s linear infinite; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</head>
<body class="min-h-screen pb-12">

    <form id="checkout-form" class="w-full space-y-4" onsubmit="handleFormSubmit(event)">
        <input type="hidden" name="product_hash" value="<?php echo htmlspecialchars($checkout_settings['productHash']); ?>">
        
        <?php 
        // Render Header first if it exists
        if (in_array('singleton_header', $COMPONENT_ORDER)) {
             render_checkout_component('singleton_header', $all_components_map, $checkout_settings, $php_globals);
        }
        ?>

        <div class="constrained-width px-4 space-y-4 mt-4">
            <?php
            foreach ($COMPONENT_ORDER as $componentId) {
                if ($componentId === 'singleton_header') continue;
                render_checkout_component($componentId, $all_components_map, $checkout_settings, $php_globals);
            }
            ?>
        </div>
    </form>

    <!-- PIX MODAL -->
    <div id="pix-modal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md overflow-hidden transform scale-95 transition-transform duration-300 relative">
            
            <!-- Header do Modal -->
            <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-800"><?php echo htmlspecialchars($PIX_MODAL_TITLE); ?></h3>
                <button type="button" onclick="closePixModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Corpo do Modal -->
            <div class="p-6 text-center space-y-5">
                
                <!-- Valor e Tempo -->
                <div class="flex justify-between items-center bg-blue-50 p-3 rounded-lg text-sm">
                    <div class="flex flex-col items-start">
                        <span class="text-xs text-blue-600 font-semibold uppercase tracking-wider"><?php echo htmlspecialchars($PIX_MODAL_VALUE_TEXT); ?></span>
                        <span id="pix-amount" class="text-lg font-bold text-blue-900">R$ 0,00</span>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-xs text-blue-600 font-semibold uppercase tracking-wider"><?php echo htmlspecialchars($PIX_MODAL_EXPIRATION_TEXT); ?></span>
                        <span id="pix-timer" class="text-lg font-bold text-blue-900 font-mono">15:00</span>
                    </div>
                </div>

                <!-- QR Code Area -->
                <div class="relative group">
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-2 bg-gray-50 inline-block overflow-hidden relative">
                        <img id="pix-qr-code" src="" alt="QR Code PIX" class="w-48 h-48 sm:w-56 sm:h-56 object-contain mix-blend-multiply opacity-50 blur-sm transition-all duration-500">
                        <div id="qr-loading" class="absolute inset-0 flex items-center justify-center">
                            <div class="loader"></div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">Aguardando geração do QR Code...</p>
                </div>

                <!-- Código Copia e Cola -->
                <div class="space-y-2">
                    <p class="text-sm font-medium text-gray-700 text-left w-full ml-1">Código Pix Copia e Cola</p>
                    <div class="flex shadow-sm rounded-lg overflow-hidden border border-gray-300 focus-within:ring-2 focus-within:ring-green-500 transition-all">
                        <input type="text" id="pix-code-input" readonly class="flex-grow p-3 bg-gray-50 text-gray-500 text-sm outline-none font-mono truncate" value="">
                        <button type="button" onclick="copyPixCode()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 transition-colors border-l border-gray-300 flex items-center justify-center" title="Copiar">
                           <i class="far fa-copy text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Botão Copiar Principal -->
                <button type="button" onclick="copyPixCode()" class="w-full py-3.5 px-4 rounded-xl font-bold text-white shadow-lg transform active:scale-95 transition-all flex items-center justify-center gap-2 group" style="background-color: <?php echo htmlspecialchars($PIX_MODAL_BUTTON_COLOR); ?>">
                    <span class="group-hover:animate-pulse"><?php echo htmlspecialchars($PIX_MODAL_COPY_BUTTON_TEXT); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                    </svg>
                </button>
                
                <p class="text-xs text-gray-400 flex items-center justify-center gap-1">
                    <i class="fas fa-lock text-[10px]"></i> Pagamento 100% Seguro
                </p>
            </div>
            
            <!-- Loading Overlay do Modal -->
             <div id="modal-loading-overlay" class="absolute inset-0 bg-white bg-opacity-90 flex flex-col items-center justify-center z-10 hidden">
                <div class="loader w-10 h-10 border-4 mb-3"></div>
                <p class="text-sm font-semibold text-gray-600 animate-pulse">Gerando QR Code...</p>
            </div>
        </div>
    </div>


    <script>
        // INPUT MASKING & UTILS
        const mask = {
            cpf(val) {
                return val.replace(/\D/g, '').slice(0, 11)
                    .replace(/(\d{3})(\d)/, '$1.$2')
                    .replace(/(\d{3})(\d)/, '$1.$2')
                    .replace(/(\d{3})(\d{1,2})/, '$1-$2');
            },
            phone(val) {
                return val.replace(/\D/g, '').slice(0, 11)
                    .replace(/^(\d{2})(\d)/g, '($1) $2')
                    .replace(/(\d)(\d{4})$/, '$1-$2');
            },
            cep(val) {
                return val.replace(/\D/g, '').slice(0, 8)
                    .replace(/^(\d{5})(\d)/, '$1-$2');
            }
        };

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', (e) => {
                const type = e.target.name;
                if (type === 'document') e.target.value = mask.cpf(e.target.value);
                if (type === 'phone_number') e.target.value = mask.phone(e.target.value);
                if (type === 'zip_code') e.target.value = mask.cep(e.target.value);
            });
        });

        // PIX MODAL FUNCTIONS
        const pixModal = document.getElementById('pix-modal');
        const modalContent = pixModal.querySelector('div.bg-white');
        const pixQrCodeImg = document.getElementById('pix-qr-code');
        const qrLoading = document.getElementById('qr-loading');
        const modalLoadingOverlay = document.getElementById('modal-loading-overlay');

        function openPixModal(data) {
            pixModal.classList.remove('hidden');
            // Force redraw
            void pixModal.offsetWidth; 
            pixModal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');

            document.getElementById('pix-amount').innerText = 'R$ ' + (data.amount_paid / 100).toFixed(2).replace('.', ',');
            document.getElementById('pix-code-input').value = data.pix.pix_qr_code;
            
            // Show loading on image
            pixQrCodeImg.style.opacity = '0.5';
            pixQrCodeImg.style.filter = 'blur(4px)';
            qrLoading.style.display = 'flex';
            
            // Generate QR Code Image URL (using API or service if base64 not provided directly as image)
            // Assuming the backend returns raw copy/paste code, we typically need a generator
            // PRO TIP: Use a public QR code API for display if backend doesn't provide base64 image
            const qrServiceUrl = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${encodeURIComponent(data.pix.pix_qr_code)}`;
            pixQrCodeImg.src = qrServiceUrl;
            
            pixQrCodeImg.onload = () => {
                pixQrCodeImg.style.opacity = '1';
                pixQrCodeImg.style.filter = 'none';
                qrLoading.style.display = 'none';
            };

            startPixTimer(15 * 60); // 15 minutes
        }

        function closePixModal() {
            pixModal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                pixModal.classList.add('hidden');
            }, 300);
        }
        
        function copyPixCode() {
            const input = document.getElementById('pix-code-input');
            input.select();
            input.setSelectionRange(0, 99999); /* For mobile devices */
            navigator.clipboard.writeText(input.value).then(() => {
                const btn = document.querySelector('button[onclick="copyPixCode()"]');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check"></i> Copiado!';
                btn.classList.add('bg-green-600', 'text-white');
                setTimeout(() => {
                   btn.innerHTML = originalText;
                   btn.classList.remove('bg-green-600', 'text-white');
                }, 2000);
            });
        }

        let timerInterval;
        function startPixTimer(duration) {
            clearInterval(timerInterval);
            let timer = duration, minutes, seconds;
            const display = document.getElementById('pix-timer');
            
            timerInterval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(timerInterval);
                    display.textContent = "EXPIRADO";
                    display.classList.add('text-red-600');
                }
            }, 1000);
        }


        // FORM SUBMIT HANDLER
        async function handleFormSubmit(e) {
            e.preventDefault();
            const btn = document.querySelector('button[type="submit"]');
            const originalBtnText = btn.innerHTML;
            
            // Basic Validation
            const requiredFields = document.querySelectorAll('[required]');
            let isValid = true;
            requiredFields.forEach(field => {
                if(!field.value) {
                    field.classList.add('ring-2', 'ring-red-500');
                    isValid = false;
                } else {
                    field.classList.remove('ring-2', 'ring-red-500');
                }
            });
            
            if(!isValid) {
                 alert('Por favor, preencha todos os campos obrigatórios.');
                 return;
            }

            // Loading State
            btn.disabled = true;
            btn.innerHTML = '<div class="loader border-t-white border-2 w-5 h-5"></div> Processando...';

            const formData = new FormData(e.target);
            
            try {
                const response = await fetch(window.location.href, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    openPixModal(result);
                } else {
                    alert('Erro ao processar pagamento: ' + (result.error || result.message || 'Tente novamente.'));
                }

            } catch (error) {
                console.error(error);
                alert('Ocorreu um erro na comunicação. Verifique sua conexão.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalBtnText;
            }
        }
        
        // Order Bump Logic
        document.querySelectorAll('.order-bump-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateTotals);
        });

        // Coupon Logic (Simplified)
        document.getElementById('apply-coupon-btn-<?php echo $checkout_settings['hash']; ?>')?.addEventListener('click', async () => {
            const input = document.getElementById('coupon-code-<?php echo $checkout_settings['hash']; ?>');
            const code = input.value;
            const msg = document.getElementById('coupon-message-<?php echo $checkout_settings['hash']; ?>');
            
            if(!code) return;
            
            // Call same PHP file with GET action
            try {
                const res = await fetch(`?action=validate_coupon&code=${code}`);
                const data = await res.json();
                
                if(data.success) {
                    msg.textContent = `Cupom aplicadO: ${data.coupon.code} (Desconto: ${data.coupon.value}${data.coupon.type === 'percentage' ? '%' : 'R$'})`;
                    msg.className = 'text-green-600 text-sm mt-2 font-bold';
                    updateTotals(); // You might need to implement global coupon state if not using session, assuming simple frontend calculation for display
                } else {
                    msg.textContent = 'Cupom inválido.';
                    msg.className = 'text-red-500 text-sm mt-2';
                }
            } catch(e) {
                console.error(e);
            }
        });

        function updateTotals() {
            // This would need to replicate the PHP logic in JS to update the "Total" display dynamically
            // For brevity in this snippet, we leave it as a placeholder or implementing simple sum
            const basePrice = <?php echo 1000; ?>; // 10.00
            let total = basePrice;
            
            document.querySelectorAll('.order-bump-checkbox:checked').forEach(cb => {
                total += parseInt(cb.dataset.price);
            });
            
            const totalElement = document.getElementById('total-price-<?php echo $checkout_settings['hash']; ?>');
            if(totalElement) {
                totalElement.innerText = 'R$ ' + (total/100).toFixed(2).replace('.', ',');
            }
        }
    </script>
</body>
</html>
