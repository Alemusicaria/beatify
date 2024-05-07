<?php
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


// Recollir dades del formulari
$nom = $_POST['firstName'];
$cognom = $_POST['lastName'];
$nomUsuari = $_POST['username'];
$email = $_POST['email'];
$adreca = $_POST['address'];
$adreca2 = $_POST['address2'];
$pais = $_POST['country'];
$cp = $_POST['zip'];
$tipus = $_POST['pago']; // Valor actualitzat pel JavaScript
$nom_tarjeta = $_POST['cc-name'];
$num_tarjeta = $_POST['cc-number'];
$expiracio = $_POST['cc-expiration'];
$cvv = $_POST['cc-cvv'];

// Preparar consulta SQL
$sql = "INSERT INTO Pagament (Nom, Cognom, NomUsuari, Email, Adreca, Adreca2, Pais, CP, Tipus, Nom_tarjeta, Num_tarjeta, Expiracio, CVV) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssiissss", $nom, $cognom, $nomUsuari, $email, $adreca, $adreca2, $pais, $cp, $tipus, $nom_tarjeta, $num_tarjeta, $expiracio, $cvv);

// Executar consulta
if ($stmt->execute()) {
    echo "Pagament registrat amb èxit!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
