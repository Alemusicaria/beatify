<?php
$host = "localhost";
$username = "beatify";
$password = "123456";
$dbname = "Beatify";

// Connectar-se a la base de dades
$conexion = new mysqli($host, $username, $password, $dbname);

// Comprovar conexió
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
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

$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssssiissss", $nom, $cognom, $nomUsuari, $email, $adreca, $adreca2, $pais, $cp, $tipus, $nom_tarjeta, $num_tarjeta, $expiracio, $cvv);

// Executar consulta
if ($stmt->execute()) {
    echo "Pagament registrat amb èxit!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
