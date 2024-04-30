
<form class="contacte-form" action="../assets/php/send_email.php" method="post">
    <h1>Envia'ns un Missatge</h1>
    <label for="name"></label>
    <input type="text" id="name" placeholder="Nom" required>
    <label for="telefono"></label>
    <input type="number" id="telefono" placeholder="Telefon" required>
    <label for="email"></label>
    <input type="email" id="email" placeholder="Email" required>
    <label for="assumpte"></label>
    <input type="text" id="assumpte" placeholder="Assumpte" required>
    <textarea name="textarea" id="textarea" cols="30" rows="3" placeholder="Missatge" required></textarea>
    <button onclick="alert('Enviat!')">Enviar</button>
    <br>
    <br>

</form>