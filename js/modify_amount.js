// A 'toggleQuantityInput' függvény egy adott termék mennyiségi beviteli mezőjének megjelenítését vagy elrejtését kezeli.
function toggleQuantityInput(termekId) {
    var quantityInput = document.getElementById('quantityInput' + termekId);
    var modifyForm = document.getElementById('modifyForm' + termekId);

    if (quantityInput.style.display === "none") {
        quantityInput.style.display = "inline-block";
        // Hozzáadunk egy eseménykezelőt a mennyiségi beviteli mezőhöz.
        quantityInput.addEventListener('change', function() {
            modifyForm.submit(); // Beküldjük a formot, amikor a mennyiséget megváltoztatták.
        });
    } else {
        // Ha a mennyiségi beviteli mező már megjelenik, akkor elrejtjük (display: none).
        quantityInput.style.display = "none";
    }
}
