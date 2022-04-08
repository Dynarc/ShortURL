<?php
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once 'Controllers/Main.controller.php';
$controller = new Controller;

if(empty($_GET['page'])){
    if(empty($_GET['url'])) {
        require_once 'Views/Accueil.view.php';
    } else {
        $controller->generateLink($_GET['url']);
    }

} else{

    $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);

    try {

        if($url[0]){
            $controller->redirectLink($url[0]);
        }

    }catch (Exception $e){
        $test = $e->getMessage();
        echo $test;
    }
}