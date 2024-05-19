$('#iniciarSessio').on('click', function () {
    // Redirigeix l'usuari a la pàgina de login en fer clic al botó d'iniciar sessió
    window.location.href = './login.html';
});

function cerrarSesion() {
    // Elimina les cookies de sessió quan l'usuari tanca la sessió
    document.cookie = "NomUsuari=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "personalizacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    // Redirigeix l'usuari a la pàgina de login o a una altra pàgina rellevant
    window.location.href = '../assets/php/unlogin.php';
}

// Funció per carregar la personalització des de la cookie
function cargarPersonalizacion() {
    const cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('personalitzacio='));

    if (cookieValue) {
        return JSON.parse(cookieValue.split('=')[1]);
    }

    return null;
}

// Funció per aplicar la personalització als elements necessaris
function aplicarPersonalizacion() {
    const opciones = cargarPersonalizacion();
    console.log(opciones)
    if (opciones) {
        console.log("hola")
        // Aplica la personalització als elements que desitgis
        // En aquest exemple, s'aplica només als botons i a la barra d'àudio
        const barra = document.querySelectorAll('#audioColor');
        const botones = document.querySelectorAll('button');
        barra.forEach(estilo => {
            estilo.style.backgroundColor = opciones.colorBarraAudio;
        });
        botones.forEach(boton => {
            boton.style.borderRadius = opciones.forma === 'rounded' ? '10px' : '0';
            boton.style.backgroundColor = opciones.color;
            boton.style.fontSize = opciones.fontSize === 'small' ? '12px' :
                opciones.fontSize === 'medium' ? '16px' : '20px';
        });
        const searchBtn = document.getElementById('search');
        if (searchBtn) {
            searchBtn.style.backgroundColor = opciones.color;
        } else {
            console.log('Elemento con id "search" no encontrado.');
        }
    }
}

// Crida la funció per carregar i aplicar la personalització quan es carrega la pàgina
window.addEventListener('load', aplicarPersonalizacion);
