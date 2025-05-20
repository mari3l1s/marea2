<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Validar el correo
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Correo electrónico no válido.");
    }

    // Simulación de usuario existente (en producción, consulta tu base de datos)
    $usuarios = ["ejemplo1@gmail.com", "ejemplo2@gmail.com"];
    if (!in_array($email, $usuarios)) {
        exit("El correo no está registrado.");
    }

    // Crear token de recuperación
    $token = bin2hex(random_bytes(16));
    $enlace = "http://localhost/recuperar/reset-password.php?token=$token"; // Puedes guardar el token en la base de datos

    // Configurar PHPMailer
    $mail = new PHPMailer(true);
    try {
        // Configuración SMTP de Gmail
        $mail->isSMTP();
        $mail->Host       = 'oliverurenasantos@gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'oliverurenasantos@gmail.com'; // Cambia esto
        $mail->Password   = 'Oliversantos2008'; // Cambia esto
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Configurar correo
        $mail->setFrom('oliverurenasantos@gmail.com', 'Soporte');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Recupera tu contraseña';
        $mail->Body    = "Haz clic en el siguiente enlace para restablecer tu contraseña:<br><a href='$enlace'>$enlace</a>";

        $mail->send();
        echo "Instrucciones enviadas a tu correo.";
    } catch (Exception $e) {
        echo "No se pudo enviar el corre Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Acceso denegado.";
}
?>

