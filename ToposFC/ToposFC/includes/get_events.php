<?php


// Incluir el archivo de conexión
include 'database.php';

$sql = "SELECT * FROM topos_reservas";
$stmt = $pdo->query($sql);

if ($stmt === false) {
    die("Error en la consulta: " . $pdo->errorInfo()[2]);
}

$eventsArr = array();

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $fecha = $row['fecha'];

        // Comprobación de la fecha
        if (empty($fecha)) {
            // Registrar el error
            error_log("Fecha vacía o no definida en la fila: " . json_encode($row));
            continue; // Saltar esta iteración si la fecha no es válida
        }

        // Dividir la fecha en componentes
        list($year, $month, $day) = explode("-", $fecha);

        if (!checkdate($month, $day, $year)) {
            // Registrar el error si la fecha no es válida
            error_log("Fecha inválida: $fecha en la fila: " . json_encode($row));
            continue; // Saltar esta iteración si la fecha no es válida
        }

        $eventFound = false;

        foreach ($eventsArr as &$event) {
            if ($event['day'] == $day && $event['month'] == $month && $event['year'] == $year) {
                $event['events'][] = array(
                    'title' => $row['titulo'],
                    'motive' => $row['motivo'],
                    'nombre' => $row['nombre'],
                    'mail' => $row['correo'],
                    'telefono' => $row['telefono'],
                    'time_i' => $row['hora_inicio'],
                    'time_f' => $row['hora_fin']
                );
                $eventFound = true;
                break;
            }
        }

        if (!$eventFound) {
            $eventsArr[] = array(
                'day' => $day,
                'month' => $month,
                'year' => $year,
                'events' => array(
                    array(
                        'title' => $row['titulo'],
                        'motive' => $row['motivo'],
                        'nombre' => $row['nombre'],
                        'mail' => $row['correo'],
                        'telefono' => $row['telefono'],
                        'time_i' => $row['hora_inicio'],
                        'time_f' => $row['hora_fin']
                    )
                )
            );
        }
    }
}

echo json_encode($eventsArr);

$pdo = null;
