<h2 id="nomLlista">

</h2>
<h2 id="nombreListaTitulo" style="display: none;"></h2>
<!-- AQUI VAN LES CANÇONS DE LA LLISTA-->
<div id="llistaSeleccionades"></div>
<hr>
<div id="taula" class="scrollable-container"></div>
<script>
    var selectedList = JSON.parse(localStorage.getItem('selectedList'));
    var listTitle = selectedList.nomLlista;
    $('#nomLlista').text(listTitle);
</script>
<script src="../assets/js/carregarLlistaCancons.js"></script>
