<?php
require_once '../includes/config_session.inc.php';

function generarEncuentros($equipos,$pdo,$id) {
    // require_once "../includes/database.php";
    $totalEquipos = count($equipos);
    $encuentros = array();
  
    // Generar los encuentros
    for ($i = 0; $i < $totalEquipos - 1; $i++) {
        for ($j = $i + 1; $j < $totalEquipos; $j++) {
            $encuentros[] = array($equipos[$i]["id_equipo"], $equipos[$j]["id_equipo"]);
        }
    }
   
    // Mostrar los encuentros

        // Obtener todos los árbitros disponibles
        $stmtArbitros = $pdo->query("SELECT COUNT(*) AS total_registros FROM topos_arbitros;");
        $numArbitros = $stmtArbitros->fetchColumn();
        echo "El número total de registros en la tabla 'topos_arbitros' es: " . $numArbitros;
        // Verificar si hay árbitros disponibles

        // Insertar los encuentros en la tabla


        $stmt = $pdo->prepare("INSERT INTO topos_encuentro (id_equipo_local, id_equipo_visitante, id_arbitro) VALUES (:id_local, :id_visitante, :id_arbitro)");

       
        foreach ($encuentros as $encuentro) {
            $id_local = $encuentro[0];
            $id_visitante = $encuentro[1];
            // Elegir un árbitro al azar
            $id_arbitro =  mt_rand(1, $numArbitros);
            // Insertar el encuentro con el árbitro asignado
            $stmt->bindParam(':id_local', $id_local);
        $stmt->bindParam(':id_visitante', $id_visitante);
        $stmt->bindParam(':id_arbitro', $id_arbitro);
        
        $stmt->execute();
      
        }

        $stmt = $pdo->prepare("UPDATE topos_torneo SET estado = '1' WHERE id_torneo = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();        
   header("Location: AdministrarTorneo.php");
}

// Función para obtener los equipos
function obtenerEquipos($pdo, $idTorneo2 = null) {
    // Consulta SQL para obtener los equipos
    $query = 'SELECT id_equipo, nombre_equipo FROM topos_equipo';
    
    // Si se proporciona un ID de torneo, filtrar los equipos por ese torneo
    if ($idTorneo2) {
        // echo $idTorneo2;
        $query = 'SELECT id_equipo, nombre_equipo FROM topos_equipo WHERE id_torneo = :idTorneo and estado = "1"';
    }
    // Preparar la consulta
    $statement = $pdo->prepare($query);
    
    // Si se proporciona un ID de torneo, vincularlo al parámetro de la consulta
    if ($idTorneo2) {
        $statement->bindParam(':idTorneo', $idTorneo2, PDO::PARAM_INT);
    }
  
    // Ejecutar la consulta
    $statement->execute();
    
    // Obtener y devolver los resultados
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

require_once "../includes/database.php"; // Incluye el archivo que establece la conexión a la base de datos

// Verificar si se recibió un ID válido en la URL
if(isset($_GET['id']) && ctype_digit($_GET['id'])){
    // Asignar el valor de 'id' a $idTorneo como un entero
    $idTorneo = (int)$_GET['id'];
   
    $equipos = obtenerEquipos($pdo, $idTorneo);
    // var_dump($equipos);
    generarEncuentros($equipos,$pdo,$idTorneo); // Generar encuentros
} else {
    // Si no se proporcionó un ID válido, podrías manejarlo de alguna manera (por ejemplo, redireccionando o mostrando un mensaje de error)
    echo "El ID de torneo proporcionado no es válido.";
    // Aquí podrías redirigir al usuario a una página de error o realizar otra acción apropiada.
    exit; // Terminar la ejecución del script después de mostrar el mensaje de error
}
