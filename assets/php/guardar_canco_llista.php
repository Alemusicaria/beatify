<?php
header('Content-Type: application/json');

include 'conn.php'; // Incloure el fitxer de connexió a la base de dades

// Recull el ID de la llista dels cookies i l'ID de la cançó del formulari
$idLlista = $_COOKIE['ID_llista'];
$idCanco = $_POST['cancoID'];

// Assegura't que el cookie 'UsuariID' existeix
if (isset($_COOKIE['UsuariID'])) {
    $idUsuari = $_COOKIE['UsuariID']; // Obtenir l'ID de l'usuari des del cookie

    // Prepara i executa la consulta per inserir el ID de la cançó i el ID de la llista
    $sql = "INSERT INTO afegeix (ID_Canco, ID_LlistaReproduccio) VALUES (?, ?)";

    // Prepara la consulta
    $stmt = $conn->prepare($sql);

    // Vincula els paràmetres a la consulta preparada
    // 's' per a string (el nom de la llista) i 'i' per a integer (el ID de l'usuari)
    $stmt->bind_param("si", $idCanco, $idLlista);

    if ($stmt->execute()) {
        // Si s'ha inserit correctament, recuperar totes les cançons de la llista de reproducció
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
        // Comprovar si l'execució ha fallat a causa d'una clau duplicada
        if ($stmt->errno == 1062) {
            echo '<script>alert("No es pot afegir aquesta cançó a la llista.");</script>';
        } else {
            echo "Error en inserir dades a la taula afegeix: " . $stmt->error;
        }
    }
} else {
    // Si no es pot verificar l'ID de l'usuari, mostrar un missatge d'error i redirigir a la pàgina d'inici
    echo '<script>alert("No s\'ha pogut verificar l\'ID de l\'usuari."); window.location.href=\'./index.php\';</script>';
}

// Tancar la connexió amb la base de dades
$conn->close();

// Retornar les cançons com a resposta
echo json_encode($cancons);
