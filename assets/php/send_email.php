<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["name"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $assumpte = $_POST["assumpte"];
    $mensaje = $_POST["textarea"];

    $to = "angelelpidiocespedes9@gmail.com"; // Reemplaza con la dirección de correo a la que deseas enviar el formulario
    $subject = "Nuevo mensaje desde el formulario de contacto";
    $message = "Nombre: $nombre\nTeléfono: $telefono\nEmail: $email\nAsunto: $assumpte\nMensaje: $mensaje";

    // Puedes personalizar el encabezado del correo según tus necesidades
    $headers = "From: $email";

    // Envía el correo
    mail($to, $subject, $message, $headers);
}
?>
