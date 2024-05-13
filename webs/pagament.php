<!doctype html>
<html lang="ca" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Beatify | Pagament</title>
    <link rel="icon" href="../img/Logo_sense_fons.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/css/pagament.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <a href="index.php">
                    <img class="d-block mx-auto mb-4" src="../img/Logo_sense_fons.png" alt="" width="72" height="57">
                </a>
                <h2>Formulari de pagament</h2>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Carret</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Beatify Premium</h6>
                                <small class="text-body-secondary" id="tipusFactura"></small>
                            </div>
                            <span class="text-body-secondary" id="preuFactura"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (EURO)</span>
                            <?php
                            // Obtener el valor de la cookie preuFactura
                            $preuFactura = $_COOKIE['preu_factura'] ?? '';
                            // Definir el precio base
                            $precioBase = 12.10;

                            // Calcular el total basado en el valor de la cookie preuFactura
                            switch ($preuFactura) {
                                case '10€/Mes':
                                    $total = $precioBase;
                                    break;
                                case '9.5€/Mes':
                                    $total = $precioBase * 2.85; // 2.85 = 34.48 / 12.10
                                    break;
                                case '9€/Mes':
                                    $total = $precioBase * 5.42; // 5.42 = 65.34 / 12.10
                                    break;
                                case '8.5€/Mes':
                                    $total = $precioBase * 10.2; // 10.2 = 123.42 / 12.10
                                    break;
                                default:
                                    $total = 0; // Si no se especifica la cookie, se utiliza el precio base
                            }

                            // Imprimir el total
                            echo "<strong>" . number_format($total, 2) . "€</strong>";
                            ?>
                        </li>
                    </ul>

                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Adreça de Pagament</h4>
                    <form class="needs-validation" action="../assets/php/pagament.php" method="post" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Cal un nom vàlid.
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Cognom</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Cal un cognom vàlid.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="username" class="form-label">Nom d'usuari</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Nom d'usuari" value="<?php echo htmlspecialchars($_COOKIE['NomUsuari'] ?? ''); ?>" readonly>
                                </div>
                            </div>


                            <div class="col-12">
                                <label for="email" class="form-label">Correu electrònic</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="tu@exemple.com" required>
                                <div class="invalid-feedback">
                                    Si us plau, introdueixi una adreça de correu electrònic vàlida per a actualitzacions
                                    d'enviament.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">Adreça</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Carrer Principal, 123" required>
                                <div class="invalid-feedback">
                                    Si us plau, introdueixi la vostra adreça d'enviament.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label">Adreça 2 <span class="text-body-secondary">(Opcional)</span></label>
                                <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartament o pis">
                            </div>

                            <div class="col-md-6">
                                <label for="country" class="form-label">País</label>
                                <select class="form-select" id="country" name="country" required>
                                    <option value="">Tria...</option>
                                    <option>Espanya</option>
                                    <option>França</option>
                                    <option>Alemania</option>
                                    <option>Estats Units</option>
                                    <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        if (isset($_POST['country']) && !empty($_POST['country'])) {
                                            setcookie('selected_country', $_POST['country'], time() + (86400 * 30), "/"); // Cookie expira en 30 días
                                        }
                                    }
                                    ?>

                                </select>
                                <div class="invalid-feedback">
                                    Si us plau, seleccioneu un país vàlid.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="zip" class="form-label">Codi postal</label>
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
                                <div class="invalid-feedback">
                                    Cal un codi postal.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Pagament</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                                <label class="form-check-label" for="credit">Targeta de crèdit</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="debit">Targeta de dèbit</label>
                            </div>
                            <div class="form-check">
                                <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="paypal">PayPal</label>
                            </div>
                            <input type="hidden" id="paymentMethod" name="pago" value="" />
                        </div>
                        <script>
                            const paymentMethodButtons = document.querySelectorAll('input[name="paymentMethod"]');
                            const form = document.querySelector('form');

                            paymentMethodButtons.forEach(button => {
                                button.addEventListener('change', function() {
                                    if (this.checked) {
                                        form.querySelector('button[type="submit"]').value = this.id;
                                    }
                                });
                            });
                        </script>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Nom a la targeta</label>
                                <input type="text" class="form-control" id="cc-name" name="cc-name" placeholder="" required>
                                <small class="text-body-secondary">Nom complet com es mostra a la targeta</small>
                                <div class="invalid-feedback">
                                    El nom a la targeta és obligatori
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Número de targeta de crèdit</label>
                                <input type="text" class="form-control" id="cc-number" name="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    El número de targeta de crèdit és obligatori
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Caducitat</label>
                                <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Data de caducitat obligatòria
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Codi de seguretat obligatori
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Continuar a la comanda</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="my-5 pt-5 text-body-secondary text-center text-small">
            <p class="mb-1">&copy; 2024 Beatify. Tots els drets reservats.</p>
        </footer>
    </div>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/pagament.js"></script>
    <script>
        $(document).ready(function() {
            // Función para calcular el IVA
            function calcularIVA(pais) {
                // Definir tasas de IVA para cada país
                var tasasIVA = {
                    "Espanya": 21,
                    "França": 20,
                    "Alemania": 19,
                    "Estats Units": 0 // Asumiendo que en Estados Unidos no hay IVA
                };

                // Obtener la tasa de IVA del país seleccionado
                var tasaIVA = tasasIVA[pais];

                // Devolver la tasa de IVA
                return tasaIVA;
            }

            // Evento cuando cambia la selección del país
            $('#pais').on('change', function() {
                var paisSeleccionado = $(this).val(); // Obtener el país seleccionado del formulario
                var tasaIVA = calcularIVA(paisSeleccionado); // Calcular la tasa de IVA según el país seleccionado
                console.log('La tasa de IVA para ' + paisSeleccionado + ' es ' + tasaIVA + '%');
            });
        });
    </script>
    <script>
        // Tu script que utiliza la variable global window.tipoFactura
        document.addEventListener("DOMContentLoaded", function() {


            function obtenerCookie(nombre) {
                var nombreCookie = nombre + "=";
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i].trim();
                    if (cookie.indexOf(nombreCookie) === 0) {
                        return cookie.substring(nombreCookie.length, cookie.length);
                    }
                }
                return "";
            }

            // Ejemplo de uso:
            var tipus = obtenerCookie("tipus_factura");
            var preu = obtenerCookie("preu_factura");
            console.log("Valor de la cookie 'tipus_factura': " + tipus);
            console.log("Valor de la cookie 'preu_factura': " + preu);


            if (tipus && preu) {
                document.getElementById('tipusFactura').textContent = tipus;
                document.getElementById('preuFactura').textContent = preu;
            } else {
                document.getElementById('tipusFactura').textContent = "No se ha proporcionado ningún tipo de factura.";
                document.getElementById('preuFactura').textContent = "No se ha proporcionado ningún precio.";
            }
        });
    </script>

</body>

</html>