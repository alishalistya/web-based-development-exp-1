const addForm = document.querySelector(".addDirector");

const nameInput = document.querySelector("#name");
const descriptionInput = document.querySelector("#description");
// const birthdateInput = document.querySelector("");
// const photoInput = document.querySelector("");

const nameWarn = document.querySelector("#name-warn");
const descriptionWarn = document.querySelector("#description-warn");
// const birthdateWarn = document.querySelector("");
// const photoWarn = document.querySelector("");

const nameRegex = /^[a-zA-Z\s]*$/;

let nameValid = false;
let descriptionValid = false;
// let birthdayValid = false;
// let photoValid = false;

nameInput &&
    nameInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = nameInput.value;
            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                nameWarn.innerHTML = "Nama tidak bisa kosong!";
                nameWarn.className = "show";
                nameValid = false;
            } else if (!nameRegex.test(input)) {
                console.log(`Tidak Lolos ${input}`);
                nameWarn.innerHTML = "Nama hanya bisa berupa huruf!";
                nameWarn.className = "show";
                nameValid = false;
            } else {
                console.log(`Lolos ${input}`);
                nameWarn.innerHTML = "";
                nameWarn.className = "hide";
                nameValid = true;
            }
        }, 300)
    );

descriptionInput &&
descriptionInput.addEventListener(
    "keyup",
    debounce(() => {
        const input = descriptionInput.value;
        if (input == "") {
            console.log(`Tidak Lolos ${input}`);
            descriptionWarn.innerHTML = "Description tidak bisa kosong!";
            descriptionWarn.className = "show";
            descriptionValid = false;
        } else {
            console.log(`Lolos ${input}`);
            descriptionWarn.innerHTML = "";
            descriptionWarn.className = "hide";
            descriptionValid = true;
        }
    }, 300)
);

addForm &&
    addForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const name = nameInput.value;
        const desc = descriptionInput.value;

        if (!isDataValid(name, desc)){
            return;
        }
    });

const isDataValid = (name, desc) => {
    // Name checking
    if (!name) {
        nameWarn.innerHTML = "Please fill out name!";
        nameWarn.className = "show";
        nameValid = false;
    } else if (!nameRegex.test(name)){
        nameWarn.innerHTML = "Name cannot contain any symbol or number!";
        nameWarn.className = "show";
        nameValid = false;
    } else {
        nameWarn.className = "hide";
        nameValid = true;
    }

    // Description checking
    if (!desc) {
        descriptionWarn.innerHTML = "Please fill out description!";
        descriptionWarn.className = "show";
        descriptionValid = false;
    } else {
        descriptionWarn.className = "hide";
        descriptionValid = true;
    }
};