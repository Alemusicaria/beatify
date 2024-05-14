<?php
include 'conn.php';

// Recibir el nombre de la lista del formulario
$nomLlista = $_POST['nomLlista'];
$foto = "Foto";

// Asegurar de que el cookie 'UsuariID' existe
if (isset($_COOKIE['UsuariID'])) {
    $idUsuari = $_COOKIE['UsuariID']; // Obtener el ID del usuario desde el cookie

    // Preparar y ejecutar la consulta para insertar el nombre de la lista y el ID del usuario
    $sql = "INSERT INTO llista_reproduccio (Nom, ID_Usuari, Img) VALUES (?, ?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros a la consulta preparada
    // 's' para string (el nombre de la lista) y 'i' para integer (el ID del usuario)
    $stmt->bind_param("sis", $nomLlista, $idUsuari, $foto);

    if ($stmt->execute()) {
    } else {
        echo "Error al insertar datos en la tabla Llista_Reproduccio: " . $stmt->error;
    }
} else {
    echo '<script>alert("No s\'ha pogut verificar l\'ID de l\'usuari."); window.location.href=\'./index.php\';</script>';
}

// Cerrar la conexión
$conn->close();
