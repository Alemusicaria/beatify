<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if (isset($_POST['idLlista'])) {
    $data = $_POST['idLlista'];

    $sql = "SELECT C.Titol AS TitolCanco, A.Titol AS TitolAlbum, U.NomUsuari AS Nombre_Usuario
        FROM Afegeix AS Afegeix
        INNER JOIN Canco AS C ON Afegeix.ID_Canco = C.ID
        INNER JOIN Llista_Reproduccio AS L ON Afegeix.ID_LlistaReproduccio = L.ID
        INNER JOIN Usuari AS U ON L.ID_Usuari = U.ID
        INNER JOIN Album AS A ON C.ID_Album = A.ID
        WHERE L.ID = $data";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Inicializar un array para almacenar los resultados
    $rows = array();

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Almacenar los resultados en el array
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    // Cerrar la conexión
    $conn->close();

    // Convertir el array a JSON y devolverlo
    echo json_encode($rows);

} else {
    echo json_encode(array('error' => 'No se encontraron canciones en la base de datos'));
}