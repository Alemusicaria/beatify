// Funció autoinvocada per desactivar l'enviament de formularis si hi ha camps invàlids
(() => {
  'use strict'

  // Captura tots els formularis als quals volem aplicar estils de validació personalitzats de Bootstrap
  const forms = document.querySelectorAll('.needs-validation')

  // Itera sobre ells i evita l'enviament
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()

// Event quan canvia la selecció del país
$('#country').on('change', function () {
  var paisSeleccionado = $(this).val(); // Obté el país seleccionat del formulari
  document.cookie = "selected_country=" + paisSeleccionado + "; expires=Thu, 01 Jan 2099 00:00:00 UTC; path=/;"; // Estableix una cookie per emmagatzemar el país seleccionat
  var tasaIVA = calcularIVA(paisSeleccionado); // Calcula la taxa d'IVA segons el país seleccionat
  console.log('La taxa d\'IVA per a ' + paisSeleccionado + ' és ' + tasaIVA + '%');
});

// Funció per calcular l'IVA
function calcularIVA(pais) {
  // Defineix taxes d'IVA per a cada país
  var tasasIVA = {
    "Espanya": 21,
    "França": 20,
    "Alemanya": 19,
    "Estats Units": 0 // Suposant que als Estats Units no hi ha IVA
  };

  // Obté la taxa d'IVA del país seleccionat de la cookie
  var tasaIVA = tasasIVA[pais];

  // Retorna la taxa d'IVA
  return tasaIVA;
}

// Funció per obtenir el valor d'una cookie
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

// Obté el país seleccionat emmagatzemat a la cookie
var paisSeleccionado = obtenerCookie("selected_country");

// Si hi ha un país seleccionat, calcula la seva taxa d'IVA corresponent
if (paisSeleccionado) {
  var tasaIVA = calcularIVA(paisSeleccionado);
  console.log('La taxa d\'IVA per a ' + paisSeleccionado + ' és ' + tasaIVA + '%');
}
