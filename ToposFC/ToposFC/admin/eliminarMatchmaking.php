<?php
// Configuración de la conexión a la base de datos
require_once '../includes/database.php';

try {
    // Crear conexión
    
    // Obtener el id del torneo seleccionado
    $id_torneo = $_GET['id'];
    // Consulta SQL para eliminar los encuentros del torneo seleccionado
    $sql = "DELETE encuentro
            FROM topos_encuentro AS encuentro
            JOIN topos_equipo AS local ON encuentro.id_equipo_local = local.id_equipo
            JOIN topos_equipo AS visitante ON encuentro.id_equipo_visitante = visitante.id_equipo
            WHERE local.id_torneo = :id_torneo
            AND visitante.id_torneo = :id_torneo";

    // Preparar la consulta
    $stmt = $pdo->prepare($sql);

    // Vincular parámetros
    $stmt->bindParam(':id_torneo', $id_torneo, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    $stmt2 = $pdo->prepare("UPDATE topos_torneo SET estado = '0' WHERE id_torneo = :id");
    $stmt2->bindParam(':id', $id_torneo);
    $stmt2->execute();        
    header("Location: AdministrarTorneo.php");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}