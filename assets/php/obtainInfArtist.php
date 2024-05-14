<?php
include 'conn.php';

if (isset($_POST['selectedArtist'])) {
    $data = $_POST['selectedArtist'];

    // Consulta per obtenir la informació de l'artista seleccionat
    $sql = "SELECT Artista.NomArtistic, Canco.Titol AS TitolCanco, Album.Titol AS TitolAlbum, Artista.Info, Artista.ID AS Artista_ID, Album.ID_Artista AS ID_AlArtista
    FROM Artista
    INNER JOIN Crea_musica ON Artista.ID = Crea_musica.ID_Artista
    INNER JOIN Canco ON Crea_musica.ID_Canco = Canco.ID
    LEFT JOIN Album ON Canco.ID_Album = Album.ID
    WHERE Artista.NomArtistic = '$data'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Inicialitza un array per emmagatzemar la informació de l'artista
        $artist_info = array();
        while ($row = $result->fetch_assoc()) {
            $artist_info['NomArtistic'] = $row['NomArtistic'];
            $artist_info['Info'] = $row['Info'];
            $artist_info['Artista_ID'] = $row['Artista_ID'];
            $titulo_canco = $row['TitolCanco'];

            // Comprova si la cançó ja està present a l'array
            if (!isset($artist_info['canciones'][$titulo_canco])) {
                $artist_info['canciones'][$titulo_canco] = array(
                    'TitolCanco' => $titulo_canco,
                    'Albums' => array()
                );
            }
            // Afegeix la informació de l'àlbum si existeix
            if (!empty($row['TitolAlbum'])) {
                $artist_info['canciones'][$titulo_canco]['Albums'][] = array(
                    'TitolAlbum' => $row['TitolAlbum'],
                    'ID_AlArtista' => $row['ID_AlArtista']
                );
            }
        }
        // Retorna la informació de l'artista com a JSON
        echo json_encode($artist_info);
    }
} else {
    // Retorna un missatge d'error si no es troben dades
    echo json_encode(array('error' => 'No s\'han trobat cançons a la base de dades'));
}
