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
function veureUsuaris()
{
    global $conn;

    // Verificar si la canción ya está en la lista
    $sql = "SELECT ID,NomUsuari FROM Usuari";
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
function veureUsuariID($id_Usuari)
{
    global $conn;

    // Verificar si la canción ya está en la lista
    $sql = "SELECT ID,NomUsuari FROM Usuari WHERE ID = $id_Usuari";
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
    veureUsuaris();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Usuari'])) {
    $id_Usuari = $_POST['id_Usuari'];
    veureUsuariID($id_Usuari);
}

// Cerrar conexión
$conn->close();

?>
