<?php
// Obtén el ID de usuario de la cookie
$userId = $_COOKIE['userId']; // Asegúrate de que 'userId' sea el nombre correcto de tu cookie

// Connecta con la base de datos (cambia las credenciales según tu configuración)
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Consulta SQL para actualizar el campo Premium
$sql = "UPDATE Usuari SET Premium = TRUE WHERE ID = $userId";

if ($conn->query($sql) === TRUE) {
    echo "El campo Premium se ha actualizado correctamente.";
} else {
    echo "Error al actualizar el campo Premium: " . $conn->error;
}

// Cierra la conexión
$conn->close();
?>
