<?php 

setcookie('NomUsuari', "", time() - 0, "/");
header("Location: ../../webs/index.php");
?>