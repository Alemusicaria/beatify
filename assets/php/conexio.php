<?php
// Conexión a la base de datos (modifica los valores según tu configuración)
$servername = "beatify.com";
$dbusername = "beatify";
$dbpassword = "123456";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(array('error' => 'Error de conexión a la base de datos')));
}

// Consulta SQL para obtener las canciones con el ID del álbum y la foto del álbum
$sql = "SELECT canco.ID AS ID_Canco, canco.Titol, canco.ID_Genere, album.ID AS ID_Album, album.Titol AS Titol_Album, crea_musica.ID_Artista, artista.NomArtistic AS Nom_Artista
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
    while ($row = $result->fetch_assoc()) {
        $ID_Canco = $row['ID_Canco'];
        // Verificar si la canción ya está presente en el array
        if (!isset($canciones[$ID_Canco])) {
            $canciones[$ID_Canco] = array(
                'ID_Canco' => $ID_Canco,
                'Titol' => $row['Titol'],
                'ID_Album' => $row['ID_Album'],
                'Titol_Album' => $row['Titol_Album'],
                'ID_Genere' => $row['ID_Genere'],
                'artistas' => array() // Inicializar un array para almacenar los artistas de esta canción
            );
        }
        
        // Agregar información del artista a la canción actual
        if (!empty($row['ID_Artista']) && !empty($row['Nom_Artista'])) {
            $canciones[$ID_Canco]['artistas'][] = array(
                'ID_Artista' => $row['ID_Artista'],
                'Nom_Artista' => $row['Nom_Artista']
            );
        }
    }
    
    // Convertir el array de canciones a un array simple
    $canciones = array_values($canciones);
    
    // Devolver el array de canciones como JSON
    echo json_encode($canciones);
} else {
    echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
}

// Cerrar la conexión a la base de datos
$conn->close();
