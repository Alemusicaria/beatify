<?php
// Conexión a la base de datos (modifica los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['artistas'])) {
    if (is_array($_POST['artistas'])) {
        $jsonString = json_encode($_POST['artistas']);
    } else {
        $jsonString = $_POST['artistas'];
    }

    $data = json_decode($jsonString, true);
    error_log("Contenido de \$data: " . print_r($data, true));

    // Prepara una consulta SQL para obtener 5 canciones de los artistas proporcionados
    $sql = "SELECT c.Titol 
            FROM Canco c
            INNER JOIN Crea_musica cm ON c.ID = cm.ID_Canco
            INNER JOIN Artista a ON cm.ID_Artista = a.ID
            WHERE a.NomArtistic IN ('" . implode("','", $data) . "') 
            LIMIT 5";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $canciones = array();
        while ($row = $result->fetch_assoc()) {
            $canciones[] = $row["Titol"];
        }

        echo json_encode($canciones);
    } else {
        echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
    }
} else {
    echo json_encode(array('error' => 'No se proporcionaron datos de artistas'));
}

$conn->close();
?>
