const searchInput = document.querySelector("#search");
const sortInput = document.querySelector("#sort");
const filterInput = document.querySelector("#cat");

const hasilSearch = document.querySelector(".hasil-search");
const hasilSort = document.querySelector(".hasil-sort");
const hasilFilter = document.querySelector(".hasil-filter");

sortInput &&
    sortInput.addEventListener("click", async (e) => {
        hasilSort.textContent = sortInput.value;
    });

filterInput &&
    filterInput.addEventListener("click", async (e) => {
        hasilFilter.textContent = e.target.value;
    });

searchInput &&
    searchInput.addEventListener("input", async (e) => {
        searchDebounce(e);
    });

const searchDebounce = debounce(async (e) => {
    const xhr = new XMLHttpRequest();

    xhr.open("GET", `/public/movie/fetch`);

    xhr.send();

    xhr.onreadystatechange = function () {
        if (this.readyState === XMLHttpRequest.DONE) {
            data = JSON.parse(this.responseText);
            console.log(data);
        }
    };
});

function debounce(callback, delay = 1000) {
    let timeout;

    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            callback(...args);
        }, delay);
    };
}
