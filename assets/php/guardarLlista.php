<?php
include 'conn.php'; // Inclou el fitxer de connexió a la base de dades

// Recull el nom de la llista del formulari
$nomLlista = $_POST['nomLlista'];
$foto = "reggaeton";

// Assegura't que la cookie 'UsuariID' existeix
if (isset($_COOKIE['UsuariID'])) {
    $idUsuari = $_COOKIE['UsuariID']; // Obté l'ID de l'usuari des de la cookie

    // Prepara i executa la consulta per inserir el nom de la llista i l'ID de l'usuari a la taula 'llista_reproduccio'
    $sql = "INSERT INTO llista_reproduccio (Nom, ID_Usuari, Img) VALUES (?, ?, ?)";

    // Prepara la consulta
    $stmt = $conn->prepare($sql);

    // Vincula els paràmetres a la consulta preparada
    // 's' per a cadena (el nom de la llista) i 'i' per a enter (l'ID de l'usuari)
    $stmt->bind_param("sis", $nomLlista, $idUsuari, $foto);

    // Després de l'execució de la primera consulta per inserir la nova llista
    if ($stmt->execute()) {
        // Obté l'ID de la llista afegida
        $id_llista = $conn->insert_id;

        // Estableix el valor de l'ID de la llista com a cookie
        setcookie('ID_llista', $id_llista,  time() + (86400 * 1), "/");

        // Mostra l'ID de la llista afegida (opcional)
        echo "ID de la nova llista: " . $id_llista;
    } else {
        echo "Error en inserir dades a la taula 'llista_reproduccio': " . $stmt->error;
    }
} else {
    // Si no es pot verificar l'ID de l'usuari, mostra un missatge d'alerta i redirigeix a l'índex
    echo '<script>alert("No s\'ha pogut verificar l\'ID de l\'usuari."); window.location.href=\'./index.php\';</script>';
}

// Tanca la connexió amb la base de dades
$conn->close();
