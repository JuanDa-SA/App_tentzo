<?php
session_unset();
$id = $_GET['id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $nombre_jugador = $_POST["nombreJugador"];
  $apellido_paterno = $_POST["apellido1Jugador"];
  $apellido_materno = $_POST["apellido2Jugador"];
  $contacto_equipo = $_POST["contacto_equipo"];
  $colonia = $_POST["colonia"];
  $edad = $_POST["edad"];
  $correo = $_POST["correo"];
  $numero = $_POST["numero"];
  
    try{
     require_once "database.php";
    
     require_once "formularioJugador_mod.inc.php";
     require_once "formularioJugador_contr.inc.php";
     // require_once "form_contr.inc.php";
     // require_once "form_mod.inc.php";
     require_once 'config_session.inc.php';
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
     if(!is_input_empty($nombre_jugador) && !is_input_empty($apellido_paterno) && !is_input_empty($apellido_materno) && !is_input_empty($edad) && !is_input_empty($colonia)){
          if (jugador_existe($pdo, $nombre_jugador, $apellido_paterno, $apellido_materno, $edad, $colonia,$id)){
               $error["empty_torneo"]="El jugador ya está registrado en este equipo ";
          }
     }
     
     if (is_input_empty($colonia)){
          $error["empty_input"]="Ingrese su colonia";
     }
    
     if (is_input_empty($edad)){
          $error["empty_input"]="Ingrese su edad";
     }
     
     if (is_input_empty($apellido_materno)){
          $error["empty_input"]="Ingrese apellido materno de capitan";
         }
     if (is_input_empty($apellido_paterno)){
          $error["empty_input"]="Ingrese apellido paterno de capitan";
         }
     if (is_input_empty($nombre_jugador)){
          $error["empty_input"]="Ingrese el nombre de cápitan.";
     }


     if($error){
          // $_SESSION['tutor'] = $tutor;
          // $_SESSION["permisoImagen"] = $permisoImagen;
          // $_SESSION["permiso1"] = $permiso1;
          // $_SESSION["permiso2"] = $permiso2;
          // $_SESSION["permiso3"] = $permiso3;
          // $_SESSION["permiso4"] = $permiso4;

          $_SESSION["errors_registro"] = $error;
          header("Location: ../formularioRegistroJugador.php?id=".$id);
          die();
     }
     
     $datos1=[];
     $datos1["nombre_jugador"]=$nombre_jugador;
     $datos1["apellido_paterno"]=$apellido_paterno;
     $datos1["apellido_materno"]=$apellido_materno;
     $datos1["contacto_equipo"] = $contacto_equipo;
     $datos1["colonia"] = $colonia;
     $datos1["edad"] = $edad;
     $datos1["correo"] = $correo;
     $datos1["numero"] = $numero;
     
     $_SESSION["jugadornuevo"] = $datos1;
     
     if(isset($_SESSION)){
          if($edad>=18){
               header("Location: ../formularioJugadorMayor.php?id=".$id);
          }else{
               header("Location: ../formularioJugadorMenor.php?id=".$id);
          }
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