$('#iniciarSessio').on('click', function () {
    window.location.href = './login.html';
});

function cerrarSesion() {
    // Eliminar la cookie
    document.cookie = "NomUsuari=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "personalizacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    // Redirigir a la página de inicio de sesión o a otra página relevante
    window.location.href = '../assets/php/unlogin.php';
}

// Función para cargar la personalización desde la cookie
function cargarPersonalizacion() {
    const cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('personalizacion='));

    if (cookieValue) {
        return JSON.parse(cookieValue.split('=')[1]);
    }

    return null;
}

// Función para aplicar la personalización a los elementos necesarios
function aplicarPersonalizacion() {
    const opciones = cargarPersonalizacion();

    if (opciones) {
        // Aplicar la personalización a los elementos que desees
        // En este ejemplo, solo se aplica a los botones
        const botones = document.querySelectorAll('button');

        botones.forEach(boton => {
            boton.style.borderRadius = opciones.forma === 'rounded' ? '10px' : '0';
            boton.style.backgroundColor = opciones.color;
            boton.style.fontSize = opciones.fontSize === 'small' ? '12px' :
                opciones.fontSize === 'medium' ? '16px' : '20px';
        });
    }
}

// Llamar a la función para cargar y aplicar la personalización al cargar la página
window.addEventListener('load', aplicarPersonalizacion);
