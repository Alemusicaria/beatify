<?php
// Obté les dades enviades des del formulari
$username = $_POST['username'];
$password = $_POST['password'];

include 'conn.php';
// Escapa les dades per prevenir injeccions SQL
$username = mysqli_real_escape_string($conn, $username);

// Crea la consulta SQL per obtenir l'usuari de la base de dades
$sql = "SELECT ID, Nom, Cognom, NomUsuari, Foto, Premium, Email, Contrasenya, Admin FROM Usuari WHERE NomUsuari='$username'";
$result = $conn->query($sql);

// Inicialitza un array per emmagatzemar els resultats
$response = array();

// Verifica si s'ha trobat un usuari amb les credencials proporcionades
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verifica la contrasenya utilitzant password_verify
    if (password_verify($password, $row['Contrasenya'])) {
        // Autenticació exitosa
        setcookie('NomUsuari', $username,  time() + (86400 * 1), "/"); // 86400 segons = 1 dia
        setcookie('Contrasenya', $password,  time() + (86400 * 1), "/"); // 86400 segons = 1 dia
        setcookie('UsuariID', $row['ID'], time() + (86400 * 1), "/"); // Guarda l'ID de l'usuari com a cookie
        setcookie('Premium', $row['Premium'], time() + (86400 * 1), "/");
        // Afegeix les dades de l'usuari a l'array de resposta
        $response['status'] = "OK";
        $response['Nom'] = $row['Nom'];
        $response['Cognom'] = $row['Cognom'];
        $response['NomUsuari'] = $row['NomUsuari'];
        $response['Foto'] = $row['Foto'];
        $response['Premium'] = $row['Premium'];
        $response['Email'] = $row['Email'];
        $response['Admin'] = $row['Admin'];
    } else {
        // Autenticació fallida a causa de la contrasenya incorrecta
        $response['status'] = "KO";
    }
} else {
    // Autenticació fallida a causa que l'usuari no existeix
    $response['status'] = "KO";
}

// Imprimeix la resposta en format JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tanca la connexió amb la base de dades
$conn->close();
