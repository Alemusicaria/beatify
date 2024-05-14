<?php
include 'conn.php';

if (isset($_POST['selectedArtist'])) {
    $data = $_POST['selectedArtist'];

    $sql = "SELECT Artista.NomArtistic, Canco.Titol AS TitolCanco, Album.Titol AS TitolAlbum, Artista.Info,Artista.ID AS Artista_ID, Album.ID_Artista AS ID_AlArtista
    FROM Artista
    INNER JOIN Crea_musica ON Artista.ID = Crea_musica.ID_Artista
    INNER JOIN Canco ON Crea_musica.ID_Canco = Canco.ID
    LEFT JOIN Album ON Canco.ID_Album = Album.ID
    WHERE Artista.NomArtistic = '$data'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $artist_info = array();
        while ($row = $result->fetch_assoc()) {
            $artist_info['NomArtistic'] = $row['NomArtistic'];
            $artist_info['Info'] = $row['Info'];
            $artist_info['Artista_ID'] = $row['Artista_ID'];
            $titulo_canco = $row['TitolCanco'];

            if (!isset($artist_info['canciones'][$titulo_canco])) {
                $artist_info['canciones'][$titulo_canco] = array(
                    'TitolCanco' => $titulo_canco,
                    'Albums' => array()
                );
            }
            if (!empty($row['TitolAlbum'])) {
                $artist_info['canciones'][$titulo_canco]['Albums'][] = array(
                    'TitolAlbum' => $row['TitolAlbum'],
                    'ID_AlArtista' => $row['ID_AlArtista']
                );
            }
        }
        echo json_encode($artist_info);
    }

} else {
    echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
}
?>