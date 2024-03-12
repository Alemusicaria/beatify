<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDirectory = "../../img/";
    $nomUsuari = $_COOKIE['NomUsuari'];
    $targetDirectoryUser = $targetDirectory . "user/";
    $targetDirectoryNomUsuari = $targetDirectory . $nomUsuari . "/";

    // Crea les carpetes si no existeixen
    if (!file_exists($targetDirectoryUser)) {
        mkdir($targetDirectoryUser, 0777, true);
    }

    if (!file_exists($targetDirectoryNomUsuari)) {
        mkdir($targetDirectoryNomUsuari, 0777, true);
    }

    $targetFile = $targetDirectoryNomUsuari . basename($_FILES["fotoPerfil"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Comprovar si és una imatge real
    $check = getimagesize($_FILES["fotoPerfil"]["tmp_name"]);
    if ($check === false) {
        echo "L'arxiu no és una imatge.";
        $uploadOk = 0;
    }

    // Mida màxima de la imatge (pots ajustar-la segons les teves necessitats)
    if ($_FILES["fotoPerfil"]["size"] > 500000) {
        echo "La mida de l'arxiu és massa gran.";
        $uploadOk = 0;
    }

    // Formats d'imatge permesos (pots ajustar-los segons les teves necessitats)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Només s'admeten arxius JPG, JPEG, PNG i GIF.";
        $uploadOk = 0;
    }

    // Moure l'arxiu a la carpeta de destinació si tot està bé
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $targetFile)) {
            // No es necessari actualitzar la base de dades si no ho vols fer

            echo "La foto de perfil s'ha actualitzat correctament.";
        } else {
            echo "Error en moure l'arxiu.";
        }
    }
} else {
    // Sol·licitud GET per obtenir les opcions d'imatge
    $folderPath = "../../img/user/"; // Ajusta la ruta segons la teva estructura
    $imageOptions = scandir($folderPath);

    // Elimina els elements "." i ".." de la llista d'opcions
    $imageOptions = array_diff($imageOptions, array('..', '.'));

    // Envia la resposta com a JSON
    header('Content-Type: application/json');
    echo json_encode(array_values($imageOptions));
}
