<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Historial de Facturas</title>
    <link rel="stylesheet" href="../assets/assets_factura/css/main.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
            border-bottom: 1px solid #ddd;
        }

        table td {
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Historial de Facturas</h1>

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
        $sql = "SELECT * FROM Pagament WHERE NomUsuari = '" . $_COOKIE['NomUsuari'] . "' ORDER BY ID DESC"; // Obté totes les factures filtrades per NomUsuari, ordenades per ID de forma descendent

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Si hi ha resultats, mostra la taula amb el historial de factures
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Factura #</th>";
            echo "<th>Data</th>";
            echo "<th>Total</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Mostra cada fila amb dades de factura
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ID"] . "</td>";
                echo "<td>" . $row["Data"] . "</td>";
                    echo "<td>" . $row["Total"] . "€</td>"; // Suposo que a la base de dades hi ha un camp anomenat 'Total' que conté el preu total de la factura
                    echo "</tr>";
                }
            

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "No hi ha cap factura disponible.";
        }

        // Tanca la connexió amb la base de dades
        $conn->close();
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="assets/bower_components/jquery/dist/jquery.min.js"><\/script>')
    </script>
    <script src="../assets/assets_factura/js/main.js"></script>
</body>

</html>