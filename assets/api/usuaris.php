<?php

// Conexión a la base de datos
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
function veureUsuaris()
{
    global $conn;

    // Verificar si la canción ya está en la lista
    $sql = "SELECT ID,NomUsuari FROM Usuari";
    $resultado = $conn->query($sql);
    
    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Convertir resultados a formato JSON
        $array = array();
        while ($fila = $resultado->fetch_assoc()) {
            $array[] = $fila;
        }
        echo json_encode($array);
    } else {
        echo "No se encontraron canciones";
    }
}
function veureUsuariID($id_Usuari)
{
    global $conn;

    // Verificar si la canción ya está en la lista
    $sql = "SELECT ID,NomUsuari FROM Usuari WHERE ID = $id_Usuari";
    $resultado = $conn->query($sql);

    // Verificar si hay resultados
    if ($resultado->num_rows > 0) {
        // Convertir resultados a formato JSON
        $array = array();
        while ($fila = $resultado->fetch_assoc()) {
            $array[] = $fila;
        }
        echo json_encode($array);
    } else {
        echo "No se encontraron canciones";
    }
}
function crearUsuari($contrasenya,$nom,$email,$cognom,$nomUsuari)
{
    global $conn;

    // Hash de la contraseña
$password_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);

// Comprueba si el usuario ya existe con el mismo nombre de usuario o correo electrónico
$check_query = "SELECT * FROM Usuari WHERE NomUsuari='$nomUsuari' OR Email='$email'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    // El usuario ya existe, envía una respuesta de error
    echo "ERROR_USER_EXISTS";
} else {
    // El usuario no existe, procede con el registro
    $insert_query = "INSERT INTO Usuari (Contrasenya, Nom, Email, Cognom, NomUsuari, Foto, Premium) VALUES ('$password_hashed', '$nom', '$email', '$cognom', '$nomUsuari', NULL, 0)";

    if ($conn->query($insert_query) === TRUE) {
        echo "OK";
    } else {
        // Hubo un error en el registro
        echo "ERROR_REGISTRATION";
    }
}

}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    veureUsuaris();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Usuari'])) {
    $id_Usuari = $_POST['id_Usuari'];
    veureUsuariID($id_Usuari);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contrasenya'])&& isset($_POST['nom']) && isset($_POST['email'])&& isset($_POST['cognom']) && isset($_POST['nomUsuari'])) {
    $contrasenya = $_POST['contrasenya'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $cognom = $_POST['cognom'];
    $nomUsuari = $_POST['nomUsuari'];
    crearUsuari($contrasenya,$nom,$email,$cognom,$nomUsuari);
}

// Cerrar conexión
$conn->close();

?>
