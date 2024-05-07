<?php
// Connecta amb la base de dades (adapta les credencials segons la teva configuració)
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Consulta SQL per obtenir les dades del pagament
$sql = "SELECT * FROM Pagament ORDER BY id DESC LIMIT 1"; // Suposant que l'ID és el camp clau primari

$result = $conn->query($sql);

$nom = "";
$cognom = "";
$nomUsuari = "";
$email = "";
$adreca = "";
$adreca2 = "";
$pais = "";
$cp = "";
$tipus = "";
$nom_tarjeta = "";
$num_tarjeta = "";
$expiracio = "";
$cvv = "";

if ($result->num_rows > 0) {
    // Assigna les dades a les variables
    $row = $result->fetch_assoc();
    $nom = $row["Nom"];
    $cognom = $row["Cognom"];
    $nomUsuari = $row["NomUsuari"];
    $email = $row["Email"];
    $adreca = $row["Adreca"];
    $adreca2 = $row["Adreca2"];
    $pais = $row["Pais"];
    $cp = $row["CP"];
    $tipus = $row["Tipus"];
    $nom_tarjeta = $row["Nom_tarjeta"];
    $num_tarjeta = $row["Num_tarjeta"];
    $expiracio = $row["Expiracio"];
    $cvv = $row["CVV"];
} else {
    echo "0 resultats";
}
$conn->close();
