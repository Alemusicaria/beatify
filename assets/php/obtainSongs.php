<?php
// Conexión a la base de datos (modifica los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $username, $password, $dbname);

if (is_array($_POST['artistas'])) {
    $jsonString = json_encode($_POST['artistas']); // Convertir array a cadena JSON
} else {
    $jsonString = $_POST['artistas']; // Suponer que ya es una cadena JSON
}

$data = json_decode($jsonString, true);


// Prepara una consulta SQL para obtener 5 canciones de los artistas proporcionados
$sql = "SELECT c.Titol 
        FROM Canco c
        INNER JOIN Crea_musica cm ON c.ID = cm.ID_Canco
        INNER JOIN Artista a ON cm.ID_Artista = a.ID
        WHERE a.NomArtistic IN ('" . implode("','", $data) . "') 
        LIMIT 5";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $canciones = array();
    // Guarda los nombres de las canciones en el array
    while ($row = $result->fetch_assoc()) {
        $canciones[] = $row["Titol"];
    }
    
    echo json_encode($canciones);
} else {
    echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
}

// Cierra la conexión
$conn->close();
