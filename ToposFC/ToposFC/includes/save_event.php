<?php




// Incluir el archivo de conexión
include 'database.php';

// Conectar a la base de datos
// (Asegúrate de tener tu conexión aquí)

// Obtener los datos JSON enviados
$data = json_decode(file_get_contents('php://input'), true);
if ($data) {
    $day = $data['day'];
    $month = $data['month'];
    $year = $data['year'];
    $eventDetails = $data['events'][0];
    $title = $eventDetails['title'];
    $motive = $eventDetails['motive'];
    $nombre = $eventDetails['nombre'];
    $mail = $eventDetails['mail'];
    $tel = $eventDetails['telefono'];
    $time_i = $eventDetails['time_i'];
    $time_f = $eventDetails['time_f'];

    // Convertir cadenas de tiempo en objetos DateTime
    $time_i_obj = DateTime::createFromFormat('H:i', $time_i);
    $time_f_obj = DateTime::createFromFormat('H:i', $time_f);

    // Formatear objetos DateTime al formato de tiempo SQL (HH:MM:SS)
    $time_i_sql = $time_i_obj->format('H:i:s');
    $time_f_sql = $time_f_obj->format('H:i:s');

    // Formatear la fecha al formato SQL (YYYY-MM-DD)
    $date = sprintf("%04d-%02d-%02d", $year, $month, $day);

    try {
        // Verificar si el evento ya existe
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM topos_reservas WHERE titulo = ? AND nombre = ? AND fecha = ? AND hora_inicio = ? AND hora_fin = ?");
        $checkStmt->execute([$title, $nombre, $date, $time_i_sql, $time_f_sql]);
        $eventExists = $checkStmt->fetchColumn();
    
        if ($eventExists) {
            echo json_encode(["status" => "error", "message" => "usted ya ha agregado este evento"]);
        } else {
            // Verificar si hay un evento que se traslape en el mismo día
            $overlapCheckStmt = $pdo->prepare("
                SELECT COUNT(*) 
                FROM topos_reservas 
                WHERE fecha = ? 
                  AND (
                      (hora_inicio < ? AND hora_fin > ?) OR
                      (hora_inicio < ? AND hora_fin > ?) OR
                      (hora_inicio >= ? AND hora_fin <= ?)
                  )
            ");
            $overlapCheckStmt->execute([ $date, $time_f_sql, $time_i_sql, $time_i_sql, $time_f_sql, $time_i_sql, $time_f_sql]);
            $overlapExists = $overlapCheckStmt->fetchColumn();
    
            if ($overlapExists) {
                echo json_encode(["status" => "error", "message" => "Ya existe un evento que se traslapa en el mismo día y horario."]);
            } else {
                // Usar prepared statements para evitar inyección SQL
                $stmt = $pdo->prepare("INSERT INTO topos_reservas (titulo, motivo, nombre, correo, telefono, fecha, hora_inicio, hora_fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$title, $motive, $nombre, $mail, $tel, $date, $time_i_sql, $time_f_sql]);
                echo json_encode(["status" => "success", "message" => "Evento registrado correctamente"]);
            }
        }
    
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error al insertar registro: " . $e->getMessage()]);
    }
    

} else {
    echo json_encode(["status" => "error", "message" => "No data received"]);
}



// Cerrar la conexión
$pdo = null;