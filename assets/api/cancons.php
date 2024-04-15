<?php

// Conexión a la base de datos
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
function veureCancons()
{
    global $conn;

    // Verificar si la canción ya está en la lista
    $sql = "SELECT * FROM Canco";
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
}
function veureCanconsID($id_Canco)
{
    global $conn;


    $sql = "SELECT * FROM Canco WHERE ID = $id_Canco";
    $resultado = $conn->query($sql);

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Convertir resultados a formato JSON
        $array = array();
        while ($fila = $resultado->fetch_assoc()) {
            $array[] = $fila;
        }
        echo json_encode($array);
    } else {
        echo "No se encontraron canciones";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    veureCancons();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Canco'])) {
    $id_Canco = $_POST['id_Canco'];
    veureCanconsID($id_Canco);
}

// Cerrar conexión
$conn->close();

?>
