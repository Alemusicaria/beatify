<?php
// Connecta con la base de datos (cambia las credenciales según tu configuración)
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Beatify";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
}


// Recollir dades del formulari
$nom = $_POST['firstName'];
$cognom = $_POST['lastName'];
$nomUsuari = $_POST['username'];
$email = $_POST['email'];
$adreca = $_POST['address'];
$adreca2 = $_POST['address2'];
$pais = $_POST['country'];
$cp = $_POST['zip'];
$tipus = $_POST['pago']; // Valor actualitzat pel JavaScript
$nom_tarjeta = $_POST['cc-name'];
$num_tarjeta = $_POST['cc-number'];
$expiracio = $_POST['cc-expiration'];
$cvv = $_POST['cc-cvv'];

// Obtener la fecha actual
$data_actual = date("Y-m-d");
echo $data_actual;

// Obtener el valor de la cookie preuFactura
$preuFactura = $_COOKIE['preu_factura'] ?? '';

// Definir el precio base
$precioBase = 10;

// Definir la función para calcular el IVA
function calcularIVA($pais)
{
    // Definir tasas de IVA para cada país
    $tasasIVA = array(
        "Espanya" => 21,
        "França" => 20,
        "Alemania" => 19,
        "Estats Units" => 0 // Asumiendo que en Estados Unidos no hay IVA
    );

    // Obtener la tasa de IVA del país seleccionado
    $tasaIVA = $tasasIVA[$pais];

    // Devolver la tasa de IVA
    return $tasaIVA;
}

// Obtener el país seleccionado almacenado en la cookie
$paisSeleccionado = $_COOKIE['selected_country'] ?? '';

// Si hay un país seleccionado, calcular su tasa de IVA correspondiente
if ($paisSeleccionado) {
    $tasaIVA = calcularIVA($paisSeleccionado);

    // Calcular el total basado en el valor de la cookie preuFactura y la tasa de IVA
    switch ($preuFactura) {
        case '10€/Mes':
            $total = $precioBase * (1 + $tasaIVA / 100);
            break;
        case '9.5€/Mes':
            $total = $precioBase * 2.85 * (1 + $tasaIVA / 100);
            break;
        case '9€/Mes':
            $total = $precioBase * 5.42 * (1 + $tasaIVA / 100);
            break;
        case '8.5€/Mes':
            $total = $precioBase * 10.2 * (1 + $tasaIVA / 100);
            break;
        default:
            $total = 0; // Si no se especifica la cookie, se utiliza el precio base
    }
}

// Preparar la consulta SQL con los valores que obtuvimos
$sql = "INSERT INTO Pagament (Nom, Cognom, NomUsuari, Email, Adreca, Adreca2, Pais, CP, Tipus, Nom_tarjeta, Num_tarjeta, Expiracio, CVV, Total)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssiissssd", $nom, $cognom, $nomUsuari, $email, $adreca, $adreca2, $pais, $cp, $tipus, $nom_tarjeta, $num_tarjeta, $expiracio, $cvv, $total);

// Executar consulta
if ($stmt->execute()) {
    echo "Pagament registrat amb èxit!";
    //header("Location: ../../webs/factura.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
