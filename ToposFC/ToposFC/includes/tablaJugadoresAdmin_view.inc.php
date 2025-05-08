<?php
declare(strict_types=1);

function mostrarSolicitudEquipos(){
    require 'database.php';
   
    $consulta = "SELECT id_jugador, nombre FROM topos_jugador;";
    foreach($pdo->query($consulta) as $fila){
            echo "<tr>";
            echo "<td><h3>" . $fila['id_jugador'] . "</h3></td>";
            echo "<td><h3>". $fila["nombre"] . "</h3></td>";
            echo '<td><a class="boton boton--morado" href="../includes/eliminarJugador.php?id='.$fila['id_jugador'].'">Eliminar</a></td>';
            echo "</tr>";
    }
} 