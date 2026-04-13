import './bootstrap';

//Says that javascript is active and gives my webpage a js-enabled class, so I can make css changes accordingly
document.documentElement.classList.remove('no-js');
document.documentElement.classList.add("js-enabled");

document.addEventListener("DOMContentLoaded", () => {
    const logoInput = document.getElementById('logo-input');
    const editingForm = document.querySelector(".editing-form");
    
    //Show the Logo
    if (logoInput) {
    logoInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();

        reader.onload = function(e) {
            const preview = document.getElementById('logo-preview');
            if (!preview) return;

            preview.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
        };

        reader.readAsDataURL(file);
    });
}

    //Disable forms by default
    if (editingForm) {
        const formInputs = document.querySelectorAll('.form-control');
        const formButton = document.getElementById("form-button")
        let isEditing = false;


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
    }
    
    //Accordion Code 
    const accordion = document.getElementById("accordion-trigger");

    if (accordion) {
        const accordionMenus = document.querySelectorAll(".accordion-hidden");

        accordion.addEventListener("click", function (e) {
            e.stopPropagation();

            const isOpen = accordion.classList.toggle("is-open");

            accordionMenus.forEach(menu => {
                menu.style.display = isOpen ? "block" : "none";
            });
        });

        if (new URLSearchParams(window.location.search).get('open') === 'employees') {
            accordion.click();
        }
    }

    //Reset button
    const resetButtons = document.querySelectorAll(".reset-button");

    resetButtons.forEach(button => {
        button.addEventListener("click", function () {
            const form = this.closest("form"); //uses the closest form
            if (form) {
                form.reset();
            }
        });
    });
});


