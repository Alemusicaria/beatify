<?php

// Connexió a la base de dades
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la connexió
if ($conn->connect_error) {
    die("Error de connexió: " . $conn->connect_error);
}

// Funció per veure totes les cançons
function veureCancons()
{
    global $conn;

    // Consulta SQL per seleccionar totes les cançons
    $sql = "SELECT * FROM Canco";
    $resultado = $conn->query($sql);

    // Verificar si hi ha resultats
    if ($resultado->num_rows > 0) {
        // Convertir resultats a format JSON
        $canciones = array();
        while ($fila = $resultado->fetch_assoc()) {
            $canciones[] = $fila;
        }
        echo json_encode($canciones);
    } else {
        echo "No s'han trobat cançons";
    }
}

// Funció per veure una cançó específica segons l'ID
function veureCanconsID($id_Canco)
{
    global $conn;

    // Consulta SQL per seleccionar una cançó segons l'ID
    $sql = "SELECT * FROM Canco WHERE ID = $id_Canco";
    $resultado = $conn->query($sql);

    // Verificar si hi ha resultats
    if ($resultado->num_rows > 0) {
        // Convertir resultats a format JSON
        $array = array();
        while ($fila = $resultado->fetch_assoc()) {
            $array[] = $fila;
        }
        echo json_encode($array);
    } else {
        echo "No s'han trobat cançons";
    }
}

// Si la petició és GET, crida la funció per veure totes les cançons
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    veureCancons();
}

// Si la petició és POST i s'ha proporcionat un ID de cançó, crida la funció per veure la cançó amb aquest ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Canco'])) {
    $id_Canco = $_POST['id_Canco'];
    veureCanconsID($id_Canco);
}

// Tancar la connexió a la base de dades
$conn->close();
