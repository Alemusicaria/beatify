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
    $('.premium').text('Premium: ' + (premium === "1" ? 'Si' : 'No'));
    if (Admin == 1 && adminPage !== null) {
        // Crear el contenedor principal
        const adminContainer = document.createElement('div');
        adminContainer.classList.add('profile-container');
    
        const adminTitle = document.createElement('h1');
        adminTitle.textContent = 'Admin';
        adminContainer.appendChild(adminTitle);
    
        const adminOptions = document.createElement('div');
        adminOptions.id = 'admin-options';
    
        const adminAccessLabel = document.createElement('label');
        adminAccessLabel.setAttribute('for', 'admin-access');
        adminAccessLabel.textContent = 'Reproduccio Aleatoria (NO Premium):';
        adminOptions.appendChild(adminAccessLabel);
    
        const adminAccessSelect = document.createElement('select');
        adminAccessSelect.id = 'admin-access';
    
        const yesOption = document.createElement('option');
        yesOption.value = 'yes';
        yesOption.textContent = 'Sí';
        adminAccessSelect.appendChild(yesOption);
    
        const noOption = document.createElement('option');
        noOption.value = 'no';
        noOption.textContent = 'No';
        adminAccessSelect.appendChild(noOption);
    
        adminOptions.appendChild(adminAccessSelect);
        adminContainer.appendChild(adminOptions);
    
        const saveButton = document.createElement('button');
        saveButton.textContent = 'Guardar';
        saveButton.addEventListener('click', function() {
            // Guardar el valor en localStorage
            localStorage.setItem('reproduccionAutomatica', reproduccionAutomatica);
        });
        adminContainer.appendChild(saveButton);
    
        adminPage.appendChild(adminContainer);
    
        // Variable para almacenar el valor seleccionado
        let reproduccionAutomatica = false; // Inicialmente establecido en false
    
        // Listener de eventos para cambios en el select
        adminAccessSelect.addEventListener('change', function() {
            if (adminAccessSelect.value === 'yes') {
                reproduccionAutomatica = true;
            } else {
                reproduccionAutomatica = false;
            }
        });
    
        // Verificar si hay un valor previamente guardado en localStorage y establecer reproduccionAutomatica en consecuencia
        const storedValue = localStorage.getItem('reproduccionAutomatica');
        if (storedValue !== null) {
            reproduccionAutomatica = JSON.parse(storedValue);
            // Actualizar el select en consecuencia
            adminAccessSelect.value = reproduccionAutomatica ? 'yes' : 'no';
        }
    }
    
    

    
    $('#guardarCambios').on('click', function () {
        var nuevaFoto = $('#opcionesImagen').val();
        $('.fotoPerfil').attr('src', nuevaFoto);
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
