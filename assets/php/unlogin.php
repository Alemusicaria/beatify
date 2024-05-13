<?php

setcookie('NomUsuari', "", time() - 0, "/");
setcookie('Contrasenya', "", time() - 0, "/");
setcookie('UsuariID', "", time() - 0, "/");
setcookie('Premium', "", time() - 0, "/");
setcookie('selected_country', "", time() - 0, "/");
setcookie('tipus_factura', "", time() - 0, "/");
setcookie('preu_factura', "", time() - 0, "/");
header("Location: ../../webs/index.php");
