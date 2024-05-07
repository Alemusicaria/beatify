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

function calculate() {

  var total_price = 0,
    total_tax = 0;

  $('.invoicelist-body tbody tr').each(function () {
    var row = $(this),
      rate = parseFloat(row.find('.rate input').val()), // Obtener el precio del producto
      taxRate = 21, // Tasa de impuesto fija en 21%
      amount = 1; // Suponemos que la cantidad es 1 en este caso

    var sum = rate * amount;
    var tax = (sum * taxRate) / 100;

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
