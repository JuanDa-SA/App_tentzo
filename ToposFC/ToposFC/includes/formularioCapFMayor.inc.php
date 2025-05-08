<?php
session_unset();
if($_SERVER["REQUEST_METHOD"] == "POST"){

  $permisoImagen = $_POST["permisoImagen"];
  $permiso1 = $_POST["permiso1"];
  $permiso2 = $_POST["permiso2"];
  $permiso3 = $_POST["permiso3"];
  $permiso4 = $_POST["permiso4"];
  $imagen2 = $_FILES["archivo2"];
  var_dump($imagen2);

    try{
     require_once "database.php";
     require_once 'config_session.inc.php';

      require_once "formularioCapFMenor_mod.inc.php";
      require_once "formularioCapFMenor_contr.inc.php";
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

              if (!empty($imagen2["name"])) {
               $carpeta = '../imagenesLogos/';
               if(!is_dir($carpeta)){
               mkdir($carpeta,0777,true);
               } 
               $nombreImagen =  md5 (uniqid( rand(), true)).".png";
               if (move_uploaded_file($imagen2["tmp_name"], "../imagenesLogos/".$nombreImagen)) {
                    // Éxito en mover el archivo
               } else {
                    // Manejar el error si no se puede mover el archivo
     
                    $error["empty_input"]= "Error: " . error_get_last()['message'];
               }
          }

     if($error){
          // $_SESSION["permisoImagen"] = $permisoImagen;
          // $_SESSION["permiso1"] = $permiso1;
          // $_SESSION["permiso2"] = $permiso2;
          // $_SESSION["permiso3"] = $permiso3;
          // $_SESSION["permiso4"] = $permiso4;

          $_SESSION["errors_registro"] = $error;
          header("Location: ../formularioCapitanMayor.php");
          die();
     }
     
     $jugador = $_SESSION["jugador"];
     $jugador['permisoImagen'] = $permisoImagen;
    $equipo = $_SESSION["equipo"];
    $equipo["logo"] =  $nombreImagen;
     // $_SESSION['permiso'] = $datos_permiso;
     $_SESSION["jugador"] = $jugador;
     $_SESSION["equipo"] = $equipo;
     
     if(isset($_SESSION)){
          registrarEquipo($pdo,$_SESSION["equipo"]);
          
          $id = getID($pdo,$equipo);
          registrarJugadorCapitan($pdo,$id,$jugador);
      } 
      session_unset();
      header("Location: ../formularioRegistroJugador.php?id=".$id);

     // // $id = getID($pdo,$_SESSION["equipo"]);
     
     // // if(isset($_SESSION)){
     // //      registrarJugadorCapitan($pdo,$id,$_SESSION["jugador"],$_SESSION["capitan"]);
     // // } 
     // if ($edad >= 18){
     //      $_SESSION["jugador"] = $datos_jugador;
     //      $_SESSION["equipo"]= $equipo;
     //      header("Location: ../formularioCapitanMayor.php");
     // }
     // else{
     //      $_SESSION["jugador"] = $datos_jugador;
     //      $_SESSION["equipo"]= $equipo;
     //      header("Location: ../formularioCapitanMenor.php");;
     // }
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