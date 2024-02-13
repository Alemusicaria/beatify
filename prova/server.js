const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
const port = 80;

// Configuració de la connexió a la base de dades MySQL de XAMPP
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root', // El nom d'usuari per defecte pot ser diferent
  password: '', // Deixa-ho en blanc si no has establert una contrasenya
  database: 'beatify'
});

db.connect((err) => {
  if (err) {
    console.error('Error de connexió a la base de dades:', err);
  } else {
    console.log('Connexió a la base de dades establerta');
  }
});

// Configuració de l'aplicació per a utilitzar body-parser
app.use(bodyParser.urlencoded({ extended: true }));

// Rutes
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

app.post('/login', (req, res) => {
  const username = req.body.username;
  const password = req.body.password;

  // Verificar les credencials
  db.query(
    'SELECT * FROM usuari WHERE nom_usuari = ? AND contrasenya = ?',
    [username, password],
    (err, result) => {
      if (err) {
        console.error('Error en la consulta de la base de dades:', err);
        res.sendStatus(500);
      } else {
        if (result.length > 0) {
          res.send('Inici de sessió correcte');
        } else {
          res.send('Credencials incorrectes');
        }
      }
    }
  );
});

// Iniciar el servidor
app.listen(port, () => {
  console.log(`Servidor escoltant al port ${port}`);
});
