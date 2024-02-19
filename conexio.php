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

// Consulta SQL para obtener las canciones
$sql = "SELECT Titol, Img FROM canco";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Inicializar un array para almacenar las canciones
    $canciones = array();

    // Iterar sobre los resultados y añadir cada canción al array
    while ($row = $result->fetch_assoc()) {
        $cancion = array(
            'Titol' => $row['Titol'],
            'Img' => $row['Img'],
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
?>
