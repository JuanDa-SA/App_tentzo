<?php
session_unset();
if($_SERVER["REQUEST_METHOD"] == "POST"){
     $encuentro = $_POST['encuentro'];
     $jugador = $_POST['jugador'];
     $evento = $_POST['evento'];
     $minuto = $_POST['minuto'];
    
    // Aquí procesamos la inserción en la base de datos después de la confirmación
   
        
        
     
    
//   echo $torneo;
//   echo "Hola";
    try{
     require_once "database.php";
     require_once "eventos_contr.inc.php";
     require_once "eventos_mod.inc.php";
     
     // //  //manejo de errores
      $error=[];
      if (is_input_empty($minuto)){
          $error["empty_input"]="Ingrese el encuentro";
     }
      if (is_input_empty($evento)){
          $error["empty_input"]="Ingrese el encuentro";
     }
     if(is_input_empty($jugador)){
          $error["empty_input"]="Por favor seleccione un jugador";
     }
     if (is_input_empty($encuentro)){
          $error["empty_input"]="Ingrese el encuentro";
     }
     
     // if(!is_input_empty($torneo) && !is_input_empty($nombre_equipo)){
     //      if (equipo_existe($pdo, $torneo,$nombre_equipo)){
     //           $error["empty_torneo"]="El equipo ya existe en el torneo ".$torneo;
     //      }
     // }

     require_once 'config_session.inc.php';

     $datos=[];
     $datos["id_encuentro"]=$encuentro;
     $datos["id_jugador"]=$jugador;
     $datos["id_eventos"]=$evento;
     $datos["minuto"] = $minuto;
     // $datos["torneo"]=$torneo
    
     $_SESSION["evento"] = $datos;
     if($error){
          $_SESSION["errors_registro"] = $error;
          header("Location: ../admin/eventos.php");
          die();
     }
     $sql = "INSERT INTO topos_eventos_encuentro (id_encuentro, id_jugador, id_estadistica, minuto) VALUES (?, ?, ?, ?)";
     $stmt = $pdo->prepare($sql);
     if ($stmt->execute([ $encuentro, $jugador, $evento, $minuto])) {
          // echo "<script>alert('Evento registrado correctamente');</script>";
          header("Location: ../admin/eventos.php");
     } 
     //  $_SESSION["jugadores"] = $jugadores;
     // // $_SESSION["id"] = $_SESSION["datos_iniciales"]["seccion_electoral"].contador($pdo);
     
    
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