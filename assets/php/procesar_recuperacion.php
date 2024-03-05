<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico del formulario
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Validar el correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=invalid_email");
        exit();
    }

    // Verificar si el correo electrónico existe en tu base de datos (simulado)
    // Aquí deberías tener una lógica para comprobar si el correo electrónico está registrado

    // Generar un token único para el enlace de recuperación
    $token = uniqid();

    // Guardar el token en la base de datos junto con la dirección de correo electrónico y la fecha de expiración
    // Aquí deberías tener lógica para almacenar el token en tu base de datos

    // Enviar un correo electrónico con el enlace de recuperación
    $subject = "Recuperación de contraseña - Beatify";
    $message = "Hola,\n\nHemos recibido una solicitud para restablecer tu contraseña en Beatify. Haz clic en el siguiente enlace para continuar:\n\n";
    $message .= "http://tudominio.com/reset_password.php?token=$token\n\n";
    $message .= "Si no solicitaste esta recuperación, ignora este mensaje.\n\nSaludos,\nBeatify";

    // Envía el correo electrónico (ajusta según la configuración de tu servidor)
    $headers = "From: alemusicaria@gmail.com\r\n";
    mail($email, $subject, $message, $headers);

    // Redirige al usuario a una página de éxito o muestra un mensaje de éxito aquí
    header("Location: ./recuperacion_exitosa.html");
    exit();
}

?>
