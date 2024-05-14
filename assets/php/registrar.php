<?php
// Obté les dades enviades des del formulari
$nom = $_POST['name'];
$cognom = $_POST['surname'];
$email = $_POST['email'];
$usuari = $_POST['username'];
$contrasenya = $_POST['password'];
include 'conn.php';

// Escapa les dades per prevenir injeccions SQL
$nom = mysqli_real_escape_string($conn, $nom);
$cognom = mysqli_real_escape_string($conn, $cognom);
$email = mysqli_real_escape_string($conn, $email);
$usuari = mysqli_real_escape_string($conn, $usuari);

// Hash de la contrasenya
$contrasenya_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);

// Comprova si l'usuari ja existeix amb el mateix nom d'usuari o correu electrònic
$consulta_comprovacio = "SELECT * FROM Usuari WHERE NomUsuari='$usuari' OR Email='$email'";
$resultat_comprovacio = $conn->query($consulta_comprovacio);

if ($resultat_comprovacio->num_rows > 0) {
    // L'usuari ja existeix, envia una resposta d'error
    echo "ERROR_USUARI_EXISTENT";
} else {
    // L'usuari no existeix, procedeix amb el registre
    $insercio_consulta = "INSERT INTO Usuari (Contrasenya, Nom, Email, Cognom, NomUsuari, Foto, Premium, Admin) VALUES ('$contrasenya_hashed', '$nom', '$email', '$cognom', '$usuari', '../img/user/user.png', 0, 0)";

    if ($conn->query($insercio_consulta) === TRUE) {
        echo "OK";
    } else {
        // Hi va haver un error en el registre
        echo "ERROR_REGISTRE";
    }
}

// Tanca la connexió amb la base de dades
$conn->close();
