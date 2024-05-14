<?php
include 'conn.php'; // Incloure el fitxer de connexió a la base de dades

// Recollir el nom de la llista del formulari
$nomLlista = $_POST['nomLlista'];
$foto = "Foto"; // Assignar un valor per defecte per a la foto (caldrà canviar-ho)

// Assegurar-se que la cookie 'UsuariID' existeix
if (isset($_COOKIE['UsuariID'])) {
    $idUsuari = $_COOKIE['UsuariID']; // Obtenir l'ID de l'usuari des de la cookie

    // Preparar i executar la consulta per inserir el nom de la llista i l'ID de l'usuari
    $sql = "INSERT INTO llista_reproduccio (Nom, ID_Usuari, Img) VALUES (?, ?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Vincular els paràmetres a la consulta preparada
    // 's' per a cadena de text (el nom de la llista), 'i' per a enter (l'ID de l'usuari)
    $stmt->bind_param("sis", $nomLlista, $idUsuari, $foto);

    // Executar la consulta i comprovar si s'ha realitzat amb èxit
    if ($stmt->execute()) {
        // La inserció s'ha fet amb èxit
        // Aquí pots afegir qualsevol lògica addicional si és necessària
    } else {
        // Error en inserir dades a la taula Llista_Reproduccio
        echo "Error al insertar dades a la taula Llista_Reproduccio: " . $stmt->error;
    }
} else {
    // La verificació de la ID de l'usuari ha fallat
    echo '<script>alert("No s\'ha pogut verificar l\'ID de l\'usuari."); window.location.href=\'./index.php\';</script>';
}

// Tancar la connexió amb la base de dades
$conn->close();
