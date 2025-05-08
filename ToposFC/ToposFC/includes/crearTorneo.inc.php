<?php
session_unset();
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $nombre_torneo = $_POST["nombre_torneo"];
  $cantidad_equipos = $_POST["cantidad_equipos"];
 
  try{
    require_once "database.php";
    require_once "crearTorneo_mod.inc.php";
    require_once "crearTorneo_contr.inc.php";
    require_once 'config_session.inc.php';
 
    // Manejo de errores
    $error = [];
      
    if (is_input_empty($nombre_torneo)){
      $error["empty_input_torneo"] = "Ingresar el nombre del torneo";
    }
    if (is_input_empty($cantidad_equipos)){
      $error["empty_input_equipos"] = "Ingresar el numero de equipos para el torneo";
    }
    if($error){
      $_SESSION["errors_registro"] = $error;
      $_SESSION['nombre_torneo'] = $nombre_torneo; // Guardas los datos en la sesión
      $_SESSION['cantidad_equipos'] = $cantidad_equipos; // Guardas los datos en la sesión
      header("Location: ../admin/crearTorneo.php");
      die();
    }
    
    $datos = [];
    $datos["nombre_torneo"] = $nombre_torneo;
    $datos["cantidad_equipos"] = $cantidad_equipos;
    
    $_SESSION["torneo"] = $datos;
    
    if(isset($_SESSION)){
      registrarTorneo($pdo, $_SESSION["torneo"]);
    } 

    session_unset();
    echo "<script>
            alert('Registro exitoso');
            window.location.href = '../admin/AdministrarTorneo.php';
          </script>";
    $pdo = null;
    $stmt = null;
    die();
  } catch(PDOException $e){
    die("Process failed: ".$e->getMessage());
  }
} else {
  echo "no";
  die();
}

