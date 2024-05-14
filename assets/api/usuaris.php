<?php

// Connexió a la base de dades
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la connexió
if ($conn->connect_error) {
    die("Error de connexió: " . $conn->connect_error);
}

// Funció per veure tots els usuaris
function veureUsuaris()
{
    global $conn;

    // Consulta SQL per seleccionar tots els usuaris
    $sql = "SELECT ID, NomUsuari FROM Usuari";
    $resultado = $conn->query($sql);

    // Verificar si hi ha resultats
    if ($resultado->num_rows > 0) {
        // Convertir resultats a format JSON
        $array = array();
        while ($fila = $resultado->fetch_assoc()) {
            $array[] = $fila;
        }
        echo json_encode($array);
    } else {
        echo "No s'han trobat usuaris";
    }
}

// Funció per veure un usuari específic segons l'ID de l'usuari
function veureUsuariID($id_Usuari)
{
    global $conn;

    // Consulta SQL per seleccionar un usuari específic segons l'ID
    $sql = "SELECT ID, NomUsuari FROM Usuari WHERE ID = $id_Usuari";
    $resultado = $conn->query($sql);

    // Verificar si hi ha resultats
    if ($resultado->num_rows > 0) {
        // Convertir resultats a format JSON
        $array = array();
        while ($fila = $resultado->fetch_assoc()) {
            $array[] = $fila;
        }
        echo json_encode($array);
    } else {
        echo "No s'ha trobat cap usuari amb aquest ID";
    }
}

// Funció per crear un nou usuari
function crearUsuari($contrasenya, $nom, $email, $cognom, $nomUsuari)
{
    global $conn;

    // Hash de la contrasenya
    $password_hashed = password_hash($contrasenya, PASSWORD_DEFAULT);

    // Comprova si l'usuari ja existeix amb el mateix nom d'usuari o correu electrònic
    $check_query = "SELECT * FROM Usuari WHERE NomUsuari='$nomUsuari' OR Email='$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // L'usuari ja existeix, envia una resposta d'error
        echo "ERROR_USER_EXISTS";
    } else {
        // L'usuari no existeix, procedeix amb el registre
        $insert_query = "INSERT INTO Usuari (Contrasenya, Nom, Email, Cognom, NomUsuari, Foto, Premium) VALUES ('$password_hashed', '$nom', '$email', '$cognom', '$nomUsuari', NULL, 0)";

        if ($conn->query($insert_query) === TRUE) {
            echo "Usuari creat amb èxit";
        } else {
            // Hi va haver un error en el registre
            echo "ERROR_REGISTRATION";
        }
    }
}

// Lògica per gestionar les diferents peticions HTTP

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    veureUsuaris();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Usuari'])) {
    $id_Usuari = $_POST['id_Usuari'];
    veureUsuariID($id_Usuari);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contrasenya']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['cognom']) && isset($_POST['nomUsuari'])) {
    $contrasenya = $_POST['contrasenya'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $cognom = $_POST['cognom'];
    $nomUsuari = $_POST['nomUsuari'];
    crearUsuari($contrasenya, $nom, $email, $cognom, $nomUsuari);
}

// Tancar la connexió a la base de dades
$conn->close();
