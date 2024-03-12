<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomUsuari = $_COOKIE['NomUsuari'];

    // Directori on es guardarà la imatge de l'usuari
    $directoriDesti = "../../img/" . $nomUsuari . "/";

    // Assegurar-se que el directori existeix, si no, crear-lo
    if (!file_exists($directoriDesti)) {
        mkdir($directoriDesti, 0777, true);
    }

    // Nom de l'arxiu sense l'extensió
    $nomArxiu = pathinfo($_FILES["fotoPerfil"]["name"], PATHINFO_FILENAME);

    // Extensió de l'arxiu
    $extensio = pathinfo($_FILES["fotoPerfil"]["name"], PATHINFO_EXTENSION);

    // Nom únic de l'arxiu amb número si ja existeix
    $arxiuDesti = $directoriDesti . $nomArxiu;
    $comptador = 1;

    while (file_exists($arxiuDesti . "." . $extensio)) {
        $arxiuDesti = $directoriDesti . $nomArxiu . '_' . $comptador;
        $comptador++;
    }

    $arxiuDesti .= "." . $extensio;

    if (move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $arxiuDesti)) {
        echo "Imatge guardada amb èxit.";
    } else {
        echo "Error en desar la imatge.";
    }
}
