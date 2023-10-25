document.getElementById("selectOption").addEventListener("change", function () {
  const selectedValue = this.value;
  const elementToMove = document.getElementById("elementToMove");
  const destinationDiv = document.getElementById(selectedValue);

  if (destinationDiv) {
    destinationDiv.appendChild(elementToMove);
  }
});

let burgerButton = document.getElementById("burgerButton");
let burgerMenu = document.getElementById("burgerMenu");

burgerButton.addEventListener("click", () => {
  burgerButton.classList.toggle("burger-button--active");
  burgerMenu.classList.toggle("hidden");
});

let currentYear = document.getElementById("currentYear");
currentYear.innerHTML = new Date().getFullYear();
