<?php
// Conexión a la base de datos (modifica los valores según tu configuración)
$servername = "localhost";
$dbusername = "beatify";
$dbpassword = "123456";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(array('error' => 'Error de conexión a la base de datos')));
}

// Consulta SQL para obtener las canciones con el ID del álbum y la foto del álbum
$sql = "SELECT Canco.ID AS ID_Canco, Canco.Titol, Canco.ID_Genere, Album.ID AS ID_Album, Album.Titol AS Titol_Album, Crea_musica.ID_Artista, Artista.NomArtistic AS Nom_Artista
        FROM Canco
        LEFT JOIN Album ON Canco.ID_Album = Album.ID
        LEFT JOIN Crea_musica ON Canco.ID = Crea_musica.ID_Canco
        LEFT JOIN Artista ON Crea_musica.ID_Artista = Artista.ID";

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
                'Artistas' => array() // Inicializar un array para almacenar los Artistas de esta canción
            );
        }
        
        // Agregar información del Artista a la canción actual
        if (!empty($row['ID_Artista']) && !empty($row['Nom_Artista'])) {
            $canciones[$ID_Canco]['Artistas'][] = array(
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
