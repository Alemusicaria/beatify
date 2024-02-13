document.addEventListener("DOMContentLoaded", function() {
    // Utiliza fetch para obtener la información desde el servidor
    fetch('http://localhost:3000/obtener-informacion') // Ajusta la URL según tu configuración
      .then(response => response.json())
      .then(data => {
        // Manipula los datos y agrégales al HTML
        const contenedorCanciones = document.getElementById('taula');
  
        data.forEach(item => {
          // Crea un nuevo div con la clase "songs"
          const divCancion = document.createElement('div');
          divCancion.classList.add('songs');
  
          // Crea una imagen con la clase "portada"
          const imgPortada = document.createElement('img');
          imgPortada.src = item.urlPortada; // Asegúrate de tener la propiedad adecuada en tus datos
          imgPortada.alt = 'reggaeton';
          imgPortada.classList.add('portada');
  
          // Crea una imagen con la clase "icono"
          const imgIcono = document.createElement('img');
          imgIcono.src = './img/playImg.png';
          imgIcono.alt = 'icon';
          imgIcono.classList.add('icono');
  
          // Crea un encabezado h4 y un párrafo con la información de la canción
          const h4 = document.createElement('h4');
          h4.textContent = item.titulo; // Asegúrate de tener la propiedad adecuada en tus datos
  
          const p = document.createElement('p');
          p.textContent = item.artista; // Asegúrate de tener la propiedad adecuada en tus datos
  
          // Agrega los elementos al div de la canción
          divCancion.appendChild(imgPortada);
          divCancion.appendChild(imgIcono);
          divCancion.appendChild(h4);
          divCancion.appendChild(p);
  
          // Agrega el div de la canción al contenedor
          contenedorCanciones.appendChild(divCancion);
        });
      })
      .catch(error => console.error('Error al obtener la información:', error));
  });
  