function validateAndSubmit() {
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;

  if (username.trim() === '' || password.trim() === '') {
    alert('Completa tots els camps.');
    return;
  }

  if (!isValidUsername(username)) {
    alert('Nom d\'usuari no vàlid.');
    return;
  }

  if (!isValidPassword(password)) {
    alert('Contrasenya no vàlida.');
    return;
  }

  var url = 'beatify/usuari'; // Canvia a la teva URL del servidor
  var data = { username: username, password: password };

  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
    .then(response => response.json())
    .then(response => handleServerResponse(response))
    .catch(error => console.error('Error de la crida Fetch:', error));
}

function isValidUsername(username) {
  return username.length >= 3;
}

function isValidPassword(password) {
  return password.length >= 6;
}

function handleServerResponse(response) {
  if (response.success) {
    alert(response.message);
    // Redirigeix l'usuari o realitza altres accions desitjades després de l'inici de sessió
  } else {
    alert('Error d\'inici de sessió: ' + response.message);
  }
}
