<?php

class TarefasController{
   public function processar($metodo, $partesUrl){
      $database = new DatabaseController();

      $id = array_key_exists(3, $partesUrl) ? $partesUrl[3] : null;

      switch($metodo){
         case 'GET':
            $this->get($database, $id);
            break;
         case 'POST':
            $this->post($database);
            break;
         case 'PUT':
            $this->put($database, $id);
            break;
         case 'DELETE':
            $this->delete($database, $id);
            break;
      };
   }

   private function get($database, $id){
      if($id == null){
         echo json_encode($database->query('SELECT * FROM tarefas ORDER BY created_at', []));
      }else{
         $resposta = $database->query('SELECT * FROM tarefas WHERE id = ?', [$id]);

         if(count($resposta) != 0){
            echo json_encode($resposta[0]);
         }else{
            echo json_encode(null);
         }
      };
   }

   private function post($database){
      $body = (array) json_decode(file_get_contents('php://input'), true);

      if(count($body) == 0){
         return;
      }

      $tempoAtual = date('Y-m-d');

      $query = "INSERT INTO tarefas (title, description, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";

      $database->executar($query, [$body['title'], $body['description'], $body['status'], $tempoAtual, $tempoAtual]);
      echo json_decode(true);
   }

   private function put($database, $id){
      $body = (array) json_decode(file_get_contents('php://input'), true);

      if(count($body) == 0){
         return;
      }

      $tempoAtual = date('Y-m-d');

      $query = "UPDATE tarefas SET 
      title = ?, description = ?, status = ?, updated_at = ?
      WHERE id = ?";

      $database->executar($query, [$body['title'], $body['description'], $body['status'], $tempoAtual, $id]);
      echo json_decode(true);
   }

   private function delete($database, $id){
      $database->executar('DELETE FROM tarefas WHERE id = ?', [$id]);
      echo json_decode(true);
   }
}