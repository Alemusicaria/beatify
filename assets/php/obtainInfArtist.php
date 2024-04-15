<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if (isset($_POST['selectedArtist'])) {
    $data = $_POST['selectedArtist'];

    $sql = "SELECT Artista.ID AS ID_Artista, Artista.Info, Album.Titol AS TitolAlbum, GROUP_CONCAT(Canco.Titol) AS Canciones
    FROM Artista
    INNER JOIN Album ON Artista.ID = Album.ID_Artista
    INNER JOIN Crea_musica ON Artista.ID = Crea_musica.ID_Artista
    LEFT JOIN Canco ON Crea_musica.ID_Canco = Canco.ID
    WHERE Artista.NomArtistic = '$data'
    GROUP BY Artista.ID, Album.Titol";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $array = array();
        while ($row = $result->fetch_assoc()) {
            $array[] = array(
                'TitolAlbum' => $row['TitolAlbum'],
                'Info' => $row['Info'],
                'Canciones' => explode(',', $row['Canciones'])
            );
        }
        echo json_encode($array);
    } else {
        echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
    }
}
?>
