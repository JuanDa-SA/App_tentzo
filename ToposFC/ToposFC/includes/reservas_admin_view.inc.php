<?php
declare(strict_types=1);

function mostrarSolicitudEquipos(){
    require 'database.php';

    $consulta = "SELECT r.id, r.titulo, r.nombre, r.correo, r.fecha, r.estado  FROM topos_reservas r;";
    foreach($pdo->query($consulta) as $fila){
        echo "<tr>";
        echo "<td><h4>". $fila["titulo"] . "</h4></td>";
        echo "<td><h4>". $fila["nombre"] . "</h4></td>";
        echo "<td><h4>". $fila["correo"] . "</h4></td>";
        echo "<td><h4>". $fila["fecha"] . "</h4></td>";
        
        // Mostrar el estado de manera legible según la condición
        echo "<td><h4>";
        switch ($fila["estado"]) {
            case 0:
                echo "Sin confirmar";
                break;
            case 1:
                echo "Confirmada";
                break;
            case 3:
                echo "Necesario reagendar";
                break;
            default:
                echo "Desconocido";
        }
        echo "</h4></td>";
        
        echo '<td><a class="boton-tabla boton--negro" href="detallesReserva.php?id='.$fila['id'].'">Detalles</a></td>';
        echo '<td><a class="boton-tabla boton--morado" href="../includes/eliminar_horario.php?id='.$fila['id'].'">Eliminar</a></td>';
        echo "</tr>";
    }
}
