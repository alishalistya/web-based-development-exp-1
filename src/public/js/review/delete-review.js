const deleteBtns = document.querySelectorAll("#delete-btn");
const confirmBtn = document.querySelector("#confirm-btn");
const cancelBtn = document.querySelector("#cancel-btn");
const modalDelete = document.querySelector(".modal");

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
