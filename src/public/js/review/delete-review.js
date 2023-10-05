const deleteBtns = document.querySelectorAll("#delete-btn");
const cancelBtn = document.querySelector("#cancel-btn");
const modal = document.querySelector(".modal");

deleteBtns &&
    deleteBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            console.log(btn.getAttribute("data"));
            modal.showModal();
        });
    });

cancelBtn &&
    cancelBtn.addEventListener("click", () => {
        modal.close();
    });
