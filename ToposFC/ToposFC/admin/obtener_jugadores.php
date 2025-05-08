<?php
require_once "../includes/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['equipo']) && !empty($_POST['equipo'])) {
        $id_equipo_seleccionado = $_POST['equipo'];

        $sql = "SELECT
                    J.id_jugador AS id,
                    J.nombre,
                    J.apellido_paterno
                FROM
                    topos_jugador J
                WHERE
                    J.id_equipo = :id_equipo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_equipo', $id_equipo_seleccionado, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($resultados);
    }
}