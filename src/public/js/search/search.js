const searchInput = document.querySelector("#search");
const sortInput = document.querySelector("#sort");
const filterInput = document.querySelector("#cat");

const hasilSearch = document.querySelector(".hasil-search");
const hasilSort = document.querySelector(".hasil-sort");
const hasilFilter = document.querySelector(".hasil-filter");

searchInput &&
    searchInput.addEventListener("input", async (e) => {
        hasilSearch.textContent = e.target.value;
        hasilSort.textContent = sortInput.value;
        hasilFilter.textContent = filterInput.value;
    });

sortInput && sortInput.addEventListener;
