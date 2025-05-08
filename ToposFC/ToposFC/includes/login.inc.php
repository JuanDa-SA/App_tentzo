<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["txtusuario"];
    $pass=$_POST["txtpassword"];
    try{
        require_once 'database.php';
        require_once 'login_mod.inc.php';
        require_once 'login_contr.inc.php';
         //manejo de errores

         $error=[];



         if (is_input_empty($email,$pass)){
              $error["empty_input"]="Debe llenar todos los campos!";
         }
         
        $result=get_user($pdo, $email);
        // var_dump($result);
        // exit;
         if(is_mail_wrong($result)){
            $error["login_incorrect"] = "Correo incorrectos";
         }


        if(!is_mail_wrong($result) && ($pass != $result['pass'])){
            $error["login_incorrect"]="Correo o contraseña incorrectaaos";
        }

          require_once 'config_session.inc.php';

         if($error){
              $_SESSION["errors_login"] = $error;
              header("Location: ../login.php");
              die();
         }

         $newSessionId= session_create_id();
         $sessionId=$newSessionId."_".$result["id_admin"];
         session_id($sessionId);
            
            $_SESSION["user_id"] = $result["id_admin"];
         $_SESSION["user_username"] = htmlspecialchars($result["usuario"]);
         $_SESSION["last_regeneration"] = time();
         header("Location: ../admin/indexAdmin.php");
         $pdo=null;
         $stmt=null;

         die();

    }catch(PDOException $e){
        die("Process failed: ".$e->getMessage());
    }
}else{
    header("Location:../index.html");
    die();
}