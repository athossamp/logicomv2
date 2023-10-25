let burgerButton = document.getElementById("burgerButton");
let burgerMenu = document.getElementById("burgerMenu");

burgerButton.addEventListener("click", () => {
  burgerButton.classList.toggle("burger-button--active");
  burgerMenu.classList.toggle("hidden");
});

let currentYear = document.getElementById("currentYear");
currentYear.innerHTML = new Date().getFullYear();
