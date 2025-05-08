<?php
declare(strict_types=1);

function is_input_empty($c1){
   if(empty($c1)){
      return true;
   }else{
      return false;
   }
}

function getIDJugador(object $pdo,int $id, array $jugador){
   $id = searchIDJugador($pdo,$id, $jugador);
   return $id;
}

function  registrarJugadorCapitan(object $pdo, int $id, array $jugador, array $capitan){
   insertJugador($pdo, $id, $jugador);
   
   $id_jugador = getIDJugador($pdo,$id, $jugador);
   insertCapitan($pdo, $id_jugador, $capitan);
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

function jugador_existe(object $pdo, string $nombre_capitan, string $apellido_capitan, string $apellido2_capitan, int $edad, string $colonia){
   if (!searchJugador($pdo, $nombre_capitan, $apellido_capitan, $apellido2_capitan, $edad, $colonia)){

      return false;
  }
  else{
      return true;
  }
}