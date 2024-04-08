<?php
header('Content-Type: application/json');

// Conéctate a la base de datos (actualiza con tus credenciales)
$conexion = new mysqli("beatify.com", "root", "", "beatify");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener la información relacionada con canciones, álbumes y artistas
$consulta = "SELECT CANCO.Ruta_canco, CANCO.Img, ALBUM.Nombre AS AlbumNombre, 
                    ARTISTA.Nom AS ArtistaNombre, ARTISTA.Foto AS ArtistaFoto
             FROM CANCO
             INNER JOIN ALBUM ON CANCO.ID_Album = ALBUM.ID
             INNER JOIN CREA_MUSICA ON CANCO.ID = CREA_MUSICA.ID_Canco
             INNER JOIN ARTISTA ON CREA_MUSICA.ID_Artista = ARTISTA.ID";
$resultado = $conexion->query($consulta);

// Verifica si hay resultados
if ($resultado->num_rows > 0) {
    // Crea un array para almacenar los resultados
    $datos = array();

    // Recorre los resultados y agrega cada fila al array
    while ($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }

    // Devuelve los resultados como JSON
    echo json_encode($datos);
} else {
    // No hay resultados
    echo json_encode(array());
}

// Cierra la conexión
$conexion->close();
?>
