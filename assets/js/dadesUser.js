function obtenerUsuario() {
    var nombreUsuario = obtenerCookie('NomUsuari');
    var contraseña = obtenerCookie('Contrasenya');
    console.log(contraseña);
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

    $('.fotoPerfil').attr('src', foto);
    $('.NomUsuari').text('Nom: ' + nombre + ' ' + apellido);
    $('.email').text('Correu: ' + email);
    $('.premium').text('Premium: ' + (premium === 1 ? 'Si' : 'No'));

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
