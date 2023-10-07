const addForm = document.querySelector(".addDirector");

const nameInput = document.querySelector("#name");
const descriptionInput = document.querySelector("#description");
const birthdateInput = document.querySelector("#birth_date");
const photoInput = document.querySelector("photo");

const nameWarn = document.querySelector("#name-warn");
const descriptionWarn = document.querySelector("#description-warn");
const birthdateWarn = document.querySelector("#birth_date-warn");
const photoWarn = document.querySelector("photo-warn");

const nameRegex = /^[a-zA-Z\s]*$/;

let nameValid = false;
let descriptionValid = false;
// let birthdateValid = false;
// let photoValid = false;

nameInput &&
    nameInput.addEventListener(
        "input",
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
    "input",
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
    
        const name = nameInput.value;
        const desc = descriptionInput.value;
        const birth_date = birthdateInput.value;
        const photo = photoInput.value;
        
        console.log('test');

        e.preventDefault();

        if (!isDataValid(name, desc)){
            e.preventDefault();
            return;
        }
    });

const isDataValid = (name, desc) => {
    // Name checking
    console.log(name, desc);
    if (!name) {
        nameWarn.innerHTML = "Please fill out name!";
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

    // // Birthday checking
    // if (!birth_date) {
    //     birthdateWarn.innerHTML = "Please fill out description!";
    //     birthdateWarn.className = "show";
    //     birthdateValid = false;
    // } else {
    //     birthdateWarn.className = "hide";
    //     birthdateValid = true;
    // }

    // // Birthday checking
    // if (!photo) {
    //     photoWarn.innerHTML = "Please fill out description!";
    //     photoWarn.className = "show";
    //     photoValid = false;
    // } else {
    //     photoWarn.className = "hide";
    //     photoValid = true;
    // }

    console.log(nameValid, descriptionValid);

    if (!nameValid || !descriptionValid){
        return false;
    }

    return true;
};