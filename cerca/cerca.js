document.getElementById('cercaInput').addEventListener('input', function () {
    const cercaTerm = this.value.toLowerCase();
    console.log('dada:', cercaTerm);
    // Realitza una sol·licitud AJAX per obtenir les dades del servidor PHP
    fetch(`./cerca.php?cerca=${cercaTerm}`)
        .then(response => response.json())
        .then(data => displayUsers(data))
        .catch(error => console.error('Error:', error));
});

function displayUsers(userArray) {
    console.log("prova");
    const userList = document.getElementById('userList');
    userList.innerHTML = '';

    if (userArray.length > 0) {
        userArray.forEach(user => {
            const listItem = document.createElement('li');
            listItem.textContent = user.username;
            userList.appendChild(listItem);
        });
    } else {
        const noResultsItem = document.createElement('li');
        noResultsItem.textContent = 'Cap resultat trobat.';
        userList.appendChild(noResultsItem);
    }
}
