<?php
    require 'database.php';

    // Check if the 'id' parameter is set in the URL
    if (isset($_GET['id'])) {
        // Retrieve the 'id' parameter from the URL
        $id_equipo = $_GET['id'];

        try {
            // Set error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Get the tournament id for the team
            $sql_tournament_id = "SELECT id_torneo FROM topos_equipo WHERE id_equipo = :id_equipo";
            $stmt_tournament_id = $pdo->prepare($sql_tournament_id);
            $stmt_tournament_id->bindParam(':id_equipo', $id_equipo, PDO::PARAM_INT);
            $stmt_tournament_id->execute();
            $row = $stmt_tournament_id->fetch();
            $id_torneo = $row['id_torneo'];
            
            // Count the number of teams with status 1 in the tournament
            $sql_count_teams = "SELECT COUNT(*) AS count_teams FROM topos_equipo WHERE id_torneo = :id_torneo AND estado = 1";
            $stmt_count_teams = $pdo->prepare($sql_count_teams);
            $stmt_count_teams->bindParam(':id_torneo', $id_torneo, PDO::PARAM_INT);
            $stmt_count_teams->execute();
            $row = $stmt_count_teams->fetch();
            $count_teams = $row['count_teams'];
            
            // Get the maximum number of teams allowed in the tournament
            $sql_max_teams = "SELECT cantidad_equipos FROM topos_torneo WHERE id_torneo = :id_torneo";
            $stmt_max_teams = $pdo->prepare($sql_max_teams);
            $stmt_max_teams->bindParam(':id_torneo', $id_torneo, PDO::PARAM_INT);
            $stmt_max_teams->execute();
            $row = $stmt_max_teams->fetch();
            $max_teams = $row['cantidad_equipos'];
            
            // Check if the number of teams with status 1 is less than the maximum number of teams allowed
            if ($count_teams < $max_teams) {
                // Prepare the UPDATE statement
                $sql = "UPDATE topos_equipo SET estado = 1 WHERE id_equipo = :id_equipo";
                $stmt = $pdo->prepare($sql);

                // Bind the parameter
                $stmt->bindParam(':id_equipo', $id_equipo, PDO::PARAM_INT);

                // Execute the UPDATE statement
                if ($stmt->execute()) {
                    // If update is successful, redirect to a page
                    echo "Inscripción exitosa";
                } else {
                    // If there is an error in execution, return an error message
                    echo "Error al confirmar inscripción el registro";
                }
            } else {
                // If the maximum number of teams is reached, return an error message
                echo "No se puede inscribir más equipos en este torneo.";
            }
        } catch (PDOException $e) {
            // If there is any PDO exception, return the error message
            echo "Error: " . $e->getMessage();
        }
    } else {
        // If the 'id' parameter is not set in the URL, return an error message
        echo "ID no proporcionado";
    }