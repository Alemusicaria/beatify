<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if (isset($_POST['selectedArtist'])) {
    $data = $_POST['selectedArtist'];

    $sql = "SELECT Artista.NomArtistic, Canco.Titol AS TitolCanco, Album.Titol AS TitolAlbum, Artista.Info
    FROM Artista
    INNER JOIN Crea_musica ON Artista.ID = Crea_musica.ID_Artista
    LEFT JOIN Canco ON Crea_musica.ID_Canco = Canco.ID
    INNER JOIN Album ON Canco.ID_Album = Album.ID
    WHERE Artista.NomArtistic = '$data' AND Album.ID_Artista = Artista.ID";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $artist_info = array();
        while ($row = $result->fetch_assoc()) {
            $artist_info['NomArtistic'] = $row['NomArtistic'];
            $artist_info['Info'] = $row['Info'];
            $titulo_canco = $row['TitolCanco'];
            if (!isset($artist_info['canciones'][$titulo_canco])) {
                $artist_info['canciones'][$titulo_canco] = array(
                    'TitolCanco' => $titulo_canco,
                    'Albums' => array($row['TitolAlbum'])
                );
            } else {
                if (!in_array($row['TitolAlbum'], $artist_info['canciones'][$titulo_canco]['Albums'])) {
                    $artist_info['canciones'][$titulo_canco]['Albums'][] = $row['TitolAlbum'];
                }
            }
        }
        echo json_encode($artist_info);
    } else {
        echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
    }
}
?>
