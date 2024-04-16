/* Az eseménykezelő a DOM(Document Object Model) teljes betöltődése után fut le,
 hogy biztosítsuk, hogy az összes elem elérhető legyen.*/

document.addEventListener("DOMContentLoaded", function () {
  // Az összes accordion avagy harmonika osztályú elem.
  var acc = document.getElementsByClassName("accordion");
  var i;

  for (i = 0; i < acc.length; i++) {
    // Minden accordion elemhez hozzáadunk egy click eseménykezelőt.
    acc[i].addEventListener("click", function () {
      // A kattintott accordion elemhez hozzáadunk vagy eltávolítunk egy active osztályt.
      this.classList.toggle("active");
      this.parentElement.classList.toggle("active");

      // A kattintott accordion elem után következő elemet keresjük meg, ami a tartalompanel.
      var panel = this.nextElementSibling;

      // Ha a tartalompanel jelenleg látható (display: block), amikor elrejtjük (display: none).
      if (panel.style.display === "block") {
        panel.style.display = "none";
      } else {
        // Ha a tartalompanel elrejtve van (display: none), amikor megjelenítjük (display: block).
        panel.style.display = "block";
      }
    });
  }
});
