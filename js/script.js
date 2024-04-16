document.addEventListener('DOMContentLoaded', function () {

    let openHam = document.querySelector('#openHam');
    let closeHam = document.querySelector('.hamburger #closeHam');

    let navigationItems = document.querySelector('#navigation-items');

    //Kinyitás

    openHam.addEventListener('click', () => {
        navigationItems.style.display = 'flex';
        closeHam.style.display = 'block';
        openHam.style.display = 'none';
    });

    //Bezárás

    closeHam.addEventListener('click', () => {
        navigationItems.style.display = 'none';
        closeHam.style.display = 'none';
        openHam.style.display = 'block';
    });
});




