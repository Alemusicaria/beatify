<?php
include 'conn.php';

// Recollir les dades del formulari i escapar-les per prevenir injeccions SQL
$nom = $conn->real_escape_string($_POST['firstName']);
$cognom = $conn->real_escape_string($_POST['lastName']);
$nomUsuari = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$adreca = $conn->real_escape_string($_POST['address']);
$adreca2 = $conn->real_escape_string($_POST['address2']);
$pais = $conn->real_escape_string($_POST['country']);
$cp = $conn->real_escape_string($_POST['zip']);
$tipus = $conn->real_escape_string($_POST['pago']);
$nom_tarjeta = $conn->real_escape_string($_POST['cc-name']);
$num_tarjeta = $conn->real_escape_string($_POST['cc-number']);
$expiracio = $conn->real_escape_string($_POST['cc-expiration']);
$cvv = $conn->real_escape_string($_POST['cc-cvv']);

// Consulta per inserir les dades a la taula Pagament
$sql = "INSERT INTO pagament (ID_Usuari, Nom, Cognom, NomUsuari, Email, Adreca, Adreca2, Pais, CP, Tipus, Nom_tarjeta, Num_tarjeta, Expiracio, CVV) VALUES ($_COOKIE[UsuariID],'$nom', '$cognom', '$nomUsuari', '$email', '$adreca', '$adreca2', '$pais', '$cp', '$tipus', '$nom_tarjeta', '$num_tarjeta', '$expiracio', '$cvv')";

if ($conn->query($sql) === TRUE) {
    echo "Dades guardades correctament a la base de dades.";
} else {
    echo "Error en desar les dades a la base de dades: " . $conn->error;
}

// Tancar la connexió amb la base de dades
$conn->close();
