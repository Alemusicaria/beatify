<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenir el correu electrònic del formulari
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Validar el correu electrònic
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirigir si el correu electrònic no és vàlid
        header("Location: index.php?error=invalid_email");
        exit();
    }

    // Verificar si el correu electrònic existeix a la base de dades (simulat)
    // Aquí hauries de tenir una lògica per comprovar si el correu electrònic està registrat

    // Generar un token únic per a l'enllaç de recuperació
    $token = uniqid();

    // Guardar el token a la base de dades juntament amb el correu electrònic i la data d'expiració
    // Aquí hauries de tenir una lògica per emmagatzemar el token a la base de dades

    // Enviar un correu electrònic amb l'enllaç de recuperació
    $subject = "Recuperació de contrasenya - Beatify";
    $message = "Hola,\n\nHem rebut una sol·licitud per restablir la teva contrasenya a Beatify. Fes clic al següent enllaç per continuar:\n\n";
    $message .= "http://tudomini.com/reset_password.php?token=$token\n\n";
    $message .= "Si no has sol·licitat aquesta recuperació, ignora aquest missatge.\n\nSalutacions,\nBeatify";

    // Envia el correu electrònic (ajusta-ho segons la configuració del teu servidor)
    $headers = "From: alemusicaria@gmail.com\r\n";
    mail($email, $subject, $message, $headers);

    // Redirigeix l'usuari a una pàgina d'èxit o mostra un missatge d'èxit aquí
    header("Location: ./recuperacio_exitosa.html");
    exit();
}
