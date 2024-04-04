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

    $sql = "SELECT c.ID_Album, c.Titol AS TitolCanco, al.Titol AS TitolAlbum
    FROM Canco c
    INNER JOIN Album al ON c.ID_Album = al.ID
    INNER JOIN Crea_musica cm ON c.ID = cm.ID_Canco
    INNER JOIN Artista a ON cm.ID_Artista = a.ID
    WHERE a.NomArtistic IN ('" . implode("','", $data) . "')";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $canciones = array();
        while ($row = $result->fetch_assoc()) {
            $titulo = $row["TitolCanco"];
            if (!isset($canciones[$titulo])) {
                $canciones[$titulo] = array(
                    'TitolCanco' => $row['TitolCanco'],
                    'TitolAlbum' => $row['TitolAlbum']
                );
            }
        }
        $canciones = array_values($canciones);
        echo json_encode($canciones);
    } else {
        echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
    }

} else {
    echo json_encode(array('error' => 'No se proporcionaron datos de artistas'));
}

$conn->close();
?>