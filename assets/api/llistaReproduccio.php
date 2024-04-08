<?php

// Variables para la conexión a la base de datos
$servername = "beatify.com";
$username = "root";
$password = "";
$dbname = "Beatify";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Función para agregar una canción a una lista de reproducción
function agregarCancionALista($idLista, $idCancion) {
    global $conn;
    
    // Verificar si la canción ya está en la lista
    $sql = "SELECT * FROM Afegeix WHERE ID_LlistaReproduccio = $idLista AND ID_Canco = $idCancion";
    $resultado = $conn->query($sql);
    
    if ($resultado->num_rows > 0) {
        echo "La canción ya está en la lista de reproducción";
        return;
    }
    
    // Insertar la canción en la lista de reproducción
    $sql = "INSERT INTO Afegeix (ID_LlistaReproduccio, ID_Canco) VALUES ($idLista, $idCancion)";
    if ($conn->query($sql) === TRUE) {
        echo "Canción agregada a la lista de reproducción";
    } else {
        echo "Error al agregar la canción: " . $conn->error;
    }
}

// Función para eliminar una canción de una lista de reproducción
function eliminarCancionDeLista($idLista, $idCancion) {
    global $conn;
    
    // Eliminar la canción de la lista de reproducción
    $sql = "DELETE FROM Afegeix WHERE ID_LlistaReproduccio = $idLista AND ID_Canco = $idCancion";
    if ($conn->query($sql) === TRUE) {
        echo "Canción eliminada de la lista de reproducción";
    } else {
        echo "Error al eliminar la canción: " . $conn->error;
    }
}

// Función para eliminar una lista de reproducción
function eliminarListaReproduccion($idLista) {
    global $conn;
    
    // Eliminar la lista de reproducción
    $sql = "DELETE FROM Llista_Reproduccio WHERE ID = $idLista";
    if ($conn->query($sql) === TRUE) {
        echo "Lista de reproducción eliminada";
    } else {
        echo "Error al eliminar la lista de reproducción: " . $conn->error;
    }
}

// Función para crear una lista de reproducción
function crearListaReproduccion($nombreLista, $idUsuario) {
    global $conn;
    
    // Insertar la lista de reproducción en la base de datos
    $sql = "INSERT INTO Llista_Reproduccio (ID_Usuari, Nom) VALUES ($idUsuario, '$nombreLista')";
    if ($conn->query($sql) === TRUE) {
        echo "Lista de reproducción creada";
    } else {
        echo "Error al crear la lista de reproducción: " . $conn->error;
    }
}

// Ruta para agregar una canción a una lista de reproducción
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_lista']) && isset($_POST['id_cancion'])) {
    $idLista = $_POST['id_lista'];
    $idCancion = $_POST['id_cancion'];
    agregarCancionALista($idLista, $idCancion);
}

// Ruta para eliminar una canción de una lista de reproducción
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_lista_eliminar']) && isset($_POST['id_cancion_eliminar'])) {
    $idListaEliminar = $_POST['id_lista_eliminar'];
    $idCancionEliminar = $_POST['id_cancion_eliminar'];
    eliminarCancionDeLista($idListaEliminar, $idCancionEliminar);
}

// Ruta para eliminar una lista de reproducción
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_lista_eliminar'])) {
    $idListaEliminar = $_POST['id_lista_eliminar'];
    eliminarListaReproduccion($idListaEliminar);
}

// Ruta para crear una lista de reproducción
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_lista']) && isset($_POST['id_usuario'])) {
    $nombreLista = $_POST['nombre_lista'];
    $idUsuario = $_POST['id_usuario'];
    crearListaReproduccion($nombreLista, $idUsuario);
}

// Cerrar conexión
$conn->close();

?>
