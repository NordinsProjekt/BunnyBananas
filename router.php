<?php

$request = $_SERVER['REQUEST_URI'];


$washedRequest = explode('/?', $_SERVER['REQUEST_URI']);

// echo var_dump($washedRequest);

switch ($washedRequest[0]) {
    
    case '/' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case '/about' :
        require __DIR__ . '/views/about.php';
        break;
    case '/admin' :
        require __DIR__ . '/admin/index.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}

?>