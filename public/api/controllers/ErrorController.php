<?php

class ErrorController{
   public static function handler($erro){
      http_response_code(500);
      
      echo json_encode([
         'codigo' => $erro->getCode(),
         'mensagem' => $erro->getMessage(),
         'arquivo' => $erro->getFile(),
         'linha' => $erro->getLine()
      ]);
   }
}