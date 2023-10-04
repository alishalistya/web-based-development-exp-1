const loginForm = document.querySelector(".login");
const usernameInput = document.querySelector("#username");
const passwordInput = document.querySelector("#password");

loginForm &&
    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const xhr = new XMLHttpRequest();

        xhr.open("POST", `/user/login`);

        const formLogin = new FormData();
        formLogin.append("username", usernameInput.value);
        formLogin.append("password", passwordInput.value);

        xhr.send(formLogin);

        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 201) {
                    data = JSON.parse(this.responseText);
                    location.replace(data.redirect);
                }
            }
        };
    });
