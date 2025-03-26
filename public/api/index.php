<?php

header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
date_default_timezone_set("America/Sao_Paulo");

spl_autoload_register(function($classe){
   require __DIR__ . "/controllers/$classe.php";
});

set_exception_handler('ErrorController::handler');

$metodo = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];

$partesUrl = explode('/', $url);

$controller;

switch($partesUrl[2]){
   case 'tasks':
      $controller = new TarefasController();
      break;
   default:
      http_response_code(404);
      break;
};

$controller->processar($metodo, $partesUrl);