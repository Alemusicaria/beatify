<?php
// Conexión a la base de datos (modifica los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(array('error' => 'Error de conexión a la base de datos')));
}

// Consulta SQL para obtener las canciones con el ID del álbum y la foto del álbum
$sql = "SELECT canco.ID AS ID_Canco, canco.Titol, canco.ID_Genere, album.ID AS ID_Album, album.Titol AS Foto_Album, crea_musica.ID_Artista, artista.NomArtistic AS Nom_Artista
        FROM canco
        LEFT JOIN album ON canco.ID_Album = album.ID
        LEFT JOIN crea_musica ON canco.ID = crea_musica.ID_Canco
        LEFT JOIN artista ON crea_musica.ID_Artista = artista.ID";

$result = $conn->query($sql);


// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Inicializar un array para almacenar las canciones
    $canciones = array();

    // Iterar sobre los resultados y añadir cada canción al array
    // Iterar sobre los resultados y añadir cada canción al array
    while ($row = $result->fetch_assoc()) {
        $cancion = array(
            'ID_Canco' => $row['ID_Canco'],
            'Titol' => $row['Titol'],
            'ID_Album' => $row['ID_Album'],
            'Foto_Album' => $row['Foto_Album'],
            'ID_Genere' => $row['ID_Genere'],
            'ID_Artista' => $row['ID_Artista'], // Agregado para incluir el ID del Artista
            'Nom_Artista' => $row['Nom_Artista'], // Agregado para incluir el Nombre del Artista
        );
        $canciones[] = $cancion;
    }


    // Devolver el array de canciones como JSON
    echo json_encode($canciones);
} else {
    echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
}

// Cerrar la conexión a la base de datos
$conn->close();
