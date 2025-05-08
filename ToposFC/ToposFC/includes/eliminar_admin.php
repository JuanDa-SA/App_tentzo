<?php
require 'database.php';


if (isset($_GET['user'])) {
    $user = $_REQUEST['user'];
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM topos_admins WHERE usuario = :user";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        if ($stmt->execute()) {
            header("Location: ../admin/tabla_admin.php");
            exit(); 
        } else {
            echo "Error al eliminar el registro";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {

    echo "Usuario no proporcionado";
}
?>