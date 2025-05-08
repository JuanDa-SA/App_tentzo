<?php
// Configuración de la conexión a la base de datos

require 'includes/database.php';

try {
    // Crear conexión

    // Obtener el id del torneo seleccionado
    $id_torneo = $_GET['torneo'];


    $sql3 = " SELECT
     E.id_encuentro,
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
        echo '<th scope="col">Equipo Local</th>';
        echo '<th scope="col">Equipo Visitante</th>';
        echo '<th scope="col">Fecha</th>';
        echo '<th scope="col">Hora</th>';
        echo '<th scope="col">Arbitro</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($resultados3 as $fila) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($fila['equipo_local']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['equipo_visitante']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['fecha']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['hora']) . '</td>';
            echo '<td>' . htmlspecialchars($fila['arbitro']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>'; // Cerrar div
    }else {
            echo 'No se encontraron resultados para el matchmaking del torneo seleccionado.';
        }



    $sql1="SELECT
    equipo.id_equipo,
    equipo.nombre_equipo,
    SUM(CASE 
        WHEN enc.goles_local > enc.goles_visitante AND enc.id_equipo_local = equipo.id_equipo THEN 1
        WHEN enc.goles_visitante > enc.goles_local AND enc.id_equipo_visitante = equipo.id_equipo THEN 1
        ELSE 0
    END) AS victorias,
    SUM(CASE 
        WHEN enc.goles_local = enc.goles_visitante AND (enc.id_equipo_local = equipo.id_equipo OR enc.id_equipo_visitante = equipo.id_equipo) THEN 1
        ELSE 0
    END) AS empates,
    SUM(CASE 
        WHEN enc.goles_local < enc.goles_visitante AND enc.id_equipo_local = equipo.id_equipo THEN 1
        WHEN enc.goles_visitante < enc.goles_local AND enc.id_equipo_visitante = equipo.id_equipo THEN 1
        ELSE 0
    END) AS derrotas,
    SUM(CASE WHEN enc.id_equipo_local = equipo.id_equipo THEN enc.goles_local ELSE enc.goles_visitante END) AS goles_favor,
    SUM(CASE WHEN enc.id_equipo_local = equipo.id_equipo THEN enc.goles_visitante ELSE enc.goles_local END) AS goles_contra,
    3 * SUM(CASE 
        WHEN enc.goles_local > enc.goles_visitante AND enc.id_equipo_local = equipo.id_equipo THEN 1
        WHEN enc.goles_visitante > enc.goles_local AND enc.id_equipo_visitante = equipo.id_equipo THEN 1
        ELSE 0
    END) +
    SUM(CASE 
        WHEN enc.goles_local = enc.goles_visitante AND (enc.id_equipo_local = equipo.id_equipo OR enc.id_equipo_visitante = equipo.id_equipo) THEN 1
        ELSE 0
    END) +
    SUM(CASE 
        WHEN enc.ganador_penales IS NOT NULL AND enc.ganador_penales <> 'null' AND ((enc.ganador_penales = 'local' AND equipo.id_equipo = enc.id_equipo_local) OR (enc.ganador_penales = 'visitante' AND equipo.id_equipo = enc.id_equipo_visitante)) THEN 1
        ELSE 0
    END) AS puntos,
    SUM(CASE WHEN enc.id_equipo_local = equipo.id_equipo THEN enc.goles_local ELSE enc.goles_visitante END) -
    SUM(CASE WHEN enc.id_equipo_local = equipo.id_equipo THEN enc.goles_visitante ELSE enc.goles_local END) AS diferencia_goles,
    SUM(CASE 
        WHEN enc.ganador_penales IS NOT NULL AND enc.ganador_penales <> 'null' AND ((enc.ganador_penales = 'local' AND equipo.id_equipo = enc.id_equipo_local) OR (enc.ganador_penales = 'visitante' AND equipo.id_equipo = enc.id_equipo_visitante)) THEN 1
        ELSE 0
    END) AS puntos_penales
FROM
    topos_equipo equipo
LEFT JOIN
    (SELECT
        enc.id_encuentro,
        enc.id_equipo_local,
        enc.id_equipo_visitante,
        SUM(CASE WHEN j.id_equipo = enc.id_equipo_local THEN 1 ELSE 0 END) AS goles_local,
        SUM(CASE WHEN j.id_equipo = enc.id_equipo_visitante THEN 1 ELSE 0 END) AS goles_visitante,
        enc.ganador_penales
    FROM
        topos_eventos_encuentro ee
    JOIN
        topos_evento e ON ee.id_estadistica = e.id_evento
    JOIN
        topos_encuentro enc ON ee.id_encuentro = enc.id_encuentro
    JOIN
        topos_jugador j ON ee.id_jugador = j.id_jugador
    WHERE
        e.tipo = 'Gol'
    GROUP BY
        enc.id_encuentro, enc.id_equipo_local, enc.id_equipo_visitante, enc.ganador_penales) AS enc ON enc.id_equipo_local = equipo.id_equipo OR enc.id_equipo_visitante = equipo.id_equipo
WHERE
    equipo.id_torneo = 1 AND equipo.estado = 1
GROUP BY
    equipo.id_equipo, equipo.nombre_equipo
ORDER BY
    puntos DESC, diferencia_goles DESC, goles_favor DESC;

";

    // Preparar y ejecutar la primera consulta
    $stmt1 = $pdo->prepare($sql1);
    // $stmt1->bindParam(':id_torneo', $id_torneo, PDO::PARAM_INT);
    $stmt1->execute();
    $resultados1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

//     // Segunda consulta SQL para estadísticas de jugadores
    $sql2 = "

    SELECT 
    j.nombre AS nombre_jugador,
    j.apellido_paterno as paterno,
    j.apellido_materno as materno,
    COUNT(tee.id_estadistica) AS goles,
    e.nombre_equipo AS nombre_equipo
FROM 
    topos_eventos_encuentro tee
JOIN 
    topos_jugador j ON tee.id_jugador = j.id_jugador
JOIN 
    topos_equipo e ON j.id_equipo = e.id_equipo
WHERE 
    tee.id_estadistica = 1 AND e.id_torneo = :id_torneo
GROUP BY 
    j.id_jugador
ORDER BY 
    goles DESC
LIMIT 5; ";
    

    // Preparar y ejecutar la segunda consulta
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->bindParam(':id_torneo', $id_torneo, PDO::PARAM_INT);
    $stmt2->execute();
    $resultados2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);


// 

// Generar la tabla HTML para la primera consulta
if (!empty($resultados1)) {
    echo '<h2 class="titulo">Estadísticas de Equipos</h2>';
    echo '<div class="table-responsive">'; // Añadir clase aquí
    echo '<table class="table tabla">'; // Añadir clases Bootstrap para estilos
    echo '<thead>';
    echo '<tr>';
    echo '<th>Equipo</th>';
    echo '<th>PG</th>';
    echo '<th>PE</th>';
    echo '<th>PP</th>';
    echo '<th>PEG</th>';
    echo '<th>GF</th>';
    echo '<th>GC</th>';
    echo '<th>DG</th>';
    echo '<th>Pts</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($resultados1 as $fila) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($fila['nombre_equipo']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['victorias']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['empates']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['derrotas']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['puntos_penales']) . '</td>';          
        echo '<td>' . htmlspecialchars($fila['goles_favor']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['goles_contra']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['diferencia_goles']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['puntos']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>'; // Cerrar div
} else {
        echo 'No se encontraron resultados para las estadísticas de equipos en el torneo seleccionado.';
    }



} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
// Generar la tabla HTML para la segunda consulta
if (!empty($resultados2)) {
    echo '<h2 class="titulo">Estadísticas de Jugadores</h2>';
    echo '<div class="table-responsive">'; // Añadir clase aquí
    echo '<table class="table tabla">'; // Añadir clases Bootstrap para estilos
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nombre</th>';
    echo '<th>Apellido Paterno</th>';
    echo '<th>Apellido Materno</th>';
    echo '<th>Equipo</th>';
    echo '<th>Goles</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($resultados2 as $fila) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($fila['nombre_jugador']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['paterno']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['materno']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['nombre_equipo']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['goles']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>'; // Cerrar div
}else {
        echo 'No se encontraron resultados para las estadísticas de jugadores en el torneo seleccionado.';
    }
echo "</div>";

