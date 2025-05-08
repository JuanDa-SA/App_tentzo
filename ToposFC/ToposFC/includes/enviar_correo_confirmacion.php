<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
require 'database.php';
$id = $_GET['id'];

$consulta = "SELECT 
                *
            FROM 
               topos_reservas WHERE id = :id";

$stmt = $pdo->prepare($consulta);
$stmt->execute(array(':id' => $id));
    // Obtiene los datos del registro
    $fila = $stmt->fetch(PDO::FETCH_ASSOC);
    $reservaId = $fila['id'];
    //$nombreEstado = $fila['nombre_estado'];
    $titulo = $fila['titulo'];
    $motivo = $fila['motivo'];
    $nombre = $fila['nombre'];
    $correo = $fila['correo'];
    $fecha = $fila['fecha'];
    $hora_incio = $fila['hora_inicio'];
    $hora_fin = $fila['hora_fin'];
    list($year, $month, $day) = explode("-", $fecha);


    // Crea una nueva instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'salmeronjuan519@gmail.com';                     //SMTP username
        $mail->Password   = 'hywg tyil jhnz eusf';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;          // Puerto SMTP

        // Configuración del remitente y destinatario
        $mail->setFrom('salmeronjuan519@gmail.com', 'La madriguera');
        // $mail->addAddress('jcuatepotzo58@gmail.com');
        $mail->addAddress($correo);

        // Contenido del correo electrónico
        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de reserva de cancha';
        $mail->CharSet = 'UTF-8'; // Establecer la codificación UTF-8

        $mail->Body = "
        <p>Hola <strong>$nombre</strong>,</p>
        <p>Somos <strong>La Madriguera</strong> y confirmamos tu reserva.</p>
        <hr>
        <h3>DETALLES DE LA RESERVA</h3>
        <p><strong>Título:</strong> $titulo</p>
        <p><strong>Motivo:</strong> $motivo</p>
        <hr>
        <h3>FECHA Y HORA</h3>
        <p><strong>Día:</strong> $day</p>
        <p><strong>Mes:</strong> $month</p>
        <p><strong>Año:</strong> $year</p>
        <p><strong>Hora de inicio:</strong> $hora_incio</p>
        <p><strong>Hora de fin:</strong> $hora_fin</p>
        <hr>
        <p>Gracias por confiar en nosotros. ¡Te esperamos!</p>
        ";
       

        // Envía el correo electrónico
        $mail->send();
        echo 'Correo electrónico enviado correctamente';
        $sql = "UPDATE topos_reservas
        SET estado = 1
        WHERE id = :id";

        $stmt3 = $pdo->prepare($sql);
        $stmt3->execute(array(':id' => $id));
        
    } catch (Exception $e) {
        echo "Error al enviar el correo electrónico: {$mail->ErrorInfo}";
        exit();
    }

    die();