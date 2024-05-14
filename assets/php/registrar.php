<?php
// Obtén los datos enviados desde el formulario
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
include 'conn.php';

// Escapa los datos para prevenir inyecciones SQL
$name = mysqli_real_escape_string($conn, $name);
$surname = mysqli_real_escape_string($conn, $surname);
$email = mysqli_real_escape_string($conn, $email);
$username = mysqli_real_escape_string($conn, $username);

// Hash de la contraseña
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Comprueba si el usuario ya existe con el mismo nombre de usuario o correo electrónico
$check_query = "SELECT * FROM Usuari WHERE NomUsuari='$username' OR Email='$email'";
$check_result = $conn->query($check_query);

if ($check_result->num_rows > 0) {
    // El usuario ya existe, envía una respuesta de error
    echo "ERROR_USER_EXISTS";
} else {
    // El usuario no existe, procede con el registro
    $insert_query = "INSERT INTO Usuari (Contrasenya, Nom, Email, Cognom, NomUsuari, Foto, Premium, Admin) VALUES ('$password_hashed', '$name', '$email', '$surname', '$username', '../img/user/user.png', 0, 0)";

    if ($conn->query($insert_query) === TRUE) {
        echo "OK";
    } else {
        // Hubo un error en el registro
        echo "ERROR_REGISTRATION";
    }
}

// Cierra la conexión con la base de datos
$conn->close();
