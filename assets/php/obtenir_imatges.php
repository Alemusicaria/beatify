<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomUsuari = $_POST['nomUsuari'];
    $directoriImatgesUsuari = "../../img/" . $nomUsuari . "/";
    $directoriImatgesUser = "../../img/user/";

    $imatges = [];

    // Obté les imatges de l'usuari
    if (is_dir($directoriImatgesUsuari)) {
        $fitxersUsuari = glob($directoriImatgesUsuari . "*.{jpg,png,gif,jpeg}", GLOB_BRACE);
        foreach ($fitxersUsuari as $fitxer) {
            $imatges[] = "../img/" . $nomUsuari . "/" . basename($fitxer);
        }
    }

    // Obté les imatges de la carpeta ../../img/user
    if (is_dir($directoriImatgesUser)) {
        $fitxersUser = glob($directoriImatgesUser . "*.{jpg,png,gif,jpeg}", GLOB_BRACE);
        foreach ($fitxersUser as $fitxer) {
            $imatges[] = "../img/user/" . basename($fitxer);
        }
    }

    echo json_encode($imatges);
}
