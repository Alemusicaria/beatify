document.getElementById('crearListaBtn').addEventListener('click', function () {
    var nombreLista = document.getElementById('nomLlista').value;

    // Comprobar si el nombre de la lista no está vacío
    if (nombreLista.trim() !== '') {
        // Datos del formulario
        var formData = new FormData();
        formData.append('nomLlista', nombreLista);

        // Enviar solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../assets/php/guardarLlista.php', true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                // Éxito
                console.log(xhr.responseText);
                // Aquí puedes realizar acciones adicionales después de la inserción, si es necesario
            } else {
                // Error de servidor
                console.error('Error en la solicitud AJAX: ' + xhr.status);
            }
        };
        xhr.onerror = function () {
            // Error de conexión
            console.error('Error de conexión');
        };
        xhr.send(formData);

        // Ocultar el formulario después de enviar los datos
        document.getElementById('formulario').style.display = 'none';

        // Actualizar y mostrar el título con el nombre de la lista
        var titulo = document.getElementById('nombreListaTitulo');
        titulo.textContent = nombreLista;
        titulo.style.display = 'block';
    } else {
        alert('Si us plau, introduïu un nom per a la llista.');
    }
});