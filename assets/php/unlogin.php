<?php
// Esborra les cookies establertes pel nom d'usuari, contrasenya, identificador d'usuari, premium, país seleccionat, tipus de factura i preu de la factura
setcookie('NomUsuari', "", time() - 3600, "/");
setcookie('Contrasenya', "", time() - 3600, "/");
setcookie('UsuariID', "", time() - 3600, "/");
setcookie('Premium', "", time() - 3600, "/");
setcookie('selected_country', "", time() - 3600, "/");
setcookie('tipus_factura', "", time() - 3600, "/");
setcookie('preu_factura', "", time() - 3600, "/");

// Redirigeix l'usuari a la pàgina d'inici del lloc web
header("Location: ../../webs/index.php");
