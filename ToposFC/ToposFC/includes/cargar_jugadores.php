<?php
require_once "database.php";

if (isset($_POST['equipo'])) {
    $equipoId = intval($_POST['equipo']);
    $query = "SELECT id_jugador, nombre, apellido_paterno, apellido_materno FROM topos_jugador WHERE id_equipo = :equipoId";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['equipoId' => $equipoId]);


    $options = "<option value=''>Seleccione un jugador</option>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $options .= "<option value='" . $row['id_jugador'] . "'>" . $row['nombre'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno'] . "</option>";
    }
    echo $options;
}

