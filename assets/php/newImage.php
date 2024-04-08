<?php
// Aquí deberías incluir la lógica para actualizar la base de datos
if (isset($_POST['nuevaFoto']) && isset($_POST['username'])) {
    $nuevaFoto = $_POST['nuevaFoto'];
    $username = $_POST['username'];


    $servername = "localhost";
    $dbusername = "beatify";
    $dbpassword = "123456";
    $dbname = "Beatify";

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die('Error de conexión: ' . $conn->connect_error);
    }

    $consulta = $conn->prepare('UPDATE Usuari SET foto = ? WHERE NomUsuari = ?');
    $consulta->bind_param('ss', $nuevaFoto, $username);

    $consulta->execute();
    $consulta->close();
    $conn->close();
    echo 'Actualización exitosa';
} else {
    echo 'Error: Datos no recibidos';
}
