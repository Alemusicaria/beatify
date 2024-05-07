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
    <?php

    if (isset($_COOKIE['NomUsuari']) || !empty($_COOKIE['NomUsuari'])) {
      echo '<a href="pagament.php"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>';
    } else {
      echo '<a href="login.html"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>';
    }
    ?>

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
    <?php

    if (isset($_COOKIE['NomUsuari']) || !empty($_COOKIE['NomUsuari'])) {
      echo '<a href="pagament.php"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>';
    } else {
      echo '<a href="login.html"><i class="fa-solid fa-cart-shopping"></i> Comprar</a>';
    }
    ?>

  </div>
</section>
<script>
  // Añade un controlador de eventos de clic a todos los elementos .plan
  document.querySelectorAll('.plan').forEach(function(plan) {
    plan.addEventListener('click', function() {
      // Obtén el texto del título del plan clicado
      var titulo = this.querySelector('h2').textContent.trim();

      // Almacena el título en la variable global
      window.tipoFactura = titulo;
      console.log(window.tipoFactura);
    });
  });
</script>

</script>