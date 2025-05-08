<?php
declare(strict_types=1);

function is_input_empty($c1){
     if(empty($c1)){
        return true;
     }else{
        return false;
     }
}

function registrarTorneo(object $pdo, array $torneo){
   insertTorneo($pdo, $torneo);
}

function getID(object $pdo, array $equipo){
   $id = searchID($pdo, $equipo);
   return $id;
}