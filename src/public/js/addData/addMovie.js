const addForm = document.querySelector(".addMovie");

const titleInput = document.querySelector("#title");
const descriptionInput = document.querySelector("#description");
const yearInput = document.querySelector("#year");
const durationInput = document.querySelector("#duration");
// const posterInput = document.querySelector("");
// const trailerInput = document.querySelector("");

const titleWarn = document.querySelector("#title-warn");
const descriptionWarn = document.querySelector("#description-warn");
const yearWarn = document.querySelector("#year-warn");
const durationWarn = document.querySelector("#duration-warn");
// const posterWarn = document.querySelector("");
// const trailerWarn = document.querySelector("");

const textRegex = /^[a-zA-Z\s]*$/;
const numberRegex = /^[0-9]+$/;


let titleValid = false;
let descriptionValid = false;
let yearValid = false;
let durationValid = false;
// let posterValid = false;
// let trailerValid = false;

titleInput &&
    titleInput.addEventListener(
        "keyup",
        debounce(() => {
            const input = titleInput.value;
            if (input == "") {
                console.log(`Tidak Lolos ${input}`);
                titleWarn.innerHTML = "Nama tidak bisa kosong!";
                titleWarn.className = "show";
                titleValid = false;
            // } else if (!textRegex.test(input)) {
            //     console.log(`Tidak Lolos ${input}`);
            //     titleWarn.innerHTML = "Nama hanya bisa berupa huruf!";
            //     titleWarn.className = "show";
            //     titleValid = false;
            } else {
                console.log(`Lolos ${input}`);
                titleWarn.innerHTML = "";
                titleWarn.className = "hide";
                titleValid = true;
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

yearInput &&
yearInput.addEventListener(
    "keyup",
    debounce(() => {
        const input = yearInput.value;
        if (input == "") {
            console.log(`Tidak Lolos ${input}`);
            yearWarn.innerHTML = "Description tidak bisa kosong!";
            yearWarn.className = "show";
            yearValid = false;
        } else if (!numberRegex.test(input)) {
            console.log(`Tidak Lolos ${input}`);
            yearWarn.innerHTML = "Masukkan hanya angka!";
            yearWarn.className = "show";
            yearValid = false;
        } else if (input > (new Date().getFullYear())) {
            console.log(`Tidak Lolos ${input}`);
            yearWarn.innerHTML = "Harus tahun yang valid!";
            yearWarn.className = "show";
            yearValid = false;
        } else {
            console.log(`Lolos ${input}`);
            yearWarn.innerHTML = "";
            yearWarn.className = "hide";
            yearValid = true;
        }
    }, 300)
);

durationInput &&
durationInput.addEventListener(
    "keyup",
    debounce(() => {
        const input = durationInput.value;
        if (input == "") {
            console.log(`Tidak Lolos ${input}`);
            durationWarn.innerHTML = "Durasi tidak bisa kosong!";
            durationWarn.className = "show";
            durationValid = false;
        } else if (!numberRegex.test(input)) {
            console.log(`Tidak Lolos ${input}`);
            durationWarn.innerHTML = "Masukkan hanya angka!";
            durationWarn.className = "show";
            durationValid = false;
        } else {
            console.log(`Lolos ${input}`);
            durationWarn.innerHTML = "";
            durationWarn.className = "hide";
            durationValid = true;
        }
    }, 300)
);

addForm &&
    addForm.addEventListener("submit", async (e) => {
        console.log("submit");

        const title = titleInput.value;
        const desc = descriptionInput.value;
        const year = yearInput.value;
        const duration = durationInput.value;
        console.log(title, desc, year, duration)

        if (!isDataValid(title, desc, year, duration)){
            e.preventDefault();
            console.log("checked");
            return;
        }
    });

const isDataValid = (title, desc, year, duration) => {
    // Name checking
    if (!title) {
        titleWarn.innerHTML = "Please fill out name!";
        titleWarn.className = "show";
        titleValid = false;
    // } else if (!nameRegex.test(name)){
    //     titleWarn.innerHTML = "Name cannot contain any symbol or number!";
    //     titleWarn.className = "show";
    //     titleValid = false;
    } else {
        titleWarn.className = "hide";
        titleValid = true;
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

    // year checking
    if (!year) {
        yearWarn.innerHTML = "Please fill out year!";
        yearWarn.className = "show";
        yearValid = false;
    } else {
        yearWarn.className = "hide";
        yearValid = true;
    }

    // Description checking
    if (!duration) {
        durationWarn.innerHTML = "Please fill out duration!";
        durationWarn.className = "show";
        durationValid = false;
    } else {
        durationWarn.className = "hide";
        durationValid = true;
    }

    if (!titleValid || !descriptionValid || !yearValid || !durationValid){
        return false;
    }

    return true;

};