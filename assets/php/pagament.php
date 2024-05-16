<?php
include 'conn.php';

// Recull les dades del formulari
$nom = $_POST['firstName'];
$cognom = $_POST['lastName'];
$nomUsuari = $_POST['username'];
$email = $_POST['email'];
$adreca = $_POST['address'];
$adreca2 = $_POST['address2'];
$pais = $_POST['country'];
$cp = $_POST['zip'];
$tipus = $_POST['paymentMethod']; // Valor actualitzat pel JavaScript
$nom_tarjeta = $_POST['cc-name'];
$num_tarjeta = $_POST['cc-number'];
$expiracio = $_POST['cc-expiration'];
$cvv = $_POST['cc-cvv'];
$tipusFactura = $_POST['tipusFactura'];

// Obté la data actual
$data_actual = date("Y-m-d");

// Obté el valor de la cookie preuFactura
$preuFactura = $_COOKIE['preu_factura'] ?? '';

// Defineix el preu base
$preuBase = 10;

// Defineix la funció per calcular l'IVA
function calcularIVA($pais)
{
    // Defineix les taxes d'IVA per a cada país
    $taxesIVA = array(
        "Espanya" => 21,
        "França" => 20,
        "Alemania" => 19,
        "Estats Units" => 0 // Assumint que als Estats Units no hi ha IVA
    );

    // Obté la taxa d'IVA del país seleccionat
    $taxaIVA = $taxesIVA[$pais];

    // Retorna la taxa d'IVA
    return $taxaIVA;
}

// Obté el país seleccionat emmagatzemat a la cookie
$paisSeleccionat = $_COOKIE['selected_country'];

// Si hi ha un país seleccionat, calcula la seva taxa d'IVA corresponent
if ($paisSeleccionat) {
    $taxaIVA = calcularIVA($paisSeleccionat);

    // Calcula el total basat en el valor de la cookie preuFactura i la taxa d'IVA
    switch ($preuFactura) {
        case '10€/Mes':
            $total = $preuBase * (1 + $taxaIVA / 100);
            break;
        case '9.5€/Mes':
            $total = $preuBase * 2.85 * (1 + $taxaIVA / 100);
            break;
        case '9€/Mes':
            $total = $preuBase * 5.42 * (1 + $taxaIVA / 100);
            break;
        case '8.5€/Mes':
            $total = $preuBase * 10.2 * (1 + $taxaIVA / 100);
            break;
        default:
            $total = 0; // Si no s'especifica la cookie, s'utilitza el preu base
    }
}

// Escapa la variable $nomUsuari per evitar la injecció SQL
$nomUsuari = mysqli_real_escape_string($conn, $nomUsuari);

// Actualitza la taula usuari
$sql2 = "UPDATE usuari SET Premium = 1 WHERE NomUsuari = '$nomUsuari'";
$resultat = mysqli_query($conn, $sql2); // Executa la consulta SQL amb la connexió
if ($resultat) {
    echo "Base de dades actualitzada amb èxit";
} else {
    echo "Error en l'actualització de la base de dades: " . mysqli_error($conn);
}

// Prepara la consulta SQL amb els valors que hem obtingut
$sql = "INSERT INTO Pagament (Nom, Cognom, NomUsuari, Email, Adreca, Adreca2, Pais, CP, Tipus, Nom_tarjeta, Num_tarjeta, Expiracio, CVV, Total, Tipus_factura)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$consulta = $conn->prepare($sql);
$consulta->bind_param("sssssssiissssds", $nom, $cognom, $nomUsuari, $email, $adreca, $adreca2, $pais, $cp, $tipus, $nom_tarjeta, $num_tarjeta, $expiracio, $cvv, $total, $tipusFactura);

// Executa la consulta
if ($consulta->execute()) {
    echo "Pagament registrat amb èxit!";
    header("Location: ../../webs/factura.php");
    exit();
} else {
    echo "Error: " . $consulta->error;
}

$consulta->close();
$conn->close();
