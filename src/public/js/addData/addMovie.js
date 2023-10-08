const addForm = document.querySelector(".addMovie");

const titleInput = document.querySelector("#title");
const descriptionInput = document.querySelector("#description");
const yearInput = document.querySelector("#year");
const durationInput = document.querySelector("#duration");
const posterInput = document.querySelector("#poster");
const trailerInput = document.querySelector("#trailer");

const titleWarn = document.querySelector("#title-warn");
const descriptionWarn = document.querySelector("#description-warn");
const yearWarn = document.querySelector("#year-warn");
const durationWarn = document.querySelector("#duration-warn");
const posterWarn = document.querySelector("#poster-warn");
const trailerWarn = document.querySelector("#trailer-warn");
const actorsInput = document.querySelector("#actors");
const directorsInput = document.querySelector("#directors");

const textRegex = /^[a-zA-Z\s]*$/;
const numberRegex = /^[0-9]+$/;

let titleValid = false;
let descriptionValid = false;
let yearValid = false;
let durationValid = false;
let posterValid = false;
let trailerValid = false;

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
            } else if (input > new Date().getFullYear()) {
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
        e.preventDefault();
        console.log("submit");

        const title = titleInput.value;
        const desc = descriptionInput.value;
        const year = yearInput.value;
        const duration = durationInput.value;

        const checkData = isDataValid(title, desc, year, duration);

        if (!checkData || posterInput.files.length == 0 || trailerInput.files.length == 0 ) {
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

    // photo checking
    if (posterInput.files.length == 0) {
        posterWarn.innerHTML = "Please choose photo!";
        posterWarn.className = "show";
        posterValid = false;
    } else {
        posterWarn.className = "hide";
        posterValid = true;
    }

    // photo checking
    if (trailerInput.files.length == 0) {
        trailerWarn.innerHTML = "Please choose photo!";
        trailerWarn.className = "show";
        trailerValid = false;
    } else {
        trailerWarn.className = "hide";
        trailerValid = true;
    }

    if (!titleValid || !descriptionValid || !yearValid || !durationValid || !posterValid || !trailerValid) {
        return false;
    }

    return true;
};

actorsInput &&
    actorsInput.addEventListener("input", (e) => {
        const input = JSON.parse(e.target.value);
        drawTag(input, "actor");
    });

directorsInput &&
    directorsInput.addEventListener("input", (e) => {
        const input = JSON.parse(e.target.value);
        drawTag(input, "director");
    });

const drawTag = (input, type) => {
    let tagContainer = document.querySelector(`.selected-${type}-container`).innerHTML;

    let selectedElement = `
    <div class="option-${type}-tag option-tag" data="${input.id}">
        <div class="option-name">
            <p>${input.name}</p>
        </div>
        <a id="delete-${type}-tag" data="${input.id}" onclick="deleteTagHandler(this, '${type}')">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
            </svg>
        </a>
    </div>
    `;
    if (tagContainer.includes(`<p>${input.name}</p>`)) {
        return;
    }
    tagContainer += selectedElement;

    document.querySelector(`.selected-${type}-container`).innerHTML = tagContainer;
};

const deleteTagHandler = (element, type) => {
    let Id = element.getAttribute("data");
    const tag = document.querySelector(`.option-${type}-tag[data="${Id}"]`);
    tag.remove();
};
