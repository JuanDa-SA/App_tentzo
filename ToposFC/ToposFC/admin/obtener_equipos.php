<?php
require_once "../includes/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['encuentro']) && !empty($_POST['encuentro'])) {
        $id_encuentro_seleccionado = $_POST['encuentro'];

        // Consulta para obtener los equipos del encuentro seleccionado
        $sql = "SELECT
                    E.id_equipo AS id,
                    E.nombre_equipo
                FROM
                    topos_equipo E
                JOIN
                    topos_encuentro TE ON (TE.id_equipo_local = E.id_equipo OR TE.id_equipo_visitante = E.id_equipo)
                WHERE
                    TE.id_encuentro = :id_encuentro";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_encuentro', $id_encuentro_seleccionado, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($resultados);
    }
}
