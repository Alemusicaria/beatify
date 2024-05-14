<?php
include 'conn.php';

if (isset($_POST['idLlista'])) {
    // Obté l'ID de la llista enviat des del formulari
    $data = $_POST['idLlista'];

    // Construeix la consulta SQL per obtenir les cançons de la llista de reproducció
    $sql = "SELECT C.Titol AS TitolCanco, A.Titol AS TitolAlbum, U.NomUsuari AS Nombre_Usuario
        FROM Afegeix AS Afegeix
        INNER JOIN Canco AS C ON Afegeix.ID_Canco = C.ID
        INNER JOIN Llista_Reproduccio AS L ON Afegeix.ID_LlistaReproduccio = L.ID
        INNER JOIN Usuari AS U ON L.ID_Usuari = U.ID
        LEFT JOIN Album AS A ON C.ID_Album = A.ID
        WHERE L.ID = $data";

    // Executa la consulta SQL
    $result = $conn->query($sql);

    // Inicialitza un array per emmagatzemar els resultats
    $rows = array();

    // Verifica si hi ha resultats
    if ($result->num_rows > 0) {
        // Emmagatzema els resultats a l'array
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    // Tanca la connexió
    $conn->close();

    // Converteix l'array a JSON i retorna
    echo json_encode($rows);
} else {
    // Si no es proporciona l'ID de la llista, retorna un missatge d'error
    echo json_encode(array('error' => 'No s\'han trobat cançons a la base de dades'));
}
