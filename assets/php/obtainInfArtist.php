<?php
 $servername = "localhost";
 $dbusername = "root";
 $dbpassword = "";
 $dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if (isset($_POST['selectedArtist'])) {
    $data=$_POST['selectedArtist'];

    $sql = "SELECT Artista.ID, Artista.Info, Canco.Titol AS TitolCanco, Album.Titol AS TitolAlbum
    FROM Artista
    INNER JOIN Album  ON Artista.ID = Album.ID_Artista
    INNER JOIN Crea_musica ON Artista.ID = Crea_musica.ID_Artista
    INNER JOIN Canco ON Crea_musica.ID_Canco = Canco.ID
    WHERE Artista.NomArtistic IN ('" . implode("','", $data) . "')";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $array = array();
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
}