<?php

if (!isset($_GET['url']))
{
    $_GET['url'] = "";
}
switch ($_GET['url']) {
    case '':
        require_once __DIR__ . '/views/index.php';
        break;
    case 'cart':
        require __DIR__ . '/views/cart.php';
        break;
    case 'checkout':
        require __DIR__ . '/views/checkout.php';  
        break;
    case 'product':
        require __DIR__ . '/views/product.php';
        break;
        case 'search':
            require __DIR__ . '/views/searchresult.php';
            break;
    case 'admin':
        $controller = new UserController();
        if ($controller->VerifyUserAdmin()) {
            require_once __DIR__ . '/views/admin.php';
        }
        else {
            require_once __DIR__ . '/views/index.php';
        }
        break;
        
    case 'profile':
        if (key_exists('is_logged_in', $_SESSION)) {
            require_once __DIR__ . '/views/profile.php';
        }
        else {
            require_once __DIR__ . '/views/index.php';
        }
        break;
    case 'signout':
        require_once __DIR__ . '/views/index.php';
        break;
    case 'signup':
        if (key_exists('userId',$_SESSION))
        {
            require_once __DIR__ . '/views/index.php';
        }
        else
        {
            require_once __DIR__ . '/views/signup.php';
        }
        break;
    default:

        header("Location: /bunnybananas");
        break;
}
?>