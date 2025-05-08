<?php

include "database.php";

// Verifica si los campos de usuario y contraseña no están vacíos
if (empty($_POST["txtusuario"])) {
    echo "<script>alert('Debes completar todos los campos.'); window.history.back();</script>";
    exit; 
}

$usuario = trim($_POST["txtusuario"]);


// Verifica nuevamente si los campos de usuario y contraseña no están vacíos después de limpiar los espacios en blanco
if (empty($usuario)) {
    echo "<script>alert('Debes completar todos los campos.'); window.history.back();</script>";
    exit; 
}

// Prepara la consulta para evitar inyecciones SQL
$stmt = $pdo->prepare("INSERT INTO topos_arbitros (nombre) VALUES (?)");

$stmt->bindParam(1, $usuario);

if ($stmt->execute()) {
    header("Location: ../admin/AdministrarTorneo.php");
    exit; // Sale del script después de redireccionar
} else {
    echo "No ingreso: " . $stmt->errorInfo()[2];
}

$pdo = null;
