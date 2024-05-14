<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén els valors del formulari si estan definits, en cas contrari, assigna una cadena buida
    $nom = isset($_POST["name"]) ? $_POST["name"] : "";
    $telefon = isset($_POST["telefono"]) ? $_POST["telefono"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $assumpte = isset($_POST["assumpte"]) ? $_POST["assumpte"] : "";
    $missatge = isset($_POST["textarea"]) ? $_POST["textarea"] : "";

    // Adreça de correu electrònic de destinació
    $destinatari = "$email";

    // Assumpte del correu electrònic
    $assumpte_correu = "Nou missatge des del formulari de contacte";

    // Contingut del missatge
    $contingut_missatge = "Nom: $nom\nTelèfon: $telefon\nCorreu electrònic: $email\nAssumpte: $assumpte\nMissatge: $missatge";

    // Capçaleres del correu electrònic
    $capcaleres = "From: $email";

    // Envia el correu electrònic
    mail($destinatari, $assumpte_correu, $contingut_missatge, $capcaleres);
}
