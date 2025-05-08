<?php
session_unset();
if($_SERVER["REQUEST_METHOD"] == "POST"){
     $id = $_GET['id'];
  $tutor = $_POST["tutor"];

  $permisoImagen = $_POST["permisoImagen"];
  $permiso1 = $_POST["permiso1"];
  $permiso2 = $_POST["permiso2"];
  $permiso3 = $_POST["permiso3"];
  $permiso4 = $_POST["permiso4"];

    try{
     require_once "database.php";
     require_once 'config_session.inc.php';

     require_once "formularioJugador_mod.inc.php";
     require_once "formularioJugador_contr.inc.php";
    //  require_once "formularioCapitan_contr.inc.php";
     // require_once "form_contr.inc.php";
     // require_once "form_mod.inc.php";
     // //  //manejo de errores
      $error=[];

          if (is_input_empty($permiso4)){
               $error["empty_input"]="Es necesario que seleccione la casilla del apartado 'Información Médica'";
          }
          if (is_input_empty($permiso3)){
               $error["empty_input"]="Es necesario que seleccione la casilla del apartado 'Atención Médica'";
          }
          if (is_input_empty($permiso2)){
               $error["empty_input"]="Es necesario que seleccione la casilla del apartado 'Responsabilidades Comité'";
          }
          if (is_input_empty($permiso1)){
               $error["empty_input"]="Es necesario que seleccione la casilla del apartado 'Bebidas alcoholicas'";
          }
          if (is_input_empty($permisoImagen)){
               $error["empty_input"]="Seleccione una opción para el permiso de uso de imagen";
              }

     if($error){
          $_SESSION['tutor'] = $tutor;
          $_SESSION["permisoImagen"] = $permisoImagen;
          $_SESSION["permiso1"] = $permiso1;
          $_SESSION["permiso2"] = $permiso2;
          $_SESSION["permiso3"] = $permiso3;
          $_SESSION["permiso4"] = $permiso4;

          $_SESSION["errors_registro"] = $error;
          header("Location: ../formularioJugadorMayor.php?id=".$id);          
          die();
     }
     $jugador = $_SESSION["jugadornuevo"];
     $jugador['tutor'] = $tutor;
     $jugador['permisoImagen'] = $permisoImagen;
     $equipo = $_SESSION["equipo"];
     // $_SESSION['permiso'] = $datos_permiso;
     $_SESSION["jugadornuevo"] = $jugador;
     if(isset($_SESSION)){
          registrarJugador($pdo,$id,$_SESSION["jugadornuevo"]);
      } 
      header("Location: ../formularioRegistroJugador.php?id=".$id);
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