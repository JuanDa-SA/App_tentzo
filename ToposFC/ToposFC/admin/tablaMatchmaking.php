<?php
// Configuración de la conexión a la base de datos
require_once '../includes/database.php';



try {
    // Crear conexión
    
    // Obtener el id del torneo seleccionado
    $id_torneo = $_GET['torneo'];


    $sql3 = " SELECT
     E.id_encuentro as id,
     EL.nombre_equipo AS equipo_local,
     EV.nombre_equipo AS equipo_visitante,
     E.fecha,
     E.hora,
     A.nombre AS arbitro
 FROM
     topos_encuentro E
 JOIN
     topos_equipo EL ON E.id_equipo_local = EL.id_equipo
 JOIN
     topos_equipo EV ON E.id_equipo_visitante = EV.id_equipo
 JOIN
     topos_arbitros A ON E.id_arbitro = A.id_arbitro
 WHERE
     EL.id_torneo = :id_torneo OR
     EV.id_torneo = :id_torneo;";
     $stmt3 = $pdo->prepare($sql3);
     $stmt3->bindParam(':id_torneo', $id_torneo, PDO::PARAM_INT);
     $stmt3->execute();
     $resultados3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);

     
     echo "<div class='contenedor formulario mt-5 pe-5 ps-5'>";

    if (!empty($resultados3)) {
        echo "<div class='table-responsive'>";
        echo '<h2 class="titulo">Horario de partidos</h2>';
        echo '<div class="table-responsive">'; // Añadir clase aquí
        echo '<table class="table tabla">'; // Añadir clases Bootstrap para estilos
        echo '<thead>';
        echo '<tr>';
        echo '<th></th>';
        echo '<th scope="col">Equipo Local</th>';
        echo '<th scope="col">Equipo Visitante</th>';
        echo '<th scope="col">Fecha A/M/D</th>';
        echo '<th scope="col">Hora (24hrs)</th>';
        echo '<th scope="col">Arbitro</th>';
        echo '<th scope="col"></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($resultados3 as $fila) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($fila['id']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['equipo_local']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['equipo_visitante']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['fecha']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['hora']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['arbitro']) . '</td>';
            echo '<td><a class="boton boton--azul" href="modificarEncuentro.php?id='.$fila['id'].'">Modificar</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>'; // Cerrar div
    }else {
            echo 'No se encontraron resultados para matchmaking en el torneo seleccionado.';
        }



// 



} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
// Generar la tabla HTML para la segunda consulta

echo "</div>";

    
?>
