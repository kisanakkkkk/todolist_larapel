document.querySelector<HTMLFormElement>('#register-form').onsubmit = function (e) {
    e.preventDefault();

    let username = document.querySelector<HTMLInputElement>('#username').value;
    let email = document.querySelector<HTMLInputElement>('#email').value;
    let password = document.querySelector<HTMLInputElement>('#password').value;
    let confirm_password = document.querySelector<HTMLInputElement>('#confirm-password').value;

    let error_username = document.querySelector<HTMLSpanElement>('#error-username');
    let error_email = document.querySelector<HTMLSpanElement>('#error-email');
    let error_password = document.querySelector<HTMLSpanElement>('#error-password');
    let error_confirm_password = document.querySelector<HTMLSpanElement>('#error-confirm-password');

    let isValid = true;
    let emailRegex = /[a-zA-Z0-9]+@[a-z]+\.[a-z\.]+/g;

    if (username.length < 5) { isValid = false; error_username.textContent = "Must be 5 characters or more"; }
    else { error_username.textContent = ""; }

    if (email.length <= 0) { isValid = false; error_email.textContent = "Must be filled"; }
    else if (!emailRegex.test(email)) { isValid = false; error_email.textContent = "Must be valid email"; }
    else { error_email.textContent = ""; }

    if (password.length < 8) { isValid = false; error_password.textContent = "Must be 8 characters or more"; }
    else { error_password.textContent = ""; }

    if (confirm_password !== password) { isValid = false; error_confirm_password.textContent = "Must be equal to password field"; }
    else { error_confirm_password.textContent = ""; }

    if (isValid) document.querySelector<HTMLFormElement>('#register-form').submit()
}
