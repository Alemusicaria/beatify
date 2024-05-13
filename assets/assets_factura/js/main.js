var TAX_RATE = parseFloat($('#config_tax_rate').val());
var TAX_SETTING = false;
$('body').addClass('hidetax hidenote hidedate');


function init_date() {
  var now = new Date();
  var month = (now.getMonth() + 1);
  var day = now.getDate();
  if (month < 10) {
    month = "0" + month;
  }
  if (day < 10) {
    day = "0" + day;
  }
  var today = day + '-' + month + '-' + now.getFullYear().toString().substr(2, 2);

  var intwoweeks = new Date(now.getTime() + 14 * 24 * 60 * 60 * 1000);
  var month = (intwoweeks.getMonth() + 1);
  var day = intwoweeks.getDate();
  if (month < 10) {
    month = "0" + month;
  }
  if (day < 10) {
    day = "0" + day;
  }

  var twoweeks = day + '-' + month + '-' + intwoweeks.getFullYear().toString().substr(2, 2);



  $('.datePicker').val(today);
  $('.twoweeks').val(twoweeks);
}

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
function calculate() {

  var total_price = 0,
    total_tax = 0;

  $('.invoicelist-body tbody tr').each(function () {
    var row = $(this),
      rate = parseFloat(row.find('.rate input').val()), // Obtener el precio del producto
      amount = 1; // Suponemos que la cantidad es 1 en este caso
    var tasaIVA = calcularIVA(paisSeleccionado); // Calcular la tasa de IVA según el país seleccionado

    var sum = rate * amount;
    var tax = (sum * tasaIVA) / 100;

    total_price += sum; // Sumar al total el precio del producto
    total_tax += tax; // Sumar al total el impuesto del producto

    row.find('.sum').text(sum.toFixed(2) + '€');
    row.find('.tax').text(tax.toFixed(2) + '€');
  });

  var total = total_price + total_tax; // Calcular el total sumando el precio y el impuesto

  // Mostrar el total en la interfaz
  $('#total_price').text(total.toFixed(2) + '€');
  $('#total_tax').text(total_tax.toFixed(2) + '€');
}
init_date();
calculate();
