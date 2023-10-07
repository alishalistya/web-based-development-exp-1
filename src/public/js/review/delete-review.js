const deleteBtns = document.querySelectorAll("#delete-btn");
const editBtns = document.querySelectorAll("#edit-btn");
const confirmBtn = document.querySelector("#confirm-btn-modal");
const cancelBtn = document.querySelector("#cancel-btn-modal");
const modalDelete = document.querySelector(".modal");

editBtns &&
    editBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            location.replace(`http://localhost:8080/review/update?review_id=${btn.getAttribute("data")}`);
        });
    });

deleteBtns &&
    deleteBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
            // console.log(btn.getAttribute("dat"));
            modalDelete.setAttribute("review_id", btn.getAttribute("data"));
            modalDelete.showModal();
        });
    });

cancelBtn &&
    cancelBtn.addEventListener("click", () => {
        console.log(`you close ${modalDelete.getAttribute("review_id")}`);
        modalDelete.close();
    });

confirmBtn &&
    confirmBtn.addEventListener("click", () => {
        const reviewID = modalDelete.getAttribute("review_id");

        if (!reviewID) {
            return;
        }

        const xhr = new XMLHttpRequest();

        xhr.open("DELETE", `/review/delete?review_id=${reviewID}`);

        xhr.send();

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                data = JSON.parse(this.responseText);

                if (!data.error && this.status == 200) {
                    location.replace("http://localhost:8080/review/index/1");
                }
            }
        };
    });
