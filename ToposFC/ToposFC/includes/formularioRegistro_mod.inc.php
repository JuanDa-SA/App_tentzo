<?php

function insertEquipo(object $pdo, array $equipo){
    $query ="INSERT INTO topos_equipo (nombre_equipo, id_torneo) values(:nombre, :id_torneo);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $equipo["nombre_equipo"]);
    $stmt->bindParam(":id_torneo", $equipo["torneo"]);
    $stmt->execute();
}
function searchID(object $pdo, int $torneo, string $nombre_equipo){
    $query = "SELECT id_equipo FROM topos_equipo WHERE nombre_equipo = :nombre AND id_torneo = :id_torneo";
     $stmt = $pdo->prepare($query);
    $stmt->bindParam(":nombre", $nombre_equipo , PDO::PARAM_STR);
    $stmt->bindParam(":id_torneo", $torneo);
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return $result;
}
