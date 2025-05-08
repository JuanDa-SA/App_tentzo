<?php
declare(strict_types=1);

function mostrarSolicitudEquipos(){
    require 'database.php';
   
    $consulta = "SELECT * FROM topos_admins;";
    foreach($pdo->query($consulta) as $fila){
        if ($fila["id_admin"]!=1){
            echo "<tr>";
            echo "<td>". "<h3>". $fila["usuario"] . "<h3>". "</td>";
            
                echo '<td><a class="boton boton--morado" href="../includes/eliminar_admin.php?user='.$fila['usuario'].'">Eliminar</a></td>';

            
            echo "</tr>";
        }
    }
} 