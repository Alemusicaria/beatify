<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if (isset($_POST['selectedArtist'])) {
    $data = $_POST['selectedArtist'];

    $sql = "SELECT Artista.ID AS ID_Artista, Artista.Info, Album.Titol AS TitolAlbum, Canco.Titol AS TitolCanco
    FROM Artista
    INNER JOIN Album ON Artista.ID = Album.ID_Artista
    INNER JOIN Crea_musica ON Album.ID = Crea_musica.ID_Album
    INNER JOIN Canco ON Crea_musica.ID_Canco = Canco.ID
    WHERE Artista.NomArtistic = '$data'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $canciones = array();
        while ($row = $result->fetch_assoc()) {
            $titulo = $row["TitolCanco"];
            if (!isset($canciones[$titulo])) {
                $canciones[$titulo] = array(
                    'TitolCanco' => $row['TitolCanco'],
                    'TitolAlbum' => $row['TitolAlbum'],
                    'Info' => $row['Info']
                );
            } else {
                // Si ya existe la canción, agregar el álbum si no está en la lista
                if (!in_array($row['TitolAlbum'], $canciones[$titulo]['TitolAlbum'])) {
                    $canciones[$titulo]['TitolAlbum'][] = $row['TitolAlbum'];
                }
            }
        }
        $canciones = array_values($canciones);
        echo json_encode($canciones);
    } else {
        echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
    }
}
?>
