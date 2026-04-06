import './bootstrap';

//Says that javascript is active and gives my webpage a js-enabled class, so I can make css changes accordingly
document.documentElement.classList.remove('no-js');
document.documentElement.classList.add("js-enabled");

//Disable forms by default
const formInputs = document.querySelectorAll('.form-control');
const formButton = document.getElementById("form-button")
let isEditing = false;



document.addEventListener("DOMContentLoaded", () => {
    //Initial state
    formInputs.forEach(input => {
        input.disabled = true;
    });
    formButton.textContent = "Edit Information";

    formButton.addEventListener("click", function(e) {
        if (!isEditing) {
            // First click → enable editing
            e.preventDefault();

            isEditing = true;

            formInputs.forEach(input => {
                input.disabled = false;
            });

            formButton.textContent = "Confirm Changes";

        } else {
            isEditing = false;
        }
    });
    
});

//Accordion Code 
/*
var accordion = $("#accordion-trigger")
var accordionMenu = $("#accordion-hidden")
accordion.on("click", function(e) {
    e.stopPropagation();
    
    accordion.toggleClass("is-open");
    if (accordion.hasClass("is-open")) {
      accordionMenu.css("display", "block");
    } else {
      accordionMenu.css("display", "none");
    }
  });
*/ 