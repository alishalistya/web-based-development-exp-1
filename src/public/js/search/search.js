const searchInput = document.querySelector("#search");
const sortInput = document.querySelector("#sort");
const categoryInput = document.querySelector("#cat");
const yearInput = document.querySelector("#year");

const resultContainer = document.querySelector(".movie-container");
const pageText = document.querySelector(".page-text");
const prevPage = document.querySelector(".prev-page");
const nextPage = document.querySelector(".next-page");
const pageNumber = document.querySelector("#page-number");

let totalPage;
let currPage = 1;
sortInput &&
    sortInput.addEventListener("input", async (e) => {
        if (searchInput.value != "") {
            searchDebounce();
        }
    });

categoryInput &&
    categoryInput.addEventListener("input", async (e) => {
        if (searchInput.value != "") {
            searchDebounce();
        }
    });

yearInput &&
    yearInput.addEventListener("input", async (e) => {
        if (searchInput.value != "") {
            searchDebounce();
        }
    });

searchInput &&
    searchInput.addEventListener("input", async (e) => {
        console.log(`INI : ${searchInput.value.trim().length}`);
        if (searchInput.value != "") {
            searchDebounce();
        }
    });

prevPage &&
    prevPage.addEventListener("click", async () => {
        if (currPage === 1) {
            return;
        }

        currPage--;
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `/movie/fetch/${currPage}?q=${searchInput.value}&category=${categoryInput.value}&sort=${sortInput.value}&year=${yearInput.value}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                updateComponentResult(data);
            }
        };
    });
nextPage &&
    nextPage.addEventListener("click", async () => {
        if (currPage === totalPage) {
            return;
        }

        currPage++;
        const xhr = new XMLHttpRequest();

        xhr.open("GET", `/movie/fetch/${currPage}?q=${searchInput.value}&category=${categoryInput.value}&sort=${sortInput.value}&year=${yearInput.value}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);
                updateComponentResult(data);
            }
        };
    });

const searchDebounce = debounce(async () => {
    if (searchInput.value == "") {
        return;
    }

    const xhr = new XMLHttpRequest();

    xhr.open("GET", `/movie/fetch/1?q=${searchInput.value}&category=${categoryInput.value}&sort=${sortInput.value}&year=${yearInput.value}`);

    xhr.send();

    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            console.log(this.responseText);
            data = JSON.parse(this.responseText);
            processResult(data);
        }
    };
});

const processResult = (data) => {
    totalPage = data.page;
    let resultHTML = "";
    if (data.page === 0) {
        console.log(data.page);
        resultHTML = `
            <h1 class="no-result">
                Gak ketemu ini :(
            </h1>
        `;
        resultContainer.innerHTML = resultHTML;
        pageText.innerHTML = `Page <span id="page-number">0</span> of 0`;
        prevPage.disabled = true;
        nextPage.disabled = true;
    } else {
        currPage = 1;
        pageText.innerHTML = `Page <span id="page-number">1</span> of ${data.page}`;
        updateComponentResult(data);
    }
};

const updateComponentResult = (data) => {
    let resultHMTL = "";

    for (let movie of data.movies.values()) {
        resultHMTL += `
        <div class="movie-card">
            <a href="/movie/detail/${movie.movie_id}" class="movie-thumbnail">
                <img src="/media/images/anatomy.png" alt="${movie.title}" />
            </a>
            <div class="movie-header">
                <h4 class="title">${movie.title}</p>
            </div>
        </div>
        `;
    }
    console.log(currPage);
    resultContainer.innerHTML = resultHMTL;
    pageText.innerHTML = `Page <span id="page-number">${currPage}</span> of ${data.page}`;
    if (currPage != 1) {
        prevPage.disabled = false;
    } else {
        prevPage.disabled = true;
    }

    if (currPage != totalPage) {
        nextPage.disabled = false;
    } else {
        nextPage.disabled = true;
    }
};
