<?php
header('Content-Type: application/json');

// Configuració de la connexió a la base de dades
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beatify";

// Creació de la connexió
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprovar connexió
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}

// Obtindre el terme de cerca de la sol·licitud GET
$cercaTerm = $_GET['cerca'];

// Consulta a la base de dades amb una instrucció preparada per evitar la injecció SQL
$stmt = $conn->prepare("SELECT * FROM usuari WHERE Nom_usuari LIKE ?");
$stmt->bind_param("s", $cercaTerm);
$stmt->execute();

// Obtindre resultats
$result = $stmt->get_result();

// Convertir resultats a un array PHP
$users = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Tornar els resultats com a JSON
echo json_encode($users);

// Tancar connexió
$stmt->close();
$conn->close();
?>
