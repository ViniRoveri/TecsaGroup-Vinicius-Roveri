<?php

class ErrorController{
   public static function handleException($erro){
      http_response_code(500);
      
      echo json_encode([
         'codigo' => $erro->getCode(),
         'mensagem' => $erro->getMessage(),
         'arquivo' => $erro->getFile(),
         'linha' => $erro->getLine()
      ]);
   }

   public static function handleError($codigo, $mensagem, $arquivo, $linha){
      throw new ErrorException($mensagem, 0, $codigo, $arquivo, $linha);
   }
}