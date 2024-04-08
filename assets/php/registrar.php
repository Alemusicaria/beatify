<?php
// Obté les dades enviades des del formulari
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// Connecta amb la base de dades (canvia les credencials segons la teva configuració)
$servername = "localhost";
$dbusername = "beatify";
$dbpassword = "123456";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Escapa les dades per prevenir injeccions SQL
$name = mysqli_real_escape_string($conn, $name);
$surname = mysqli_real_escape_string($conn, $surname);
$email = mysqli_real_escape_string($conn, $email);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Comprova si l'usuari ja existeix amb el mateix nom d'usuari o email
$check_query = "SELECT * FROM Usuari WHERE NomUsuari='$username' OR Email='$email'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    // L'usuari ja existeix, envia una resposta d'error
    echo "ERROR_USER_EXISTS";
} else {
    // L'usuari no existeix, procedeix amb el registre
    $insert_query = "INSERT INTO Usuari (Contrasenya, Nom, Email, Cognom, NomUsuari, Foto, Premium) VALUES ('$password', '$name', '$email', '$surname', '$username', NULL, 0)";

    if ($conn->query($insert_query) === TRUE) {
        
        echo "OK";
    } else {
        // Hi ha hagut un error en el registre
        echo "ERROR_REGISTRATION";
    }
}

// Tanca la connexió amb la base de dades
$conn->close();
?>
