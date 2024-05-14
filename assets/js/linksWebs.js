$(document).ready(function () {
    // Funció per carregar la pàgina d'inici al carregar la pàgina
    function cargarInici() {
        // Sol·licitud AJAX per obtenir el contingut de 'inici.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/inici.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    }

    // Llamada inicial per carregar la pàgina d'inici
    cargarInici();

    // Esdeveniment de clic per l'element #crear
    $('#crear').click(function () {
        // Sol·licitud AJAX per obtenir el contingut de 'crearLlista.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/crearLlista.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    });

    // Esdeveniment de clic per l'element #asistencia
    $('#asistencia').click(function () {
        // Sol·licitud AJAX per obtenir el contingut de 'asistencia.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/asistencia.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    });

    // Esdeveniment de clic per l'element #inici
    $('#inici').click(function () {
        // Crida a la funció 'cargarInici()' per recarregar la pàgina d'inici
        cargarInici();
    });

    // Esdeveniment de clic per l'element #obrirMicro
    $('#obrirMicro').click(function () {
        // Sol·licitud AJAX per obtenir el contingut de 'obrirMicro.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/obrirMicro.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    });

    // Esdeveniment de clic per l'element #lletra
    $('#lletra').click(function () {
        // Sol·licitud AJAX per obtenir el contingut de 'lletra.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/lletra.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    });

    // Esdeveniment de clic per l'element #premium
    $('#premium').click(function () {
        // Sol·licitud AJAX per obtenir el contingut de 'premium.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/premium.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    });

    // Esdeveniment de clic per l'element .portada (manejat mitjançant delegació d'esdeveniments)
    $(document).on('click', '.portada', function () {
        // S'obtenen les dades de la cançó seleccionada i es guarden a la memòria local
        var songTitle = $(this).siblings('h4').text();
        var artistInfo = $(this).siblings('p').text();
        var imgSrc = $(this).attr('src');
        localStorage.setItem('selectedSong', JSON.stringify({
            title: songTitle,
            artistInfo: artistInfo,
            imgSrc: imgSrc
        }));
        // Es crida a la funció per carregar la pàgina de cançons
        pageSongs();
    });

    // Funció per carregar la pàgina de cançons
    function pageSongs() {
        // Sol·licitud AJAX per obtenir el contingut de 'pageSongs.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/pageSongs.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    }

    // Esdeveniment de clic per l'element .nom-artista (manejat mitjançant delegació d'esdeveniments)
    $(document).on('click', '.nom-artista', function () {
        // S'obté el nom de l'artista seleccionat i es guarda a la memòria local
        var nombreArtista = $(this).text();
        localStorage.setItem('selectedArtist', nombreArtista);
        // Es crida a la funció per carregar la pàgina d'artistes
        pageArtistas();
    });

    // Funció per carregar la pàgina d'artistes
    function pageArtistas() {
        // Sol·licitud AJAX per obtenir el contingut de 'pageArtistas.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/pageArtistas.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    }

    // Esdeveniment de clic per l'element .boxLlista (manejat mitjançant delegació d'esdeveniments)
    $(document).on('click', '.boxLlista', function () {
        // S'obtenen les dades de la llista seleccionada i es guarden a la memòria local
        var nomLlista = $(this).children('a').text();
        var idLlista = $(this).children('p#lista').text();
        var idUser = $(this).children('p#user').text();
        var img = $(this).children('p#foto').text();
        localStorage.setItem('selectedList', JSON.stringify({
            nomLlista: nomLlista,
            id_Llista: idLlista,
            id_User: idUser,
            img: img
        }));
        // Es crida a la funció per carregar la pàgina de llistes
        pageListas();
    });

    // Funció per carregar la pàgina de llistes
    function pageListas() {
        // Sol·licitud AJAX per obtenir el contingut de 'pageListas.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/pageListas.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    }

    // Esdeveniment de clic per l'element .moreSongs (manejat mitjançant delegació d'esdeveniments)
    $(document).on('click', '.moreSongs', function () {
        // S'obté la llista seleccionada des de la memòria local i es guarda a les cookies
        var selectedList = JSON.parse(localStorage.getItem('selectedList'));
        var idLlista = selectedList.id_Llista;
        document.cookie = "ID_llista=" + idLlista + "; path=/";
        // Es crida a la funció per afegir més cançons
        addSongs();
    });

    // Funció per afegir més cançons
    function addSongs() {
        // Sol·licitud AJAX per obtenir el contingut de 'addSongs.php' i inserir-lo a la pàgina
        $.ajax({
            url: './components/addSongs.php',
            type: 'GET',
            success: function (data) {
                $('.contenedor-right').html(data); // Insereix el contingut obtingut dins de l'element .contenedor-right
            }
        });
    }
});
