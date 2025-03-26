<?php

class DatabaseController {
   public function query($query){
      $connect = mysqli_connect(
         'db',
         'viniroveri',
         '123456',
         'database'
      );
      
      $resposta = mysqli_query($connect, $query);

      $rows = [];
        
      while ($row = mysqli_fetch_assoc($resposta)) {
         $rows[] = $row;
      }
        
      return $rows;
   }

   public function executar($query){
      $connect = mysqli_connect(
         'db',
         'viniroveri',
         '123456',
         'database'
      );
      
      mysqli_query($connect, $query);
   }
}