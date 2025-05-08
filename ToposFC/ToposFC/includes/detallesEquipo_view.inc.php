<?php
declare(strict_types=1);

function mostrarSolicitudEquipos(int $id){
    require 'database.php';
    
    $consulta2 = "SELECT nombre_equipo from topos_equipo WHERE id_equipo = :id";
    $stmt2 = $pdo->prepare($consulta2);
    $stmt2->bindParam(":id", $id);
    $stmt2->execute();
    $result = $stmt2->fetchColumn();
    
    $consulta = "SELECT j.id_jugador, j.nombre, j.apellido_paterno, j.apellido_materno, j.numero
    FROM topos_jugador j
    JOIN topos_equipo e ON j.id_equipo = e.id_equipo
    WHERE e.id_equipo = :id;";
    $stmt = $pdo->prepare($consulta);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    $consulta3 = "SELECT j.id_jugador, j.nombre, j.apellido_paterno, j.apellido_materno, j.numero,
    j.correo, j.telefono
FROM topos_jugador j
JOIN topos_equipo e ON j.id_equipo = e.id_equipo
JOIN topos_capitan c ON j.id_jugador = c.id_jugador
WHERE e.id_equipo = :id";
    $stmt3 = $pdo->prepare($consulta3);
    $stmt3->bindParam(":id", $id);
    $stmt3->execute();

    echo "<style>
    .contenedor {
        margin: 0 auto;
        max-width: 1200px;
        padding: 20px;
    }
    .titulo {
        font-family: Arial, sans-serif;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
        font-size: 2.5em; /* Aumenta el tamaño de la fuente de los títulos */
    }
    .table-responsive {
        overflow-x: auto;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 1.5em; /* Aumenta el tamaño de la fuente de las tablas */
    }
    .table th, .table td {
        padding: 12px;
        border: 1px solid #dddddd;
        text-align: left;
    }
    .table th {
        background-color: #f2f2f2;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .border-black {
        border-color: black;
    }
</style>";

    
    echo"<div class='contenedor formulario mt-5 pe-5 ps-5'>";
    echo"<h2 class'titulo'>". $result ."</h1>";
    echo"<h3 class='titulo'> Datos del capitan</h3>";
    echo"<div class='table-responsive'>
            <table class='table table-hover border-black tabla'>
                <thead>
                    <tr>
                        <th scope='col'><h4>ID</h4></th>
                        <th scope='col'><h4>Nombre</h4></th>
                        <th scope='col'><h4>Apellido Paterno</h4></th>
                        <th scope='col'><h4>Numero de camiseta</h4></th>
                        <th scope='col'><h4>Numero de contacto</h4></th>
                        <th scope='col'><h4>Correo</h4></th>
                    </tr>
                </thead>
                <tbody>";

                while($fila = $stmt3->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td><h4>" . $fila['id_jugador'] . "</h4></td>";
                        echo "<td><h4>". $fila["nombre"] . "</h4></td>";
                        echo "<td><h4>". $fila["apellido_paterno"] . "</h4></td>";
                        echo "<td><h4>". $fila["numero"] . "</h4></td>";
                        echo "<td><h4>". $fila["telefono"] . "</h4></td>";
                        echo "<td><h4>". $fila["correo"] . "</h4></td>";
                        echo "</tr>";
                }
               echo"</tbody>
            </table>
        </div>";
    echo"<h3 class='titulo '>Jugadores del equipo</h3>";
    echo"<div class='table-responsive'>
            <table class='table table-hover border-black tabla'>
                <thead>
                    <tr>
                        <th scope='col'><h4>ID Jugador</h4></th>
                        <th scope='col'><h4>Nombre</h4></th>
                        <th scope='col'><h4>Apellido Paterno</h4></th>
                        <th scope='col'><h4>Apellido Materno</h4></th>
                        <th scope='col'><h4>Numero de camiseta</h4></th>
                        <th scope='col'></th>
                    </tr>
                </thead>
                <tbody>";

                while($fila = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td><h4>" . $fila['id_jugador'] . "</h4></td>";
                        echo "<td><h4>". $fila["nombre"] . "</h4></td>";
                        echo "<td><h4>". $fila["apellido_paterno"] . "</h4></td>";
                        echo "<td><h4>". $fila["apellido_materno"] . "</h4></td>";
                        echo "<td><h4>". $fila["numero"] . "</h4></td>";
                        echo '<td><a class="boton boton--rojo" href="../includes/eliminarJugador.php?id='.$fila['id_jugador'].'">Eliminar</a></td>';
                        echo "</tr>";
                }
               echo"</tbody>
            </table>
        </div>
    </div>";
   
    
} 