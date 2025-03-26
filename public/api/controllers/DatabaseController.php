<?php

class DatabaseController {
   public function query($query, $params){
      $connect = mysqli_connect(
         'db',
         'viniroveri',
         '123456',
         'database'
      );

      $resposta = $connect->execute_query($query, $params);
      
      $rows = [];
        
      while ($row = mysqli_fetch_assoc($resposta)) {
         $rows[] = $row;
      }
        
      return $rows;
   }

   public function executar($query, $params){
      $connect = mysqli_connect(
         'db',
         'viniroveri',
         '123456',
         'database'
      );
      
      $connect->execute_query($query, $params);
   }
}