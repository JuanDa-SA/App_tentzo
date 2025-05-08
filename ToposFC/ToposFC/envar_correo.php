<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$data = json_decode(file_get_contents('php://input'), true);



if ($data) {
    $day = $data['day'];
    $month = $data['month'];
    $year = $data['year'];
    $eventDetails = $data['events'][0];
    $title = $eventDetails['title'];
    $motive = $eventDetails['motive'];
    $nombre = $eventDetails['nombre'];
    $mailo = $eventDetails['mail'];
    $tel = $eventDetails['telefono'];
    $time_i = $eventDetails['time_i'];
    $time_f = $eventDetails['time_f'];
    $monto = '100 USD';
    $banco = 'Banco Nacional';
    $numero_cuenta = '1234567890';
    $referencia_pago = 'RP20240615';
    
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0; // Cambia a 2 para obtener más detalles de depuración
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'salmeronjuan519@gmail.com';
        $mail->Password   = 'hywg tyil jhnz eusf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('salmeronjuan519@gmail.com', 'La madriguera');
        // $mail->addAddress('jcuatepotzo58@gmail.com');
        $mail->addAddress($mailo);

        $mail->isHTML(true);
        $mail->Subject = 'Reserva de cancha de cancha';
        $mail->CharSet = 'UTF-8';

        $mail->Body = "
        <p>Hola <strong>$nombre</strong>,</p>
        <p>Gracias por registrarte en <strong>La Madriguera</strong>. Hemos recibido tu solicitud de reserva y estamos procesándola.</p><hr>
        <h3>Detalles de tu Solicitud de Reserva</h3>
        <p><strong>Título:</strong> $title</p>
        <p><strong>Motivo:</strong> $motive</p>
        <hr>
        <h3>Fecha y Hora Solicitadas</h3>
        <p><strong>Día:</strong> $day</p>
        <p><strong>Mes:</strong> $month</p>
        <p><strong>Año:</strong> $year</p>
        <p><strong>Hora de inicio:</strong> $time_i</p>
        <p><strong>Hora de fin:</strong> $time_f</p>
        <hr>
        <h3>Información de Pago</h3>
        <p>Para confirmar tu reserva, por favor realiza el pago utilizando la siguiente información:</p>
        <p><strong>Monto:</strong> $monto</p>
        <p><strong>Banco:</strong> $banco</p>
        <p><strong>Número de cuenta:</strong> $numero_cuenta</p>
        <p><strong>Referencia:</strong> $referencia_pago</p>
        <p>Por favor, envíanos el comprobante de pago a este correo para proceder con la confirmación de tu reserva.</p>
        <p>Te notificaremos tan pronto como tu reserva sea confirmada. Si tienes alguna pregunta, no dudes en contactarnos.</p>
        <p>Saludos,<br>El equipo de La Madriguera</p>";

        $mail->send();
        echo 'Correo electrónico enviado correctamente';
        

        // Actualizar la base de datos si es necesario
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
}