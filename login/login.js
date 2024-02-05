function validateAndSubmit() {
    // Obtenir les dades del formulari
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
  
    // Comprovar si els camps estan buits
    if (username.trim() === '' || password.trim() === '') {
      alert('Completa tots els camps.');
      return;
    }
  
    // Comprovar el format del nom d'usuari (potser voldràs afegir més comprovacions)
    if (!isValidUsername(username)) {
      alert('Nom d\'usuari no vàlid.');
      return;
    }
  
    // Comprovar el format de la contrasenya (potser voldràs afegir més comprovacions)
    if (!isValidPassword(password)) {
      alert('Contrasenya no vàlida.');
      return;
    }
  
    // Si tot està bé, envia les dades al servidor per a l'autenticació
    // Aquí pots fer servir AJAX per enviar les dades al servidor
    // Exemple fictici amb l'ús de la consola per mostrar el resultat
    console.log('Dades enviades al servidor:', { username, password });
  }
  
  function isValidUsername(username) {
    // Aquí pots afegir lògica per validar el format del nom d'usuari
    // Retornaràs true si és vàlid, false si no ho és
    return true;
  }
  
  function isValidPassword(password) {
    // Aquí pots afegir lògica per validar el format de la contrasenya
    // Retornaràs true si és vàlida, false si no ho és
    return true;
  }
  