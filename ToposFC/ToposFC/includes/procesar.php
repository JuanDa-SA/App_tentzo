<?php
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jugadorId = intval($_POST['jugador']);
    $goles = intval($_POST['goles']);

    try {
        // Verificar si ya existe el registro para el jugador en la tabla de goleo
        $query = "SELECT id_tabla_goleo, goles FROM topos_tabla_goleo WHERE id_jugador = :jugadorId";
        $stmt =  $pdo->prepare($query);
        $stmt->execute(['jugadorId' => $jugadorId]);

        if ($stmt->rowCount() > 0) {
            // Si existe, actualizar los goles
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $nuevosGoles = $row['goles'] + $goles;
            $updateQuery = "UPDATE topos_tabla_goleo SET goles = :goles WHERE id_jugador = :jugadorId";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->execute(['goles' => $nuevosGoles, 'jugadorId' => $jugadorId]);
        } else {
            // Si no existe, insertar un nuevo registro
            $insertQuery = "INSERT INTO topos_tabla_goleo (id_jugador, goles) VALUES (:jugadorId, :goles)";
            $insertStmt = $pdo->prepare($insertQuery);
            $insertStmt->execute(['jugadorId' => $jugadorId, 'goles' => $goles]);
        }

        header('Location: ../admin/actualizar_goleo.php');
        exit();

    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error: " . $e->getMessage();
    }
}