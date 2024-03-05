<?php 

setcookie('NomUsuari', "", time() - 0, "/");
header("Location: ../index.php");
?>