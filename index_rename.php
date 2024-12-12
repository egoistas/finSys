<?php

$request = $_SERVER['REQUEST_URI'];
$viewDir = '/views/';
$templateDir = '/templates/';
$includesDir = '/includes/';
// Χρησιμοποιούμε τη συνάρτηση parse_url για να αναλύσουμε το URL και να πάρουμε μόνο το μονοπάτι της διαδρομής
$requestPath = parse_url($request, PHP_URL_PATH);

switch ($requestPath) {
    case '/ptixiaki':
    case '/ptixiaki/':
        require __DIR__ . $viewDir . 'home.php';
        break;

    case '/views/public_tender':
        require __DIR__ . $viewDir . 'public_tender_view.php';
        break;

    case '/views/contract':
        require __DIR__ . $viewDir . 'contract_view.php';
        break;
    
    case '/views/framework_agreement':
        require __DIR__ . $viewDir . 'framework_agreement_view.php';
        break;
    
    case '/views/awarding_contractor':
        require __DIR__ . $viewDir . 'awarding_contractor_view.php';
        break;
    
    case '/views/temp_contractor':
        require __DIR__ . $viewDir . 'temp_contractor_view.php';
        break;

    case '/views/permanent_reception':
        require __DIR__ . $viewDir . 'permanent_reception_view.php';
        break;

    case '/views/403':
        require __DIR__ . $viewDir . 'error_403.php';
        break;

    case '/views/503':
        require __DIR__ . $viewDir . 'error_503.php';
        break;
    
    case '/views/login':
        require __DIR__ . $viewDir . 'login.php';
        break;
    
    case '/views/logout':
        require __DIR__ . $viewDir . 'logout.php';
        break;
    
    case '/views/logout_confirmation':
        require __DIR__ . $viewDir . 'logout_confirmation.php';
        break;
    
    case '/views/register':
        require __DIR__ . $viewDir . 'register.php';
        break;        
    
    default:
        http_response_code(404);
        require __DIR__ . $viewDir . 'error_404.php';
}
require __DIR__ . '/../templates/footer.php';
?>
