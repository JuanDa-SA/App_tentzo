<?php
session_unset();

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $nombre_capitan = $_POST["nombre_capitan"];
  $apellido_capitan = $_POST["apellido_capitan"];
  $apellido2_capitan = $_POST["apellido2_capitan"];
  $contacto_equipo = $_POST["contacto_equipo"];
  $colonia = $_POST["colonia"];
  $edad = $_POST["edad"];
  $correo = $_POST["correo"];
  $numero = $_POST["numero"];

    try{
     require_once "database.php";
     require_once 'config_session.inc.php';

     require_once "formularioCapitan_mod.inc.php";
     require_once "formularioCapitan_contr.inc.php";
     // require_once "form_contr.inc.php";
     // require_once "form_mod.inc.php";
     // //  //manejo de errores
      $error=[];
          if (is_input_empty($numero)){
               $error["empty_input"]="Ingrese un numero de camiseta";
          }
          if (!is_input_empty($correo)){
               
               if (correo_existe($pdo,$correo)){
                    $error["empty_input"]="Este correo ya está asociado a un jugador";
     
               }
          }
          if (is_input_empty($correo)){
               $error["empty_input"]="Ingrese su correo";
          }
          if (!is_input_empty($contacto_equipo)){
               if (celular_existe($pdo,$contacto_equipo)){
                    $error["empty_input"]="Este numero ya está asociado a un jugador";
               }
          }
         
          if (is_input_empty($contacto_equipo)){
               $error["empty_input"]="Ingrese un numero de contacto";
          }
          if(!is_input_empty($nombre_capitan) && !is_input_empty($apellido_capitan) && !is_input_empty($apellido2_capitan) && !is_input_empty($edad) && !is_input_empty($colonia)){
               if (jugador_existe($pdo, $nombre_capitan, $apellido_capitan, $apellido2_capitan, $edad, $colonia)){
                    $error["empty_torneo"]="El jugador ya se registró  en el torneo ".$torneo;
               }
          }
          if (is_input_empty($colonia)){
               $error["empty_input"]="Ingrese su colonia";
          }
          if (is_input_empty($edad)){
               $error["empty_input"]="Ingrese su edad";
          }
          
          if (is_input_empty($apellido2_capitan)){
               $error["empty_input"]="Ingrese apellido materno de capitan";
              }
          if (is_input_empty($apellido_capitan)){
               $error["empty_input"]="Ingrese apellido paterno de capitan";
              }
          if (is_input_empty($nombre_capitan)){
               $error["empty_input"]="Ingrese el nombre de cápitan.";
          }
          $datos_jugador=[];
          $datos_jugador["nombre_capitan"]=$nombre_capitan;
          $datos_jugador["apellido1"]=$apellido_capitan;
          $datos_jugador["apellido2"]=$apellido2_capitan;
          $datos_jugador["numero_camiseta"]=$numero;
          $datos_jugador["contacto"]=$contacto_equipo;
          $datos_jugador["colonia"]=$colonia;
          $datos_jugador["edad"] = $edad;
          $datos_jugador["correo"] = $correo;
     
         
          $_SESSION["jugador"] = $datos_jugador;
     if($error){
          
          $_SESSION["errors_registro"] = $error;
          header("Location: ../formularioRegistroCapitan.php");
          die();
     }
     
     
     //  $_SESSION["jugadores"] = $jugadores;
     // // $_SESSION["id"] = $_SESSION["datos_iniciales"]["seccion_electoral"].contador($pdo);

     // if(isset($_SESSION)){
     //      registrarEquipo($pdo,$_SESSION["equipo"]);
     // } 
     // $id = getID($pdo,$_SESSION["equipo"]);
     
     // if(isset($_SESSION)){
     //      registrarJugadorCapitan($pdo,$id,$_SESSION["jugador"],$_SESSION["capitan"]);
     // } 
     if ($edad >= 18){

          header("Location: ../formularioCapitanMayor.php");
     }
     else{
          header("Location: ../formularioCapitanMenor.php");;
     }
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