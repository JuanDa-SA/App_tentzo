<?php

function insertTorneo(object $pdo, array $torneo){
    $query ="INSERT INTO topos_torneo (nombre, cantidad_equipos) values(:nombre, :cantidad_equipos);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $torneo["nombre_torneo"]);
    $stmt->bindParam(":cantidad_equipos", $torneo["cantidad_equipos"]);
    $stmt->execute();
}
function searchID(object $pdo, array $equipo){
    $query = "SELECT id_equipo FROM topos_equipo WHERE nombre_equipo = :nombre";
     $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $equipo["nombre_equipo"]);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}