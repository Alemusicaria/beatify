<?php
// Conexión a la base de datos (modifica los valores según tu configuración)
$servername = "localhost";
$dbusername = "beatify";
$dbpassword = "123456";
$dbname = "Beatify";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(array('error' => 'Error de conexión a la base de datos')));
}

// Verificar si el usuario ha iniciado sesión
session_start();
if (isset($_SESSION['usuario'])) {
    // Obtener la información del usuario desde la sesión
    $usuario = $_SESSION['usuario'];

    // Devolver la información del usuario como JSON
    echo json_encode($usuario);
} else {
    echo json_encode(array('error' => 'No se ha iniciado sesión'));
}

// Cerrar la conexión a la base de datos
$conn->close();
?>