<?php
// Obté les dades enviades des del formulari
$username = $_POST['username'];
$password = $_POST['password'];

// Connecta amb la base de dades (canvia les credencials segons la teva configuració)
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Escapa les dades per prevenir injeccions SQL
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Crea la consulta SQL per obtenir l'usuari de la base de dades
$sql = "SELECT * FROM Usuari WHERE NomUsuari='$username' AND Contrasenya='$password'";
$result = $conn->query($sql);

// Verifica si s'ha trobat un usuari amb les credencials proporcionades
if ($result->num_rows > 0) {
    // L'autenticació és exitosa
    echo "OK";
} else {
    // L'autenticació ha fallat
    echo "KO";
}

// Tanca la connexió amb la base de dades
$conn->close();
?>
