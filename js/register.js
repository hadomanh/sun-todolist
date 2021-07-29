function validateEmail(email) {
    const re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePassword(password) {
    return password.length >= 6;
}

function validateAll(email, password1, password2) {
    return (
        validateEmail(email) &&
        validatePassword(password1) &&
        password1 === password2
    );
}

function checkSubmit(emailEl, passwordEl1, passwordEl2, submitBtn) {
    if (validateAll(emailEl.value, passwordEl1.value, passwordEl2.value)) {
        submitBtn.disabled = false;
    } else {
        submitBtn.disabled = true;
    }
}

const email = document.getElementById("email");
const password1 = document.getElementById("password1");
const password2 = document.getElementById("password2");
const submitBtn = document.getElementById("submitBtn");

email.addEventListener("input", (event) => {
    checkSubmit(email, password1, password2, submitBtn);
    if (!validateEmail(event.target.value)) {
        email.classList.add("is-invalid");
        email.classList.remove("is-valid");
    } else {
        email.classList.remove("is-invalid");
        email.classList.add("is-valid");
    }
});

password1.addEventListener("input", (event) => {
    checkSubmit(email, password1, password2, submitBtn);
    if (!validatePassword(event.target.value)) {
        password1.classList.add("is-invalid");
        password1.classList.remove("is-valid");
    } else {
        password1.classList.remove("is-invalid");
        password1.classList.add("is-valid");
    }
});

password2.addEventListener("input", (event) => {
    checkSubmit(email, password1, password2, submitBtn);
    if (event.target.value !== password1.value) {
        password2.classList.add("is-invalid");
        password2.classList.remove("is-valid");
    } else {
        password2.classList.remove("is-invalid");
        password2.classList.add("is-valid");
    }
});
