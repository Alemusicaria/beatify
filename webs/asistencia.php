<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/asistencia.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/Logo_sense_fons.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Alza Esquis</title>

</head>

<body>
    <header>
        <h1 id="titol">Asistencia al Usuari - <a href="./index.php">Beatify</a></h1>
        <div class="menu">
            <a href="./index.php">Inici</a>
            <a href="./premium.php">Premium</a>
            <?php

            if (isset($_COOKIE['NomUsuari']) || !empty($_COOKIE['NomUsuari'])) {
                echo '
                <div class="perfil-dropdown">
                    <img src="../img/user/user.png" alt="" class="fotoPerfil" onclick="toggleDropdown()"/>
                </div>
    
                <ul class="dropdown-list">
                    <li><img src="../img/simbols/ajustes.png" alt="Ajustes"> <a href="./perfil.php">Configuració</a></li>
                    <li onclick="cerrarSesion()"><img src="../img/simbols/cerrar-sesion.png" alt="Cerrar sesión"><a href="#"> Tancar sessió </a></li>
                </ul>
            ';
            } else {
                echo "<li><button id=\"iniciarSessio\">Iniciar Sessió</button></li>";
            }
            ?>
        </div>
    </header>

    <form class="contacte-form" action="../assets/php/send_email.php" method="post">
        <h1>Envia'ns un Missatge</h1>
        <label for="name"></label>
        <input type="text" id="name" placeholder="Nom" required>
        <label for="telefono"></label>
        <input type="number" id="telefono" placeholder="Telefon" required>
        <label for="email"></label>
        <input type="email" id="email" placeholder="Email" required>
        <label for="assumpte"></label>
        <input type="text" id="assumpte" placeholder="Assumpte" required>
        <textarea name="textarea" id="textarea" cols="30" rows="3" placeholder="Missatge" required></textarea>
        <button>Enviar</button>
    </form>

    <footer>
        <div>
            <i class="fa fa-facebook-official"></i>
            <i class="fa fa-instagram"></i>
            <i class="fa fa-snapchat"></i>
            <i class="fa fa-pinterest-p"></i>
            <i class="fa fa-twitter"></i>
            <i class="fa fa-linkedin"></i>
        </div>
        <p>&copy; 2024 Beatify. Tots els drets reservats.</p>
    </footer>
    <script src="../assets/js/dadesUser.js"></script>
    <script src="../assets/js/cookies.js"></script>
</body>

</html>