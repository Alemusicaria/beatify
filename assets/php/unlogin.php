<?php

setcookie('NomUsuari', "", time() - 0, "/");
setcookie('Contrasenya', "", time() - 0, "/");
setcookie('UsuariID', "", time() - 0, "/");
header("Location: ../../webs/index.php");
