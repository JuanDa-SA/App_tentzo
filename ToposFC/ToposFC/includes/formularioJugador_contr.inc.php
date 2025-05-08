<?php
declare(strict_types=1);

function is_input_empty($c1){
     if(empty($c1)){
        return true;
     }else{
        return false;
     }
}

function registrarJugador(object $pdo, int $id,array $jugador){
   insertJugador($pdo, $id, $jugador);
}

function celular_existe(object $pdo, string $parametro){
   if (!searchCelular($pdo,$parametro)){

      return false;
  }
  else{
      return true;
  }
}

function correo_existe(object $pdo, string $parametro){
   if (!searchCorreo($pdo,$parametro)){

      return false;
  }
  else{
      return true;
  }
}

function jugador_existe(object $pdo, string $nombre_capitan, string $apellido_capitan, string $apellido2_capitan, int $edad, string $colonia, int $id){
   if (!searchJugador($pdo, $nombre_capitan, $apellido_capitan, $apellido2_capitan, $edad, $colonia, $id)){

      return false;
  }
  else{
      return true;
  }
}