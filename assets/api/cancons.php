<?php

// Conexión a la base de datos
$servername = "localhost";
$dbusername = "beatify";
$dbpassword = "123456";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener todas las canciones
$sql = "SELECT * FROM canco";
$resultado = $conn->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Convertir resultados a formato JSON
    $canciones = array();
    while ($fila = $resultado->fetch_assoc()) {
        $canciones[] = $fila;
    }
    echo json_encode($canciones);
} else {
    echo "No se encontraron canciones";
}

// Cerrar conexión
$conn->close();

?>
