<?php
require_once "../includes/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['torneo']) && !empty($_POST['torneo'])) {
        $id_torneo_seleccionado = $_POST['torneo'];

        $sql3 = "SELECT
                    E.id_encuentro AS id,
                    EL.nombre_equipo AS equipo_local,
                    EV.nombre_equipo AS equipo_visitante,
                    E.fecha,
                    E.hora
                FROM
                    topos_encuentro E
                JOIN
                    topos_equipo EL ON E.id_equipo_local = EL.id_equipo
                JOIN
                    topos_equipo EV ON E.id_equipo_visitante = EV.id_equipo
                WHERE
                    EL.id_torneo = :id_torneo OR
                    EV.id_torneo = :id_torneo;";
        $stmt3 = $pdo->prepare($sql3);
        $stmt3->bindParam(':id_torneo', $id_torneo_seleccionado, PDO::PARAM_INT);
        $stmt3->execute();
        $resultados3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($resultados3);
    }
}
?>
