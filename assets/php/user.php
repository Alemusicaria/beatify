<?php
// Inclou el fitxer de connexió a la base de dades
include 'conn.php';

// Inicia la sessió per gestionar l'estat de l'usuari
session_start();

// Verifica si l'usuari ha iniciat sessió
if (isset($_SESSION['usuario'])) {
    // Obté la informació de l'usuari emmagatzemada a la sessió
    $usuario = $_SESSION['usuario'];

    // Retorna la informació de l'usuari com a JSON
    echo json_encode($usuario);
} else {
    // Si no s'ha iniciat sessió, retorna un missatge d'error
    echo json_encode(array('error' => 'No s\'ha iniciat sessió'));
}

// Tanca la connexió amb la base de dades
$conn->close();
