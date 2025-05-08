<?php

function insertEquipo(object $pdo, array $equipo){
   
    $query ="INSERT INTO topos_equipo (nombre_equipo, id_torneo,logo) values(:nombre, :id_torneo, :logo);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $equipo["nombre_equipo"]);
    $stmt->bindParam(":id_torneo", $equipo["torneo"]);
    // Comprobar si el logo está vacío y asignar NULL si es necesario
   
    if (!empty($equipo["logo"])) {
        $stmt->bindParam(":logo", $equipo["logo"]);
    } else {
        $logo = null;
        $stmt->bindParam(":logo", $logo, PDO::PARAM_NULL);
    }
    $stmt->execute();
}
function searchID(object $pdo, array $equipo){
    $query = "SELECT id_equipo FROM topos_equipo WHERE nombre_equipo = :nombre AND id_torneo = :torneo";
     $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $equipo["nombre_equipo"]);
    $stmt->bindParam(":torneo", $equipo["torneo"]);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}

function insertJugador(object $pdo, int $id,array $jugador){
    $query ="INSERT INTO topos_jugador (id_jugador, nombre, apellido_paterno, apellido_materno,numero,id_equipo, edad, colonia, telefono, correo, tutor, permiso_imagen) values(null, :nombre,:apellido_paterno, :apellido_materno, :numero, :id_equipo,:edad, :colonia, :telefono, :correo, :tutor, :permiso_imagen);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $jugador["nombre_capitan"]);
    $stmt->bindParam(":apellido_paterno", $jugador["apellido1"]);
    $stmt->bindParam(":apellido_materno", $jugador["apellido2"]);
    $stmt->bindParam(":numero", $jugador["numero_camiseta"]);
    $stmt->bindParam(":id_equipo", $id);
    $stmt->bindParam(":edad", $jugador["edad"]);
    $stmt->bindParam(":colonia", $jugador["colonia"]);
    $stmt->bindParam(":telefono", $jugador["contacto"]);
    $stmt->bindParam(":correo", $jugador["correo"]);
    if (!empty($jugador["tutor"])) {
        $stmt->bindParam(":tutor", $jugador["tutor"]);
    } else {
        $logo = null;
        $stmt->bindParam(":tutor", $logo, PDO::PARAM_NULL);
    }
    $stmt->bindParam(":permiso_imagen", $jugador["permisoImagen"]);
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

function insertCapitan(object $pdo, int $id,){
    $query = "INSERT INTO topos_capitan (id_capitan,id_jugador) values (null, :id_jugador);";
    
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_jugador", $id);
    $stmt->execute();
}
