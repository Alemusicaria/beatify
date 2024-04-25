<?php
// Obtén los datos enviados desde el formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Connecta con la base de datos (cambia las credenciales según tu configuración)
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Escapa los datos para prevenir inyecciones SQL
$username = mysqli_real_escape_string($conn, $username);

// Crea la consulta SQL para obtener el usuario de la base de datos
$sql = "SELECT ID, Nom, Cognom, NomUsuari, Foto, Premium, Email, Contrasenya FROM Usuari WHERE NomUsuari='$username'";
$result = $conn->query($sql);

// Inicializa un array para almacenar los resultados
$response = array();

// Verifica si se ha encontrado un usuario con las credenciales proporcionadas
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verifica la contraseña utilizando password_verify
    if (password_verify($password, $row['Contrasenya'])) {
        // Autenticación exitosa
        setcookie('NomUsuari', $username,  time() + (86400 * 1), "/"); // 86400 segundos = 1 día
        setcookie('Contrasenya', $password,  time() + (86400 * 1), "/"); // 86400 segundos = 1 día
        setcookie('UsuariID', $row['ID'], time() + (86400 * 1), "/"); // Guarda el ID del usuario como cookie

        // Agrega los datos del usuario al array de respuesta
        $response['status'] = "OK";
        $response['Nom'] = $row['Nom'];
        $response['Cognom'] = $row['Cognom'];
        $response['NomUsuari'] = $row['NomUsuari'];
        $response['Foto'] = $row['Foto'];
        $response['Premium'] = $row['Premium'];
        $response['Email'] = $row['Email'];
    } else {
        // Autenticación fallida debido a la contraseña incorrecta
        $response['status'] = "KO";
    }
} else {
    // Autenticación fallida debido a que el usuario no existe
    $response['status'] = "KO";
}

// Imprime la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cierra la conexión con la base de datos
$conn->close();
