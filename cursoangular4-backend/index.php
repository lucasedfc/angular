<?php
require_once "vendor/autoload.php";

$app = new \Slim\Slim();

$app->get("/pruebas", function() use($app){
    echo "Hola mundo desde Slim PHP";
});

$app->get("/probando", function() use($app){
    echo "Otro texto cualquiera";
});

$app->run();
