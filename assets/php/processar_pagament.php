<?php
// Connecta amb la base de dades (canvia les credencials segons la teva configuració)
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}


// Recibir los datos del formulario y escaparlos para prevenir inyecciones SQL
$nom = $conn->real_escape_string($_POST['firstName']);
$cognom = $conn->real_escape_string($_POST['lastName']);
$nomUsuari = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$adreca = $conn->real_escape_string($_POST['address']);
$adreca2 = $conn->real_escape_string($_POST['address2']);
$pais = $conn->real_escape_string($_POST['country']);
$cp = $conn->real_escape_string($_POST['zip']);
$tipus = $conn->real_escape_string($_POST['paymentMethod']);
$nom_tarjeta = $conn->real_escape_string($_POST['cc-name']);
$num_tarjeta = $conn->real_escape_string($_POST['cc-number']);
$expiracio = $conn->real_escape_string($_POST['cc-expiration']);
$cvv = $conn->real_escape_string($_POST['cc-cvv']);

// Query para insertar los datos en la tabla Pagament
$sql = "INSERT INTO Pagament (Nom, Cognom, NomUsuari, Email, Adreca, Adreca2, Pais, CP, Tipus, Nom_tarjeta, Num_tarjeta, Expiracio, CVV) VALUES ('$nom', '$cognom', '$nomUsuari', '$email', '$adreca', '$adreca2', '$pais', '$cp', '$tipus', '$nom_tarjeta', '$num_tarjeta', '$expiracio', '$cvv')";

if ($conn->query($sql) === TRUE) {
    echo "Datos guardados correctamente en la base de datos.";
} else {
    echo "Error al guardar los datos en la base de datos: " . $conn->error;
}

// Cerrar la conexión con la base de datos
$conn->close();
