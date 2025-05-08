<?php
declare(strict_types=1);

function is_input_empty($c1){
     if(empty($c1)){
        return true;
     }else{
        return false;
     }
}

function registrarEquipo(object $pdo, array $equipo){
   insertEquipo($pdo, $equipo);
}

function getID(object $pdo, array $equipo){
   $id = searchID($pdo, $equipo);
   return $id;
}

function equipo_existe(object $pdo, int $torneo, string $nombre_equipo ){
   if (!searchID($pdo,$torneo, $nombre_equipo)){
      return false;
  }
  else{
      return true;
  }
}