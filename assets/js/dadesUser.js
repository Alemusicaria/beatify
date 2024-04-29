function obtenerUsuario() {
    var nombreUsuario = obtenerCookie('NomUsuari');
    var contraseña = obtenerCookie('Contrasenya');
    if (nombreUsuario && contraseña) {
        autenticarUsuario(nombreUsuario, contraseña);
    } else {
        console.log('No se encontraron las cookies de usuario.');
    }
}

function autenticarUsuario(nombreUsuario, contraseña) {
    $.ajax({
        url: '../assets/php/auth.php',
        method: 'POST',
        data: { username: nombreUsuario, password: contraseña },
        success: function (data) {
            if (data.status === 'OK') {
                mostrarInformacionUsuario(data);
            } else {
                console.log('Error en la autenticación:', data);
            }
        },
        error: function (error) {
            console.log('Error en la carga del usuario:', error);
        }
    });
}

function mostrarInformacionUsuario(usuario) {
    var nombre = usuario.Nom;
    var apellido = usuario.Cognom;
    var foto = usuario.Foto;
    var premium = usuario.Premium;
    var email = usuario.Email;
    var NomUsuari = usuario.NomUsuari;
    var Admin = usuario.Admin;
    const adminPage = document.getElementById('adminID');

    $('.fotoPerfil').attr('src', foto);
    $('.NomUsuari').text('Nom: ' + nombre + ' ' + apellido);
    $('.email').text('Correu: ' + email);
    $('.premium').text('Premium: ' + (premium === 1 ? 'Si' : 'No'));
    if (Admin == 1 && adminPage !== null) {
        // Crear el contenedor principal

        const profileContainer = document.createElement('div');
        profileContainer.classList.add('profile-container');

        // Crear el título
        const title = document.createElement('h1');
        title.textContent = 'Admin';

        // Crear el botón de personalización
        const customizeButton = document.createElement('button');
        customizeButton.textContent = 'Personalitzar';
        customizeButton.id = 'btn-customize';

        // Crear el contenedor de opciones de personalización
        const customizeOptions = document.createElement('div');
        customizeOptions.id = 'customize-options';
        customizeOptions.classList.add('hidden');

        // Crear la etiqueta y el select para la forma de los botones
        const shapeLabel = document.createElement('label');
        shapeLabel.textContent = 'Forma dels botons:';
        const shapeSelect = document.createElement('select');
        shapeSelect.id = 'button-shape';
        const roundedOption = document.createElement('option');
        roundedOption.value = 'rounded';
        roundedOption.textContent = 'Arrodonit';
        const squareOption = document.createElement('option');
        squareOption.value = 'square';
        squareOption.textContent = 'Quadrat';
        shapeSelect.appendChild(roundedOption);
        shapeSelect.appendChild(squareOption);

        // Crear la etiqueta y el input para el color
        const colorLabel = document.createElement('label');
        colorLabel.textContent = 'Color:';
        const colorInput = document.createElement('input');
        colorInput.type = 'color';
        colorInput.id = 'color-picker';

        // Crear la etiqueta y el select para el tamaño de la letra
        const fontSizeLabel = document.createElement('label');
        fontSizeLabel.textContent = 'Mida de la lletra:';
        const fontSizeSelect = document.createElement('select');
        fontSizeSelect.id = 'font-size';
        const smallOption = document.createElement('option');
        smallOption.value = 'small';
        smallOption.textContent = 'Petit';
        const mediumOption = document.createElement('option');
        mediumOption.value = 'medium';
        mediumOption.textContent = 'Mitjà';
        const largeOption = document.createElement('option');
        largeOption.value = 'large';
        largeOption.textContent = 'Gran';
        fontSizeSelect.appendChild(smallOption);
        fontSizeSelect.appendChild(mediumOption);
        fontSizeSelect.appendChild(largeOption);

        // Crear el botón de guardar
        const saveButton = document.createElement('button');
        saveButton.textContent = 'Desar';
        saveButton.id = 'btn-save';

        // Crear el enlace a la API
        const apiLink = document.createElement('a');
        apiLink.href = 'https://documenter.getpostman.com/view/32731356/2sA3BkbXtn';
        apiLink.textContent = 'API';
        apiLink.style.color = 'white';

        // Agregar todos los elementos al contenedor de opciones de personalización
        customizeOptions.appendChild(shapeLabel);
        customizeOptions.appendChild(shapeSelect);
        customizeOptions.appendChild(colorLabel);
        customizeOptions.appendChild(colorInput);
        customizeOptions.appendChild(fontSizeLabel);
        customizeOptions.appendChild(fontSizeSelect);
        customizeOptions.appendChild(saveButton);

        // Agregar todos los elementos al contenedor principal
        profileContainer.appendChild(title);
        profileContainer.appendChild(customizeButton);
        profileContainer.appendChild(customizeOptions);
        profileContainer.appendChild(document.createElement('br'));
        profileContainer.appendChild(document.createElement('br'));
        profileContainer.appendChild(apiLink);

        // Agregar el contenedor principal al body del documento
        adminPage.appendChild(profileContainer);

        /*
            // Agregar el script para la interactividad
            const script = document.createElement('script');
            script.textContent = `
                document.addEventListener("DOMContentLoaded", function() {
                    const customizeButton = document.getElementById("btn-customize");
                    const customizeOptions = document.getElementById("customize-options");
                    const saveButton = document.getElementById("btn-save");
    
                    customizeButton.addEventListener("click", function() {
                        customizeOptions.classList.toggle("hidden");
                    });
    
                    saveButton.addEventListener("click", function() {
                        // Aquí puedes agregar lógica para guardar las opciones seleccionadas
                        // Por ejemplo, obtener los valores de los elementos select y el color
                        // y aplicar esos cambios a los botones en tu página.
                        alert("Opcions personalitzades desades!");
                    });
                });
            `;
            document.body.appendChild(script);
        */
    }
    $('#guardarCambios').on('click', function () {
        var nuevaFoto = $('#opcionesImagen').val();
        $('#fotoPerfil').attr('src', nuevaFoto);
        console.log(nuevaFoto);
        console.log(NomUsuari);
        $.post('../assets/php/newImage.php', { nuevaFoto: nuevaFoto, username: NomUsuari }, function (respuesta) {
            console.log(respuesta);
        });
    });
}

function obtenerCookie(nombre) {
    var nombreEQ = nombre + '=';
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(nombreEQ) === 0) {
            return cookie.substring(nombreEQ.length, cookie.length);
        }
    }
    return null;
}

$(document).ready(function () {
    obtenerUsuario();
});
