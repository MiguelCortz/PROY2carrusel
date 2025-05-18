document.getElementById("callinaside").addEventListener("click", function() {
  const aside = document.getElementById("aside");
  const callinbutton = document.getElementById("callinaside");

  // Alternar mostrar/ocultar
  if (aside.style.transform === "translateX(0px)") {
    aside.style.transform = "translateX(-500px)";
    callinbutton.style.transform ="translateX(-400px)";
  } else {
    aside.style.transform = "translateX(0px)";
    callinbutton.style.transform ="translateX(0px)";
  }
});