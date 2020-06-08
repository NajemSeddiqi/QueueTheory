<?php
include_once("./models/prodModel.php");
include_once("./controllers/prodController.php");
//innehålls typ som skickas
header('Content-Type: application/json');
//webläsare eller ingripande proxy server kommer inte att kunna
//cacha sidan, så användare får alltid det senaste innehållet
header("Content-Control: no-cache, must-revalidate, no-store");
header("Expires: -1");
$pathinfo=explode('/', $_SERVER['PATH_INFO']);
$controller=new $pathinfo[1]();
$method=$pathinfo[2];
if(empty($pathinfo[3])) {
    $method=$pathinfo[2];
    echo $controller->{$method}();
} else {
    $method=$pathinfo[2];
    $parameter=$pathinfo[3];
    echo $controller->{$method}($parameter);
}

?>
