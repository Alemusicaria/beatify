function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function carregarUsuari() {
    var username = getCookie('NomUsuari');
    var password = getCookie('Contrasenya');
    $.ajax({
        url: '../assets/php/auth.php',
        method: 'POST',
        data: {
            username: username, // Reemplaza con el nombre de usuario del formulario
            password: password // Reemplaza con la contraseña del formulario
        },
        success: function (data) {
            console.log(data);
            var usuariCarregat = data;

            if (usuariCarregat.status === 'OK') {
                // Usuario autenticado con éxito
                // Puedes acceder a los datos del usuario a través de las propiedades del objeto usuariCarregat
                var nom = usuariCarregat.Nom;
                var cognom = usuariCarregat.Cognom;
                var foto = usuariCarregat.Foto;
                var premium = usuariCarregat.Premium;
                var email = usuariCarregat.Email;
                // Realiza las acciones necesarias con los datos del usuario
                // Por ejemplo, mostrar la información en la interfaz de usuario
                mostrarInformacioUsuari(nom, cognom, foto, premium, email);
            } else {
                // Autenticación fallida
                console.log('Error en la autenticación:', data);
            }
        },
        error: function (error) {
            console.log('Error en cargar el usuario:', error);
        }
    });
}

function mostrarInformacioUsuari(nom, cognom, foto, premium, email) {
    var username = getCookie('NomUsuari');
    // Actualiza el contenido de los elementos HTML con la información del usuario
    $('.fotoPerfil').attr('src', foto); 
    $('.NomUsuari').text('Nom: ' + nom + ' ' + cognom); 
    $('.email').text('Correu: ' + email); 
    if(premium==1){
        $('.premium').text('Premium: Si');
    }else{
        $('.premium').text('Premium: No');
    }
    

    $('#guardarCambios').on('click', function () {
        var nuevaFoto = $('#opcionesImagen').val();
        $('#fotoPerfil').attr('src', nuevaFoto);

        // Envía la solicitud al servidor para actualizar la base de datos
        $.post('../assets/php/newImage.php', { nuevaFoto: nuevaFoto, username: username }, function (respuesta) {
            // Puedes manejar la respuesta del servidor aquí
            console.log(respuesta);
        });
    });
}

// Llama a la función para cargar el usuario al cargar la página
$(document).ready(function () {
    carregarUsuari();
});

