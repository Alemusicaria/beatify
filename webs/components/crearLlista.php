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
<h2>Busquem alguna cosa per a la teva llista</h2><br>
<div class="buscar">
    <input type="text" id="searchInput" placeholder="Cerca" required />
    <div class="btn" id="search">
        <i class="fas fa-search icon"></i>
    </div>
</div>
<div id="taula" class="scrollable-container"></div>
<p>&copy; 2024 Beatify. Tots els drets reservats.</p>

<script src="../assets/js/carregarLlistaCancons.js"></script>
<script src="../assets/js/llistaCanco.js"></script>
</html>