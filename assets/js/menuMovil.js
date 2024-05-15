document.addEventListener("DOMContentLoaded", function() {
    // Obtener la imagen del menú móvil por su ID
    var imagenMenuMovil = document.getElementById("imagenMenuMovil");

    // Obtener el contenedor por su clase
    var contenedorLeft = document.querySelector(".contenedor-left");

    // Función para manejar clics en el documento
    function handleClickOutside(event) {
        // Verificar si el clic no ocurrió dentro del contenedor
        if (!contenedorLeft.contains(event.target) && event.target !== imagenMenuMovil) {
            // Ocultar el contenedor si está visible
            if (contenedorLeft.classList.contains("mostrar")) {
                contenedorLeft.classList.remove("mostrar");
            }
        }
    }

    // Agregar evento clic a la imagen
    imagenMenuMovil.addEventListener("click", function() {
        // Alternar la clase 'mostrar' en el contenedor
        contenedorLeft.classList.toggle("mostrar");
    });

    // Agregar evento clic al documento
    document.addEventListener("click", handleClickOutside);
});
