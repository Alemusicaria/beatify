<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obté el nom d'usuari enviat pel formulari
    $nomUsuari = $_POST['nomUsuari'];

    // Defineix els directoris d'imatges per a l'usuari i les imatges d'usuari genèriques
    $directoriImatgesUsuari = "../../img/" . $nomUsuari . "/";
    $directoriImatgesUser = "../../img/user/";

    // Inicialitza un array per emmagatzemar les rutes de les imatges
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

    // Converteix l'array d'imatges a JSON i imprimeix
    echo json_encode($imatges);
}
