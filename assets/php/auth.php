<?php
// Obté les dades enviades des del formulari
$username = $_POST['username'];
$password = $_POST['password'];

// Connecta amb la base de dades (canvia les credencials segons la teva configuració)
$servername = "beatify.com";
$dbusername = "beatify";
$dbpassword = "123456";
$dbname = "Beatify";
echo "Abans";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
echo "Despres";

// Verifica la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Escapa les dades per prevenir injeccions SQL
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Crea la consulta SQL per obtenir l'usuari de la base de dades
$sql = "SELECT ID, Nom, Cognom, NomUsuari, Foto, Premium, Email FROM Usuari WHERE NomUsuari='$username' AND Contrasenya='$password'";
$result = $conn->query($sql);

// Inicializa un array para almacenar los resultados
$response = array();

// Verifica si s'ha trobat un usuari amb les credencials proporcionades
if ($result->num_rows > 0) {
    // L'autenticació és exitosa
    $row = $result->fetch_assoc();

    setcookie('NomUsuari', $username,  time() + (86400 * 1), "/"); // 86400 segundos = 1 día
    setcookie('Contrasenya', $password,  time() + (86400 * 1), "/"); // 86400 segundos = 1 día
    setcookie('UsuariID', $row['ID'], time() + (86400 * 1), "/"); // Guarda l'ID de l'usuari com a cookie

    // Agrega los datos del usuario al array de respuesta
    $response['status'] = "OK";
    $response['Nom'] = $row['Nom'];
    $response['Cognom'] = $row['Cognom'];
    $response['NomUsuari'] = $row['NomUsuari'];
    $response['Foto'] = $row['Foto'];
    $response['Premium'] = $row['Premium'];
    $response['Email'] = $row['Email'];
} else {
    // L'autenticació ha fallat
    $response['status'] = "KO";
}

// Imprime la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tanca la connexió amb la base de dades
$conn->close();
?>