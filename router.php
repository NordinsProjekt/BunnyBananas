<?php
require_once('User.Controller.php');
require_once('Order.Controller.php');
require_once('Products.Controller.php');
require_once('Cart.Controller.php');
require_once('Upload.Controller.php');

switch (parseUrl()) {
    case '':
        require_once __DIR__ . '/views/index.php';
        break;
    case 'about':
        require_once __DIR__ . '/views/about.php';
        break;
    case 'orders':
        require __DIR__ . '/views/orders.php';
        break;
    case 'products' :
        require __DIR__ . '/views/products.php';
        break;
    case 'cart':
        require __DIR__ . '/views/cart.php';
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
    case 'admin/user':
        $controller = new UserController();
        if ($controller->VerifyUserAdmin()) {
            require_once __DIR__ . '/views/admin/users.php';
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
    
    case 'signup':
        require_once __DIR__ . '/views/signup.php';
        break;
    case 'test':
        require_once __DIR__ . '/views/upload.php';
        break;
    default:
    require_once __DIR__ . '/views/index.php';
        break;
}

function parseUrl()
{
    //Löser splittningen
    //löser inte riktiga folder och filer.
    if (isset($_GET['url'])) {
        //$url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        //var_dump($url);
        $url = $_GET['url'];
        if ($url == NULL) {
            return array("");
        }
        return $url;
    }
    else {
        return array("");
    }
}
?>