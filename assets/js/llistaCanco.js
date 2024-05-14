// Afegir un esdeveniment de clic al botó 'crearListaBtn'
document.getElementById('crearListaBtn').addEventListener('click', function () {
    // Obté el valor del camp d'entrada per al nom de la llista
    var nombreLista = document.getElementById('nomLlista').value;

    // Comprova si el nom de la llista no està buit
    if (nombreLista.trim() !== '') {
        // Dades del formulari a enviar
        var formData = new FormData();
        formData.append('nomLlista', nombreLista);

        // Envia una sol·licitud AJAX utilitzant XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../assets/php/guardarLlista.php', true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Éxit de la sol·licitud AJAX
                console.log(xhr.responseText);
                // Aquí es poden realitzar accions addicionals després de la inserció, si és necessari
            } else {
                // Error del servidor
                console.error('Error en la sol·licitud AJAX: ' + xhr.status);
            }
        };
        xhr.onerror = function () {
            // Error de connexió
            console.error('Error de connexió');
        };
        xhr.send(formData);

        // Oculta el formulari després d'enviar les dades
        document.getElementById('formulario').style.display = 'none';

        // Actualitza i mostra el títol amb el nom de la llista
        var titulo = document.getElementById('nombreListaTitulo');
        titulo.textContent = nombreLista;
        titulo.style.display = 'block';
    } else {
        // Mostre una alerta si el camp del nom de la llista està buit
        alert('Si us plau, introduïu un nom per a la llista.');
    }
});
