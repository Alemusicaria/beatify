<html>
<div class="formulario" id="formulario">
    <form>
        <input type="text" name="nomLlista" id="nomLlista" placeholder="Nom de la llista" required>
        <button type="button" id="crearListaBtn">Crear Lista</button>
    </form>
</div>
<h2 id="nombreListaTitulo" style="display: none;"></h2>
<!-- AQUI VAN LES CANÇONS DE LA LLISTA-->
<div id="llistaSeleccionades"></div>
<hr>
<div id="taula" class="scrollable-container"></div>

<script src="../assets/js/carregarLlistaCancons.js"></script>
<script src="../assets/js/llistaCanco.js"></script>
</html>