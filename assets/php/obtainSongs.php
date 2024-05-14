<?php
include 'conn.php';

if (isset($_POST['artistas'])) {
    if (is_array($_POST['artistas'])) {
        $jsonString = json_encode($_POST['artistas']);
    } else {
        $jsonString = $_POST['artistas'];
    }

    $data = json_decode($jsonString, true);
    error_log("Contenido de \$data: " . print_r($data, true));

    $sql = "SELECT Canco.ID_Album, Canco.Titol AS TitolCanco, Album.Titol AS TitolAlbum
    FROM Canco
    LEFT JOIN Album  ON Canco.ID_Album = Album.ID
    INNER JOIN Crea_musica ON Canco.ID = Crea_musica.ID_Canco
    INNER JOIN Artista  ON Crea_musica.ID_Artista = Artista.ID
    WHERE Artista.NomArtistic IN ('" . implode("','", $data) . "')";

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