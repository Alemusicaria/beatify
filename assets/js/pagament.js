// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
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

// Evento cuando cambia la selección del país
$('#country').on('change', function () {
  var paisSeleccionado = $(this).val(); // Obtener el país seleccionado del formulario
  document.cookie = "selected_country=" + paisSeleccionado + "; expires=Thu, 01 Jan 2099 00:00:00 UTC; path=/;"; // Establecer cookie para almacenar el país seleccionado
  var tasaIVA = calcularIVA(paisSeleccionado); // Calcular la tasa de IVA según el país seleccionado
  console.log('La tasa de IVA para ' + paisSeleccionado + ' es ' + tasaIVA + '%');
});

// Función para calcular el IVA
function calcularIVA(pais) {
  // Definir tasas de IVA para cada país
  var tasasIVA = {
    "Espanya": 21,
    "França": 20,
    "Alemania": 19,
    "Estats Units": 0 // Asumiendo que en Estados Unidos no hay IVA
  };

  // Obtener la tasa de IVA del país seleccionado de la cookie
  var tasaIVA = tasasIVA[pais];

  // Devolver la tasa de IVA
  return tasaIVA;
}

// Función para obtener el valor de una cookie
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

// Obtener el país seleccionado almacenado en la cookie
var paisSeleccionado = obtenerCookie("selected_country");

// Si hay un país seleccionado, calcular su tasa de IVA correspondiente
if (paisSeleccionado) {
  var tasaIVA = calcularIVA(paisSeleccionado);
  console.log('La tasa de IVA para ' + paisSeleccionado + ' es ' + tasaIVA + '%');
}

