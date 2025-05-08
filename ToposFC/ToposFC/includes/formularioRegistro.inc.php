<?php
session_unset();
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $nombre_equipo = $_POST["nombre_equipo"];
  $torneo = $_POST["torneo"];

  
//   echo $torneo;
//   echo "Hola";
    try{
     require_once "database.php";
     
     require_once "formularioRegistro_mod.inc.php";
     require_once "formularioRegistro_contr.inc.php";
     // require_once "form_contr.inc.php";
     // require_once "form_mod.inc.php";
     
     // //  //manejo de errores
      $error=[];
     if (is_input_empty($nombre_equipo)){
          $error["empty_input"]="Ingrese el nombre del equipo";
     }
     if(is_input_empty($torneo)){
          $error["empty_torneo"]="Por favor seleccione un torneo";
     }
     if(!is_input_empty($torneo) && !is_input_empty($nombre_equipo)){
          if (equipo_existe($pdo, $torneo,$nombre_equipo)){
               $error["empty_torneo"]="El equipo ya existe en el torneo ".$torneo;
          }
     }

     require_once 'config_session.inc.php';

     $datos=[];
     $datos["nombre_equipo"]=$nombre_equipo;
     $datos["torneo"] = $torneo;
     // $datos["torneo"]=$torneo
    
     $_SESSION["equipo"] = $datos;
     if($error){
          $_SESSION["errors_registro"] = $error;
          header("Location: ../formularioRegistroEquipo.php");
          die();
     }
    
    
     //  $_SESSION["jugadores"] = $jugadores;
     // // $_SESSION["id"] = $_SESSION["datos_iniciales"]["seccion_electoral"].contador($pdo);
     
     header("Location: ../formularioRegistroCapitan.php");
     $pdo=null;
     $stmt=null;
     die();
  }catch(PDOException $e){
      die("Process failed: ".$e->getMessage());
  }
}else{
echo"no";
die();
}