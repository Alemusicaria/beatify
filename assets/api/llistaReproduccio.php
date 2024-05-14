<?php

// Definició de les dades de connexió a la base de dades
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";

// Connexió a la base de dades
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verificar la connexió
if ($conn->connect_error) {
    die("Error de connexió: " . $conn->connect_error);
}

// Funció per veure totes les llistes de reproducció
function veureLlistes()
{
    global $conn;

    // Consulta SQL per seleccionar totes les llistes de reproducció
    $sql = "SELECT * FROM  Llista_Reproduccio";
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
        echo "No s'han trobat cançons";
    }
}

// Funció per veure les cançons d'una llista de reproducció específica segons l'ID de la llista
function veureCanconsLlista($id_Llista)
{
    global $conn;

    // Consulta SQL per seleccionar les cançons d'una llista de reproducció específica
    $sql = "SELECT * FROM Afegeix WHERE ID_LlistaReproduccio = $id_Llista";
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
        echo "No s'han trobat cançons";
    }
}

// Funció per afegir una cançó a una llista de reproducció
function afegirCanconsLlista($idLista, $idCancion)
{
    global $conn;

    // Verificar si la cançó ja està a la llista
    $sql = "SELECT * FROM Afegeix WHERE ID_LlistaReproduccio = $idLista AND ID_Canco = $idCancion";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "La cançó ja està a la llista de reproducció";
        return;
    }

    // Inserir la cançó a la llista de reproducció
    $sql = "INSERT INTO Afegeix (ID_LlistaReproduccio, ID_Canco) VALUES ($idLista, $idCancion)";
    if ($conn->query($sql) === TRUE) {
        echo "Cançó afegida a la llista de reproducció";
    } else {
        echo "Error en afegir la cançó a la llista de reproducció: " . $conn->error;
    }
}

// Funció per eliminar una cançó d'una llista de reproducció
function eliminarCancionDeLista($idLista, $idCancion)
{
    global $conn;

    // Eliminar la cançó de la llista de reproducció
    $sql = "DELETE FROM Afegeix WHERE ID_LlistaReproduccio = $idLista AND ID_Canco = $idCancion";
    if ($conn->query($sql) === TRUE) {
        echo "Cançó eliminada de la llista de reproducció";

        // Verificar si la llista de reproducció està buida
        $sql_check_empty = "SELECT COUNT(*) AS count FROM Afegeix WHERE ID_LlistaReproduccio = $idLista";
        $result = $conn->query($sql_check_empty);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        // Si la llista de reproducció està buida, eliminar-la
        if ($count == 0) {
            eliminarListaReproduccion($idLista);
        }
    } else {
        echo "Error en eliminar la cançó de la llista de reproducció: " . $conn->error;
    }
}

// Funció per eliminar una llista de reproducció
function eliminarListaReproduccion($idLista)
{
    global $conn;

    // Eliminar la llista de reproducció
    $sql = "DELETE FROM Llista_Reproduccio WHERE ID = $idLista";
    if ($conn->query($sql) === TRUE) {
        echo "Llista de reproducció eliminada";
    } else {
        echo "Error en eliminar la llista de reproducció: " . $conn->error;
    }
}

// Funció per crear una llista de reproducció
function crearListaReproduccion($nombreLista, $idUsuario)
{
    global $conn;

    // Inserir la llista de reproducció a la base de dades
    $sql = "INSERT INTO Llista_Reproduccio (ID_Usuari, Nom) VALUES ($idUsuario, '$nombreLista')";
    if ($conn->query($sql) === TRUE) {
        echo "Llista de reproducció creada";
    } else {
        echo "Error en crear la llista de reproducció: " . $conn->error;
    }
}

// Lògica per gestionar les diferents peticions HTTP

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    veureLlistes();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_Llista'])) {
    $id_Llista = $_POST['id_Llista'];
    veureCanconsLlista($id_Llista);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_lista']) && isset($_POST['id_cancion'])) {
    $idLista = $_POST['id_lista'];
    $idCancion = $_POST['id_cancion'];
    afegirCanconsLlista($idLista, $idCancion);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_lista_eliminar']) && isset($_POST['id_cancion_eliminar'])) {
    $idListaEliminar = $_POST['id_lista_eliminar'];
    $idCancionEliminar = $_POST['id_cancion_eliminar'];
    eliminarCancionDeLista($idListaEliminar, $idCancionEliminar);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_lista_eliminar'])) {
    $idListaEliminar = $_POST['id_lista_eliminar'];
    eliminarListaReproduccion($idListaEliminar);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_lista']) && isset($_POST['id_usuario'])) {
    $nombreLista = $_POST['nombre_lista'];
    $idUsuario = $_POST['id_usuario'];
    crearListaReproduccion($nombreLista, $idUsuario);
}

// Tancar la connexió a la base de dades
$conn->close();
