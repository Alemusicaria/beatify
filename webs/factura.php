<!DOCTYPE html>
<html lang="ca">

<head>
  <meta charset="UTF-8">
  <title>Crear factures amb HTML, CSS i JavaScript</title>
  <link rel="stylesheet" href="../assets/assets_factura/css/main.css">
</head>

<body>
  <div class="control-bar">
    <div class="container">
      <div class="row">
        <div class="col-2-4">
          <div class="slogan">Facturació</div>
        </div>
        <div class="col-4 text-right">
          <a href="javascript:window.print()">Imprimir</a>
        </div><!--.col-->
      </div><!--.row-->
    </div><!--.container-->
  </div><!--.control-bar-->

  <header class="row">
    <div class="logoholder text-center">
      <img src="../assets/assets_factura/img/Logo_sense_fons.png">
    </div><!--.logoholder-->

    <div class="me">
      <p>
        <strong>Sistema Web S.A. de C.V.</strong><br>
        234/90, Carrer Juan Maragall<br>
        Catalunya, Lleida.<br>

      </p>
    </div><!--.me-->

    <div class="info">
      <p>
        <a href="http://beatify.com">beatify.com</a><br>
        <a href="mailto:info@obedalvarado.pw">beatify@beatify.com</a><br>
        Tel: +34 345-908-559<br>
      </p>
    </div><!-- .info -->

    <div class="bank">
      <p>
        Dades bancàries: <br>
        BEATIFY S.L<br>
        ES6721003979685416516194
      </p>
    </div><!--.bank-->

  </header>
  <?php
  // Connecta amb la base de dades (adapta les credencials segons la teva configuració)
  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "Beatify";
  $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Verifica la connexió
  if ($conn->connect_error) {
    die("Connexió fallida: " . $conn->connect_error);
  }

  // Consulta SQL per obtenir les dades del pagament
  $sql = "SELECT * FROM Pagament ORDER BY id DESC LIMIT 1"; // Suposant que l'ID és el camp clau primari

  $result = $conn->query($sql);

  $id = "";
  $nom = "";
  $cognom = "";
  $nomUsuari = "";
  $email = "";
  $adreca = "";
  $adreca2 = "";
  $pais = "";
  $cp = "";
  $tipus = "";
  $nom_tarjeta = "";
  $num_tarjeta = "";
  $expiracio = "";
  $cvv = "";

  if ($result->num_rows > 0) {
    // Assigna les dades a les variables
    $row = $result->fetch_assoc();
    $id = $row["ID"];
    $nom = $row["Nom"];
    $cognom = $row["Cognom"];
    $nomUsuari = $row["NomUsuari"];
    $email = $row["Email"];
    $adreca = $row["Adreca"];
    $adreca2 = $row["Adreca2"];
    $pais = $row["Pais"];
    $cp = $row["CP"];
    $tipus = $row["Tipus"];
    $nom_tarjeta = $row["Nom_tarjeta"];
    $num_tarjeta = $row["Num_tarjeta"];
    $expiracio = $row["Expiracio"];
    $cvv = $row["CVV"];
  } else {
    echo "0 resultats";
  }
  $conn->close();
  ?>


  <div class="row section">

    <div class="col-2">
      <h1>Factura</h1>
    </div><!--.col-->

    <div class="col-2 text-right details">
      <p>
        Data: <input type="text" class="datePicker" /><br>
        Factura #: <input type="text" value="<?php echo $id; ?>" /><br>
        Venciment: <input class="twoweeks" type="text" />
      </p>
    </div><!--.col-->



    <div class="col-2">
      <p class="client">
        <strong>Facturar a</strong><br>
        <?php echo $nom . ' ' . $cognom; ?><br>
        <?php echo $email; ?><br>
        <?php echo $adreca; ?><br>
        <?php echo $cp; ?><br>
        <?php echo $pais; ?><br>
      </p>
    </div><!--.col-->

  </div><!--.row-->

  <div class="row section" style="margin-top:-1rem">
    <div class="col-1">
      <table style='width:100%'>
        <thead>
          <tr class="invoice_detail">
            <th width="33%">Empresa</th>
            <th width="33%">Ordre de compra</th>
            <th width="33%">Termes i condicions</th>
          </tr>
        </thead>
        <tbody>
          <tr class="invoice_detail">
            <td width="33%">BEATIFY S.L</td>
            <td width="33%">#BY-2024 </td>
            <td width="33%">Pagament al comptat</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div><!--.row-->

  <div class="invoicelist-body">
    <table>
      <thead>
        <th width="83%">Descripció</th>
        <th width="17%">Preu</th>
        <th>IVA</th>
      </thead>
      <tbody>
        <tr>
          <td width='83%'><span>Descripció</span></td>
          <td class="rate"><input type="text" value="99" /></td>
          <td class="tax"></td>
        </tr>
      </tbody>
    </table>
  </div><!--.invoice-body-->

  <div class="invoicelist-footer">
    <table>
      <tr class="">
        <td>IVA:</td>
        <td id="total_tax"></td>
      </tr>
      <tr>
        <td><strong>Total:</strong></td>
        <td id="total_price"></td>
      </tr>
    </table>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="assets/bower_components/jquery/dist/jquery.min.js"><\/script>')
  </script>
  <script src="../assets/assets_factura/js/main.js"></script>
</body>

</html>