<?php
// Aquí deberies incloure la lògica per actualitzar la base de dades
if (isset($_POST['nuevaFoto']) && isset($_POST['username'])) {
    $nuevaFoto = $_POST['nuevaFoto'];
    $username = $_POST['username'];
    
    include 'conn.php'; // Incloure el fitxer de connexió a la base de dades

    // Prepara i executa la consulta per actualitzar la foto de l'usuari
    $consulta = $conn->prepare('UPDATE Usuari SET foto = ? WHERE NomUsuari = ?');
    $consulta->bind_param('ss', $nuevaFoto, $username);

    $consulta->execute();
    $consulta->close();
    $conn->close();
    echo 'Actualització exitosa';
} else {
    echo 'Error: Dades no rebudes';
}
