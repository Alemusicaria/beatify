<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST["name"]) ? $_POST["name"] : "";
    $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $assumpte = isset($_POST["assumpte"]) ? $_POST["assumpte"] : "";
    $mensaje = isset($_POST["textarea"]) ? $_POST["textarea"] : "";

    $to = "$email";
    $subject = "Nuevo mensaje desde el formulario de contacto";
    $message = "Nombre: $nombre\nTeléfono: $telefono\nEmail: $email\nAsunto: $assumpte\nMensaje: $mensaje";
    $headers = "From: $email";

    mail($to, $subject, $message, $headers);
}
?>
