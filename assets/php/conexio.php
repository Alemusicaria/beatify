<?php
include 'conn.php'; // Incloure el fitxer de connexió a la base de dades

// Consulta SQL per obtenir les cançons amb l'ID de l'àlbum i la foto de l'àlbum
$sql = "SELECT Canco.ID AS ID_Canco, Canco.Titol, Canco.ID_Genere, Album.ID AS ID_Album, Album.Titol AS Titol_Album, Crea_musica.ID_Artista, Artista.NomArtistic AS Nom_Artista
        FROM Canco
        LEFT JOIN Album ON Canco.ID_Album = Album.ID
        LEFT JOIN Crea_musica ON Canco.ID = Crea_musica.ID_Canco
        LEFT JOIN Artista ON Crea_musica.ID_Artista = Artista.ID";

$result = $conn->query($sql);

// Verificar si hi ha resultats
if ($result->num_rows > 0) {
    // Inicialitzar un array per emmagatzemar les cançons
    $canciones = array();

    // Iterar sobre els resultats i afegir cada cançó a l'array
    while ($row = $result->fetch_assoc()) {
        $ID_Canco = $row['ID_Canco'];
        // Verificar si la cançó ja està present a l'array
        if (!isset($canciones[$ID_Canco])) {
            $canciones[$ID_Canco] = array(
                'ID_Canco' => $ID_Canco,
                'Titol' => $row['Titol'],
                'ID_Album' => $row['ID_Album'],
                'Titol_Album' => $row['Titol_Album'],
                'ID_Genere' => $row['ID_Genere'],
                'artistas' => array() // Inicialitzar un array per emmagatzemar els Artistes d'aquesta cançó
            );
        }

        // Afegir informació de l'Artista a la cançó actual
        if (!empty($row['ID_Artista']) && !empty($row['Nom_Artista'])) {
            $canciones[$ID_Canco]['artistas'][] = array(
                'ID_Artista' => $row['ID_Artista'],
                'Nom_Artista' => $row['Nom_Artista']
            );
        }
    }

    // Convertir l'array de cançons a un array simple
    $canciones = array_values($canciones);

    // Retornar l'array de cançons com a JSON
    echo json_encode($canciones);
} else {
    echo json_encode(array('error' => 'No s\'han trobat cançons a la base de dades'));
}

// Tancar la connexió a la base de dades
$conn->close();
