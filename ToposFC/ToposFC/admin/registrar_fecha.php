<?php
// Configuración de la conexión a la base de datos
require_once '../includes/database.php';

try {
    // Crear conexión



    // Capturar datos del formulario
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
    $time = isset($_POST['time']) ? $_POST['time'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    // Validar que el id es numérico
    if (!is_numeric($id)) {
        die("ID no válido.");
    }

    // Preparar la consulta
    $query = "UPDATE topos_encuentro SET ";
    $params = [];

    if ($fecha !== null) {
        $query .= "fecha = :fecha ";
        $params[':fecha'] = $fecha;
    }

    if ($time !== null) {
        if ($fecha !== null) {
            $query .= ", ";
        }
        $query .= "hora = :hora ";
        $params[':hora'] = $time;
    }

    $query .= "WHERE id_encuentro = :id";
    $params[':id'] = $id;

    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($query);
    
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    if ($stmt->execute()) {
        header("Location: verMatchmaking.php");;
    } else {
        echo "Error al actualizar el registro";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}