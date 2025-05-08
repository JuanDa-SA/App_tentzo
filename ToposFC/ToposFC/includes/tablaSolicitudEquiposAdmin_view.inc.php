<?php
declare(strict_types=1);

function mostrarSolicitudEquipos($idTorneo = null){
    require 'database.php';
   
    // Construir la consulta base
    $consultaBase = "SELECT *
                     FROM topos_equipo";
    
    // Si se proporciona un ID de torneo, agregar JOIN y WHERE para filtrar por torneo
    if($idTorneo){
        $consultaBase =  "SELECT id_equipo, nombre_equipo, estado, id_torneo 
        FROM topos_equipo WHERE id_torneo = :idTorneo;";
    }
    
    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($consultaBase);
    
    // Vincular parámetro si se proporciona un ID de torneo
    if($idTorneo){
        
        $stmt->bindValue(':idTorneo', $idTorneo, PDO::PARAM_INT);
    }
     // Construir el array de equipos
     $equipos = array();
    $stmt->execute();
    // Iterar sobre los resultados y mostrarlos en la tabla
    foreach($stmt as $fila){
        $id = $fila['id_equipo'];
        echo "<tr>";
        echo "<td><h3>" . $fila['id_equipo'] . "</h3></td>";
        echo "<td><h3>". $fila["nombre_equipo"] . "</h3></td>";
         echo "<td><h3>". $fila["id_torneo"] . "</h3></td>";
        if ($fila["estado"]==0){
            echo '<td><a class="boton boton--azul" onclick="confirmarRegistro(' . $id . ')">Confirmar registro</a></td>';
        }
        else{
            echo '<td><a class="boton boton--morado"">Registro Confirmado</a></td>';
            
        }
        echo '<td><a class="boton boton--azul" href="detallesEquipo.php?id='.$fila['id_equipo'].'">Detalles</a></td>';
        echo '<td><a class="boton boton--rojo" href="../includes/eliminarEquipo.php?id='.$fila['id_equipo'].'">Eliminar</a></td>';
        echo "</tr>";
    }
}


function getEquiposConfirmados($idTorneo = null){
    require 'database.php';
   
    // Construir la consulta base
    $consultaBase = "SELECT id_equipo, nombre_equipo 
                     FROM topos_equipo";
    
    // Si se proporciona un ID de torneo, agregar JOIN y WHERE para filtrar por torneo
    if($idTorneo){
        $consultaBase =  "SELECT id_equipo, nombre_equipo, estado 
        FROM topos_equipo WHERE id_torneo = :idTorneo AND estado = :estado;";
    }
    
    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($consultaBase);
    
    // Vincular parámetro si se proporciona un ID de torneo
    if($idTorneo){
        $stmt->bindValue(':idTorneo', $idTorneo, PDO::PARAM_INT);
        $estado = 1;
        $stmt->bindValue(':estado', $estado, PDO::PARAM_INT);
    }
     // Construir el array de equipos
     $equipos = array();
    $stmt->execute();
    // Iterar sobre los resultados y mostrarlos en la tabla
    foreach($stmt as $fila){   
            $equipos[] = $fila["id_equipo"];
    }
    return $equipos;
}

function getEquiposCon($idTorneo = null){
    require 'database.php';
   
    // Construir la consulta base
    $consultaBase = "SELECT id_equipo, nombre_equipo 
                     FROM topos_equipo";
    
    // Si se proporciona un ID de torneo, agregar JOIN y WHERE para filtrar por torneo
    if($idTorneo){
        $consultaBase =  "SELECT id_equipo, nombre_equipo, estado 
        FROM topos_equipo WHERE id_torneo = :idTorneo AND estado = :estado;";
    }
    
    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($consultaBase);
    
    // Vincular parámetro si se proporciona un ID de torneo
    if($idTorneo){
        $stmt->bindValue(':idTorneo', $idTorneo, PDO::PARAM_INT);
        $estado = 1;
        $stmt->bindValue(':estado', $estado, PDO::PARAM_INT);
    }
     // Construir el array de equipos
     $equipos = array();
    $stmt->execute();
    // Iterar sobre los resultados y mostrarlos en la tabla
    foreach($stmt as $fila){   
            $equipos[] = $fila["id_equipo"];
    }
    if($idTorneo){
        echo "<p class='n-equipos'>Numero de equipos confirmados en el torneo: ".  count($equipos) . "</p>";
    }
    else{
        echo "<p class='n-equipos'>Numero de equipos confirmados: ".  count($equipos) . "</p>";
    }
    

}
