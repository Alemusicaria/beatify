<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

// Conexión a la base de datos
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Función para agregar una canción a una lista de reproducción
function afegirCanconsLlista($idLista, $idCancion) {
    global $conn;
    
    // Verificar si la canción ya está en la lista
    $sql = "SELECT * FROM Afegeix WHERE ID_LlistaReproduccio = $idLista AND ID_Canco = $idCancion";
    $resultado = $conn->query($sql);
    
    if ($resultado->num_rows > 0) {
        echo "La canción ya está en la lista de reproducción";
        return;
    }
    
    // Insertar la canción en la lista de reproducción
    $sql = "INSERT INTO Afegeix (ID_LlistaReproduccio, ID_Canco) VALUES ($idLista, $idCancion)";
    if ($conn->query($sql) === TRUE) {
        echo "Canción agregada a la lista de reproducción";
    } else {
        echo "Error al agregar la canción: " . $conn->error;
    }
}
