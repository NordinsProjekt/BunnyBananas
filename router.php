<?php

require_once('User.Controller.php');

//$request = $_SERVER['REQUEST_URI'];

//var_dump (parseUrl());
//$washedRequest = explode('/?', $_SERVER['REQUEST_URI']);

//echo var_dump($washedRequest);
switch (parseUrl()[0]) {
    
    case 'NULL' :
        require __DIR__ . '/views/index.php';
        break;
    case '' :
        require __DIR__ . '/views/index.php';
        break;
    case 'about' :
        require __DIR__ . '/views/about.php';
        break;
    case 'admin' :
        require __DIR__ . '/admin/index.php';
        $controller = new UserController();
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}

function parseUrl()
{
    //Löser splittningen
    //löser inte riktiga folder och filer.
    if(isset($_GET['url']))
    {
        $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        var_dump($url);
        if ($url == NULL)
        {
            return array("");
        }
        return $url;
    }
    else
    {
        return array("");
    }
}
?>