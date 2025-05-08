<?php
session_unset();
if($_SERVER["REQUEST_METHOD"] == "POST"){
     $encuentro = $_POST['encuentro'];
     $equipo = $_POST['equipo'];
    
        
     
    
//   echo $torneo;
//   echo "Hola";
    try{
     require_once "database.php";
     require_once "eventos_contr.inc.php";

     
     // //  //manejo de errores
      $error=[];

     if (is_input_empty($encuentro)){
          $error["empty_input"]="Ingrese el encuentro";
     }
     

     require_once 'config_session.inc.php';

     // $datos["torneo"]=$torneo
    
     $_SESSION["evento"] = $datos;
     if($error){
          $_SESSION["errors_registro"] = $error;
          header("Location: ../admin/penales.php");
          die();
     }




     $sql = "SELECT id_equipo_local, id_equipo_visitante FROM topos_encuentro WHERE id_encuentro = :id;";
     
// Preparar la consulta
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $encuentro, PDO::PARAM_INT);
     $stmt->execute();

// Obtener el resultado
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);


if ($resultado) {
     // Acceder a los valores obtenidos
     $id_equipo_local = $resultado['id_equipo_local'];
     $id_equipo_visitante = $resultado['id_equipo_visitante'];
     // Puedes utilizar $id_equipo_local y $id_equipo_visitante como necesites
 }

 if ($equipo == $id_equipo_local) {
     $sql = "UPDATE topos_encuentro SET ganador_penales = 'local' WHERE id_encuentro = :id";
 } else {
     $sql = "UPDATE topos_encuentro SET ganador_penales = 'visitante' WHERE id_encuentro = :id";
 }
 
 // Preparar la consulta
 $stmt = $pdo->prepare($sql);
 
 // Bind de parámetro id
 $stmt->bindParam(':id', $encuentro, PDO::PARAM_INT);
 
 // Ejecutar la consulta
 $stmt->execute();

     // Bind de parámetros
    
          // echo "<script>alert('Evento registrado correctamente');</script>";
          header("Location: ../admin/penales.php");

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