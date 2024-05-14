function obtenerUsuario() {
    // Obté el nom d'usuari i la contrasenya des de les cookies
    var nombreUsuario = obtenerCookie('NomUsuari');
    var contraseña = obtenerCookie('Contrasenya');
    if (nombreUsuario && contraseña) {
        // Autentica l'usuari si es troben les cookies
        autenticarUsuario(nombreUsuario, contraseña);
    } else {
        console.log('No s\'han trobat les cookies de l\'usuari.');
    }
}

function autenticarUsuario(nombreUsuario, contraseña) {
    // Realitza una crida AJAX per autenticar l'usuari amb el backend
    $.ajax({
        url: '../assets/php/auth.php',
        method: 'POST',
        data: { username: nombreUsuario, password: contraseña },
        success: function (data) {
            // Mostra la informació de l'usuari si l'autenticació és correcta
            if (data.status === 'OK') {
                mostrarInformacionUsuario(data);
            } else {
                console.log('Error en l\'autenticació:', data);
            }
        },
        error: function (error) {
            console.log('Error en la càrrega de l\'usuari:', error);
        }
    });
}

function mostrarInformacionUsuario(usuario) {
    // Obté les dades de l'usuari i les mostra a la interfície
    var nombre = usuario.Nom;
    var apellido = usuario.Cognom;
    var foto = usuario.Foto;
    var premium = usuario.Premium;
    var email = usuario.Email;
    var NomUsuari = usuario.NomUsuari;
    var Admin = usuario.Admin;
    const adminPage = document.getElementById('adminID');

    // Actualitza els elements de la interfície amb la informació de l'usuari
    $('.fotoPerfil').attr('src', foto);
    $('.NomUsuari').text('Nom: ' + nombre + ' ' + apellido);
    $('.email').text('Correu: ' + email);
    $('.premium').text('Premium: ' + (premium === "1" ? 'Si' : 'No'));

    // Afegeix opcions addicionals si l'usuari és administrador
    if (Admin == 1 && adminPage !== null) {
        // Crea i mostra el panell d'administració
        // (en aquest cas, és un exemple d'ajust de la reproducció aleatòria per als usuaris no Premium)
        const adminContainer = document.createElement('div');
        adminContainer.classList.add('profile-container');

        const adminTitle = document.createElement('h1');
        adminTitle.textContent = 'Admin';
        adminContainer.appendChild(adminTitle);

        const adminOptions = document.createElement('div');
        adminOptions.id = 'admin-options';

        const adminAccessLabel = document.createElement('label');
        adminAccessLabel.setAttribute('for', 'admin-access');
        adminAccessLabel.textContent = 'Reproducció Aleatòria (NO Premium):';
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
        saveButton.addEventListener('click', function () {
            // Guarda el valor a localStorage quan es fa clic al botó de guardar
            localStorage.setItem('reproduccionAutomatica', reproduccionAutomatica);
        });
        adminContainer.appendChild(saveButton);

        adminPage.appendChild(adminContainer);

        // Variable per emmagatzemar l'estat de la reproducció automàtica
        let reproduccionAutomatica = false; // Establert inicialment a false

        // Escolta els canvis en el select per establir la reproducció automàtica
        adminAccessSelect.addEventListener('change', function () {
            if (adminAccessSelect.value === 'yes') {
                reproduccionAutomatica = true;
            } else {
                reproduccionAutomatica = false;
            }
        });

        // Comprova si hi ha un valor emmagatzemat a localStorage i ajusta reproduccionAutomatica en conseqüència
        const storedValue = localStorage.getItem('reproduccionAutomatica');
        if (storedValue !== null) {
            reproduccionAutomatica = JSON.parse(storedValue);
            // Actualitza el select segons correspongui
            adminAccessSelect.value = reproduccionAutomatica ? 'yes' : 'no';
        }
    }

    // Captura l'esdeveniment de clic al botó per guardar els canvis a la foto del perfil
    $('#guardarCambios').on('click', function () {
        var nuevaFoto = $('#opcionesImagen').val();
        $('.fotoPerfil').attr('src', nuevaFoto);
        console.log(nuevaFoto);
        console.log(NomUsuari);
        // Realitza una crida POST per actualitzar la foto del perfil al backend
        $.post('../assets/php/newImage.php', { nuevaFoto: nuevaFoto, username: NomUsuari }, function (respuesta) {
            console.log(respuesta);
        });
    });
}

function obtenerCookie(nombre) {
    // Funció per obtenir el valor d'una cookie pel seu nom
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
    // Crida la funció per obtenir la informació de l'usuari quan la pàgina estigui carregada
    obtenerUsuario();
});
