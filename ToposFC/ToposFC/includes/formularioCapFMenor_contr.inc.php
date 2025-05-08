<?php
declare(strict_types=1);

function is_input_empty($c1){
   if(empty($c1)){
      return true;
   }else{
      return false;
   }
}
function is_img_empty($imagen){
   return $imagen['error'] == 4;
}
function getIDJugador(object $pdo,int $id, array $jugador){
   $id = searchIDJugador($pdo,$id, $jugador);
   return $id;
}

function  registrarJugadorCapitan(object $pdo, int $id, array $jugador,){
   insertJugador($pdo, $id, $jugador);
   
   $id_jugador = getIDJugador($pdo,$id, $jugador);
   insertCapitan($pdo, $id_jugador);
}

function registrarEquipo(object $pdo, array $equipo){
   
    insertEquipo($pdo, $equipo);
 }
 
 function getID(object $pdo, array $equipo){
    $id = searchID($pdo, $equipo);
    return $id;
 }


function registrarJugador(object $pdo, int $id,array $jugador){
    insertJugador($pdo, $id, $jugador);
 }