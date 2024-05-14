<?php
include 'conn.php';

if (isset($_POST['artistas'])) {
    // Comprova si les dades rebudes són en format d'array JSON
    if (is_array($_POST['artistas'])) {
        $jsonString = json_encode($_POST['artistas']);
    } else {
        $jsonString = $_POST['artistas'];
    }

    // Decodifica les dades JSON rebudes
    $data = json_decode($jsonString, true);
    error_log("Contingut de \$data: " . print_r($data, true));

    // Construeix la consulta SQL per obtenir les cançons dels artistes seleccionats
    $sql = "SELECT Canco.ID_Album, Canco.Titol AS TitolCanco, Album.Titol AS TitolAlbum
    FROM Canco
    LEFT JOIN Album ON Canco.ID_Album = Album.ID
    INNER JOIN Crea_musica ON Canco.ID = Crea_musica.ID_Canco
    INNER JOIN Artista ON Crea_musica.ID_Artista = Artista.ID
    WHERE Artista.NomArtistic IN ('" . implode("','", $data) . "')";

    // Executa la consulta SQL
    $result = $conn->query($sql);

    // Comprova si hi ha resultats i construeix l'array de les cançons
    if ($result && $result->num_rows > 0) {
        $canciones = array();
        while ($row = $result->fetch_assoc()) {
            $titulo = $row["TitolCanco"];
            // Verifica si la cançó ja està present a l'array
            if (!isset($canciones[$titulo])) {
                $canciones[$titulo] = array(
                    'TitolCanco' => $row['TitolCanco'],
                    'TitolAlbum' => $row['TitolAlbum']
                );
            }
        }
        // Converteix l'array de les cançons a un array simple i retorna el JSON
        $canciones = array_values($canciones);
        echo json_encode($canciones);
    } else {
        // Retorna un missatge d'error si no es troben dades
        echo json_encode(array('error' => 'No s\'han trobat cançons a la base de dades'));
    }
} else {
    // Retorna un missatge d'error si no es proporcionen les dades dels artistes
    echo json_encode(array('error' => 'No s\'han proporcionat les dades dels artistes'));
}

// Tanca la connexió amb la base de dades
$conn->close();
