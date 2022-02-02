"use strict";
//
//search by membre
//
let searchMembreEl = document.getElementById('inputMembre');

let searchMembreQuerySelector = function (event) {
  
    let needle = event.target.value; // la valeur à chercher
    
    if (needle) {
      // éléments contenant un bout de cette classe
      for (const el of document.querySelectorAll(`.listing > .membre-card[class*="${needle}"]`)) {
        el.style.display = "flex";
      }
      // éléments ne contenant pas un bout de cette classe
      for (const el of document.querySelectorAll(`.listing > .membre-card:not([class*="${needle}"])`)) {
        el.style.display = "none";
      }
    } else {
      // if the search bar is empty
      for (const el of document.querySelectorAll(".listing > .membre-card")) {
        el.style.display = "flex";
      }
    }
  }
  
  // events
  searchMembreEl.addEventListener("input", searchMembreQuerySelector);