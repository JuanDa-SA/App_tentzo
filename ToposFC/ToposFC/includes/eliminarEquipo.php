<?php
    require 'database.php';

    // Check if the 'id' parameter is set in the URL
    if (isset($_GET['id'])) {
        // Retrieve the 'id' parameter from the URL
        $id = $_GET['id'];

        try {
            // Set error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the DELETE statement
            $sql = "DELETE FROM topos_equipo WHERE id_equipo = :id";
            $stmt = $pdo->prepare($sql);

            // Bind the parameter
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Execute the DELETE statement
            if ($stmt->execute()) {
                // If deletion is successful, redirect to a page
                header("Location: ../admin/AdministrarTorneo.php");
                exit(); // Make sure to exit after redirection
            } else {
                // If there is an error in execution, display an error message
                echo "Error al eliminar el registro";
            }
        } catch (PDOException $e) {
            // If there is any PDO exception, display the error message
            echo "Error: " . $e->getMessage();
        }
    } else {
        // If the 'id' parameter is not set in the URL, display an error message
        echo "ID no proporcionado";
    }
