document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
  widthDinamico();
  serviceWorker();
});

/* function serviceWorker() {
  if ("serviceWorker" in navigator)
    navigator.serviceWorker
      .register("./sw.js")
      .then((registrado) =>
        console.log("Se instalo correctamente...", registrado)
      )
      .catch((error) => console.log("Fallo la instalacion...", error));
  else {
    console.log("Service Workers no soportados");
  }
} */

function darkMode() {
  const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

  if (prefiereDarkMode.matches) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }

  prefiereDarkMode.addEventListener("change", function () {
    if (prefiereDarkMode.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  const botonDarkMode = document.querySelector(".dark-mode-boton");
  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
  });
}

function eventListeners() {
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", navegacionResponsive);
}

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");

  navegacion.classList.toggle("mostrar");
}
/* 
function header() {
  const headerInicio = document.querySelector(".inicio");
  headerInicio.style.backgroundImage = "url('/build/img/header2.jpeg')";

  setInterval(() => {
    headerInicio.style.backgroundImage = "url('/build/img/header1.jpeg')";
  }, 5000);
  setInterval(() => {
    headerInicio.style.backgroundImage = "url('/build/img/header3.jpeg')";
  }, 10000);
  setInterval(() => {
    headerInicio.style.backgroundImage = "url('/build/img/header4.jpeg')";
  }, 15000);
  setInterval(() => {
    headerInicio.style.backgroundImage = "url('/build/img/header2.jpeg')";
  }, 20000);
}
 */

const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slider__section");
let sliderSectionLast = sliderSection[sliderSection.length - 1]; //De esta manera obtenemos la ultima imagen

const btnLeft = document.querySelector("#btn-left");
const btnRight = document.querySelector("#btn-right");

slider.insertAdjacentElement("afterbegin", sliderSectionLast); //ponemos al inicio la ultima imagen

function moverDerecha() {
  let sliderSectionFirst = document.querySelectorAll(".slider__section")[0]; //Tomamos la primer imagen
  slider.style.marginLeft = "-200%";
  slider.style.transition = "all 0.5s";
  setTimeout(function () {
    slider.style.transition = "none";
    slider.insertAdjacentElement("beforeend", sliderSectionFirst); //ponemos al final la primer imagen
    slider.style.marginLeft = "-100%";
  }, 500);
}

function moverIzquierda() {
  let sliderSection = document.querySelectorAll(".slider__section");
  let sliderSectionLast = sliderSection[sliderSection.length - 1]; //De esta manera obtenemos la ultima imagen
  slider.style.marginLeft = "0";
  slider.style.transition = "all 0.5s";
  setTimeout(function () {
    slider.style.transition = "none";
    slider.insertAdjacentElement("afterbegin", sliderSectionLast); //ponemos al inicio la ultima imagen
    slider.style.marginLeft = "-100%";
  }, 500);
}

function widthDinamico() {
  let cantidad = document.querySelectorAll("#slider .slider__section").length;
  console.log(cantidad);
  
}

btnRight.addEventListener("click", function () {
  moverDerecha();
});

btnLeft.addEventListener("click", function () {
  moverIzquierda();
});
