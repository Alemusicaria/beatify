<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if (isset($_POST['selectedArtist'])) {
    $data = $_POST['selectedArtist'];

    $sql = "SELECT Artista.ID AS ID_Artista, Artista.Info, Album.Titol AS TitolAlbum, Canco.Titol AS Canciones
    FROM Artista
    INNER JOIN Album ON Artista.ID = Album.ID_Artista
    INNER JOIN Crea_musica ON Artista.ID = Crea_musica.ID_Artista
    LEFT JOIN Canco ON Crea_musica.ID_Canco = Canco.ID
    WHERE Artista.NomArtistic = '$data'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $artistInfo = array();
        $albums = array();
        $cancons = array();
        while ($row = $result->fetch_assoc()) {
            // Almacenar la información del artista solo una vez
            if (empty($artistInfo)) {
                $artistInfo = array(
                    'Info' => $row['Info']
                );
            }
            // Almacenar los álbumes y sus canciones
            $albums[] = array(
                'TitolAlbum' => $row['TitolAlbum'],
            );
            $cancons[] = array(
                'Canciones' => explode(',', $row['Canciones'])
            );
        }
        // Combina la información del artista y los álbumes
        $response = array(
            'Info' => $artistInfo['Info'],
            'Albums' => $albums,
            'Cancons' =>$cancons
        );
        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
    }
}

