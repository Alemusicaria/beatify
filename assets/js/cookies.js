$('#iniciarSessio').on('click', function () {
    window.location.href = './login.html';
});

function cerrarSesion() {
    eliminarCookie('NomUsuari');
    eliminarCookie('personalizacion');
    window.location.href = '../assets/php/unlogin.php';
}

function eliminarCookie(nombre) {
    document.cookie = `${nombre}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

function cargarPersonalizacion() {
    const cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('personalizacion='));

    return cookieValue ? JSON.parse(cookieValue.split('=')[1]) : null;
}

function aplicarPersonalizacion() {
    const opciones = cargarPersonalizacion();

    if (opciones) {
        const botones = document.querySelectorAll('button');
        botones.forEach(boton => aplicarEstilo(boton, opciones));

        const searchBtn = document.getElementById('search');
        if (searchBtn) {
            console.log('Aplicando personalización al elemento con id "search". Opciones:', opciones);
            aplicarEstilo(searchBtn, opciones);
        } else {
            console.log('Elemento con id "search" no encontrado.');
        }
    }
}

function aplicarEstilo(elemento, opciones) {
    elemento.style.borderRadius = opciones.forma === 'rounded' ? '10px' : '0';
    elemento.style.backgroundColor = opciones.color;
    elemento.style.fontSize = obtenerTamañoFuente(opciones.fontSize);
}

function obtenerTamañoFuente(tamaño) {
    switch (tamaño) {
        case 'small':
            return '12px';
        case 'medium':
            return '16px';
        case 'large':
            return '20px';
        default:
            return '16px'; // Tamaño medio por defecto
    }
}

window.addEventListener('load', aplicarPersonalizacion);
