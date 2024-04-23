<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plans de Pagament - Beatify</title>
  <link rel="icon" href="../img/Logo_sense_fons.png">
  <link rel="stylesheet" type="text/css" href="../assets/css/premium.css">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/6102a80a3f.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Enlace a los archivos JavaScript externos -->
  <script src="../assets/js/perfil.js"></script>
  <script src="../assets/js/cookies.js"></script>
  <script src="../assets/js/dadesUser.js"></script>
</head>

<body>
  <header>
    <div class="titol_Logo">
      <a href="./index.php"><img src="../img/Logo_sense_fons.png" alt="Logo" class="logo"> </a>
      <h1 id="titol">Configuració Usuari - <a href="./index.php">Beatify</a> </h1>
    </div>
    <div class="menu">
      <a href="./index.php">Inici</a>
      <a href="./asistencia.php">Asistencia</a>
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
        echo "<ul><li><button id=\"iniciarSessio\">Iniciar Sessió</button></li><ul>";
      }
      ?>
    </div>
  </header>
  <div class="textoIntro">
    <h1>Desbloqueja tot el potencial musical amb Beatify Premium!</h1>
    <p>A Beatify, creiem que la música té el poder de transformar el teu dia, inspirar emocions i crear records
      duradors. Imagina tenir accés il·limitat a un univers de sons, sense interrupcions, i descobrir les teves cançons
      favorites sense límits. Beatify Premium fa realitat aquesta experiència!</p>
    <ul>
      <li>Sense anuncis molestos</li>
      <li>Descàrregues il·limitades</li>
      <li>Qualitat d'àudio superior</li>
      <li>Explora sense límits</li>
      <li>Experiència sense restriccions</li>
    </ul>
    <p>Fes que cada nota compti i porta la teva experiència musical al següent nivell amb Beatify Premium. Subscriu-te
      ara i descobreix un món de possibilitats sonores!</p>
    <p>La música mereix ser viscuda sense límits, i Beatify Premium ho fa possible! Subscriu-te avui i eleva la teva
      experiència musical a noves altures.</p>
  </div>
  <div class="comparison-table">
    <table>
      <thead>
        <tr>
          <th>Inclou</th>
          <th>Gratuït</th>
          <th>Premium</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Musica sense Anuncis</th>
          <td>No</td>
          <td>Si</td>
        </tr>
        <tr>
          <th>Qualitat d'àudio</th>
          <td>Baixa</td>
          <td>Alta</td>
        </tr>
        <tr>
          <th>Poder escoltar Música Offline</th>
          <td>No</td>
          <td>Si</td>
        </tr>
        <tr>
          <th>Salt de Cançons</th>
          <td>Limitat</td>
          <td>Ilimitat</td>
        </tr>
        <tr>
          <th>Poder triar l'ordre de les cançons</th>
          <td>No</td>
          <td>Si</td>
        </tr>
      </tbody>
    </table>
  </div>


  <section>
    <div class="plan">
      <h2>Gratuït</h2>
      <ul class="avantatges">
        <li>Accés a biblioteca bàsica</li>
        <li>Reproducció amb anuncis</li>
      </ul>
      <ul class="desavantatges">
        <li>Qualitat d'àudio limitada</li>
        <li>Anuncis entre cançons</li>
      </ul>
    </div>

    <div class="plan">
      <h2>Premium Mensual - 12.10€/Mes</h2>
      <ul class="avantatges">
        <li>Accés a tota la biblioteca</li>
        <li>Reproducció sense anuncis</li>
        <li>Qualitat d'àudio millorada</li>
      </ul>
      <ul class="desavantatges">
        <li>Cost mensual</li>
        <li>Requereix subscripció</li>
      </ul>
      <?php

      if (isset($_COOKIE['NomUsuari']) || !empty($_COOKIE['NomUsuari'])) {
        echo '<a href="pagament.php"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>';
      } else {
        echo '<a href="login.html"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>';
      }
      ?>

    </div>
  </section>
  <section>
    <div class="plan">
      <h2>Premium Trimestral - 9.5€/Mes</h2>
      <ul class="avantatges">
        <li>Accés a tota la biblioteca</li>
        <li>Reproducció sense anuncis</li>
        <li>Qualitat d'àudio millorada</li>
      </ul>
      <ul class="desavantatges">
        <li>Cost mensual</li>
        <li>Requereix subscripció</li>
      </ul>
      <a href="pagament.php"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>

    </div>

    <div class="plan">
      <h2>Premium Semestral - 9€/Mes</h2>
      <ul class="avantatges">
        <li>Accés a tota la biblioteca</li>
        <li>Reproducció sense anuncis</li>
        <li>Qualitat d'àudio millorada</li>
      </ul>
      <ul class="desavantatges">
        <li>Cost mensual</li>
        <li>Requereix subscripció</li>
      </ul>
      <a href="pagament.php"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>

    </div>
  </section>
  <footer>
    <p>&copy; 2024 Beatify. Tots els drets reservats.</p>
  </footer>
</body>

</html>