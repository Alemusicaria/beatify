<?php
include 'conn.php';

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