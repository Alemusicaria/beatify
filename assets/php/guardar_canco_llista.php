<?php
header('Content-Type: application/json');

// Conectar con la base de datos (ajusta las credenciales según tu configuración)
$servername = "beatify.com";
$dbusername = "beatify";
$dbpassword = "123456";
$dbname = "Beatify";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir el nombre de la lista del formulario
$idLlista = $_COOKIE['ID_llista'];
$idCanco = $_POST['cancoID'];

// Asegurar de que el cookie 'UsuariID' existe
if (isset($_COOKIE['UsuariID'])) {
    $idUsuari = $_COOKIE['UsuariID']; // Obtener el ID del usuario desde el cookie
    // Preparar y ejecutar la consulta para insertar el nombre de la lista y el ID del usuario
    $sql = "INSERT INTO afegeix (ID_Canco, ID_LlistaReproduccio) VALUES (?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros a la consulta preparada
    // 's' para string (el nombre de la lista) y 'i' para integer (el ID del usuario)
    $stmt->bind_param("si", $idCanco, $idLlista);

    if ($stmt->execute()) {
        // Recuperar totes les cançons de la llista de reproducció
        $sql_select = "SELECT c.* FROM canco c INNER JOIN afegeix a ON c.ID = a.ID_Canco WHERE a.ID_LlistaReproduccio = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $idLlista);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        // Guardar les cançons en un array
        $cancons = array();
        while ($row = $result->fetch_assoc()) {
            $cancons[] = $row;
        }
    } else {
        echo "Error al insertar datos en la tabla afegeix: " . $stmt->error;
    }
} else {
    echo '<script>alert("No s\'ha pogut verificar l\'ID de l\'usuari."); window.location.href=\'./index.php\';</script>';
}

// Tancar la connexió amb la base de dades
$conn->close();

// Retornar les cançons com a resposta
echo json_encode($cancons);

