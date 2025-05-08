<?php

function insertJugador(object $pdo, int $id,array $jugador){
    $query ="INSERT INTO topos_jugador (nombre, apellido_paterno, apellido_materno,numero,id_equipo) values(:nombre,:apellido_paterno, :apellido_materno, :numero, :id_equipo);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $jugador["nombre_capitan"]);
    $stmt->bindParam(":apellido_paterno", $jugador["apellido1"]);
    $stmt->bindParam(":apellido_materno", $jugador["apellido2"]);
    $stmt->bindParam(":numero", $jugador["numero_camiseta"]);
    $stmt->bindParam(":id_equipo", $id);
    $stmt->execute();
}

function searchIDJugador(object $pdo,int $id, array $jugador){
    $query = "SELECT id_jugador FROM topos_jugador WHERE nombre = :nombre AND apellido_paterno = :apellido_paterno AND apellido_materno = :apellido_materno AND numero = :numero AND id_equipo = :id_equipo";
     $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $jugador["nombre_capitan"]);
    $stmt->bindParam(":apellido_paterno", $jugador["apellido1"]);
    $stmt->bindParam(":apellido_materno", $jugador["apellido2"]);
    $stmt->bindParam(":numero", $jugador["numero_camiseta"]);
    $stmt->bindParam(":id_equipo", $id);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}

function insertCapitan(object $pdo, int $id,array $capitan){
    $query = "INSERT INTO topos_capitan (id_capitan,id_jugador, numeroCapitan, correo) values (null, :id_jugador, :numeroCapitan, :correo);";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_jugador", $id);
    
    $stmt->bindParam(":numeroCapitan", $capitan["contacto"]);
    $stmt->bindParam(":correo", $capitan["correo"]);
    $stmt->execute();
}
function searchCelular(object $pdo, string $celular){
    $query = "SELECT id_jugador FROM topos_jugador WHERE telefono = :telefono;";
        $stmt = $pdo->prepare($query);
    $stmt->bindParam(":telefono", $celular , PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
    
}
function searchCorreo(object $pdo, string $correo){
    $query = "SELECT id_jugador FROM topos_jugador WHERE correo = :correo;";
        $stmt = $pdo->prepare($query);
    $stmt->bindParam(":correo", $correo , PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}

function searchJugador(object $pdo, string $nombre_capitan, string $apellido_capitan, string $apellido2_capitan, int $edad, string $colonia ){
    $query = "SELECT id_jugador FROM topos_jugador WHERE nombre = :nombre AND apellido_paterno = :apellido_paterno AND apellido_materno = :apellido_materno AND colonia = :colonia AND edad = :edad";
     $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $nombre_capitan);
    $stmt->bindParam(":apellido_paterno", $apellido_capitan);
    $stmt->bindParam(":apellido_materno", $apellido2_capitan);
    $stmt->bindParam(":edad", $edad);
    $stmt->bindParam(":colonia", $colonia);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}