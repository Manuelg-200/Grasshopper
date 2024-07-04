document.addEventListener("DOMContentLoaded", function() {
    var userInput = document.getElementById("Username");
    var emailInput = document.getElementById("Email");
    var passwordInput = document.getElementById("Password");
    var confirmPasswordInput = document.getElementById("passwdconfirm");
    var submitButton = document.getElementById("submit");

    // Function that disables the submit button if there are errors
    function DisableSubmitButtonCheck() {
        if(userInput.className == "input input-error" || emailInput.className == "input input-error" || passwordInput.className == "input input-error" || confirmPasswordInput.className == "input input-error")
            submitButton.disabled = true;
        else
            submitButton.disabled = false;
    }

    // Check if username is valid
    userInput.addEventListener('input', function(event) {
        var error = document.getElementById("UsernameError");
        var errorMessage = "";
        var hasError = false;

        if(userInput.value.length == 0) {
            errorMessage = "Username non inserito";
            hasError = true;
        }
        else if(userInput.value.length > 20) {
            errorMessage = "Username troppo lungo";
            hasError = true;
        }
        else if(userInput.value.match(/[^a-zA-Z0-9]/)) {
            errorMessage = "Caratteri speciali non ammessi";
            hasError = true;
        }
        
        userInput.className = hasError ? "input input-error" : "input input-ok";
        DisableSubmitButtonCheck();
        error.textContent = errorMessage;
    });

    // Check if email is valid
    emailInput.addEventListener('input', function(event) {
        var error = document.getElementById("EmailError");
        var errorMessage = "";
        var hasError = false;
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if(emailInput.value.length == 0) {
            errorMessage = "Email non inserita";
            hasError = true;
        }
        else if(!emailInput.value.match(emailRegex)) {
            errorMessage = "Email non valida";
            hasError = true;
        }
        else if(emailInput.value.length > 40) {
            errorMessage = "Email troppo lunga";
            hasError = true;
        }
        
        emailInput.className = hasError ? "input input-error" : "input input-ok";
        DisableSubmitButtonCheck();
        error.textContent = errorMessage;
    });

    // Check if password is valid
    passwordInput.addEventListener('input', function(event) {
        var PasswordError = document.getElementById("PasswordError");
        var confirmError = document.getElementById("passwdconfirmError");
        var errorMessage = "";
        var hasError = false;

        if(passwordInput.value.length == 0) {
            errorMessage = "Password non inserita";
            hasError = true;
        }
        if(passwordInput.value.length < 6) {
            errorMessage = "Password troppo corta";
            hasError = true;
        }
        if(passwordInput.value.length > 40) {
            errorMessage = "Password troppo lunga";
            hasError = true;
        }

        // Password confirmation check if the password field is edited
        if(confirmPasswordInput.value != passwordInput.value) {
            confirmError.textContent = "Le password non coincidono";
            confirmPasswordInput.className = "input input-error";
        }
        
        passwordInput.className = hasError ? "input input-error" : "input input-ok";
        DisableSubmitButtonCheck();
        PasswordError.textContent = errorMessage;
    });

    // Check for password confirmation
    confirmPasswordInput.addEventListener('input', function(event) {
        var error = document.getElementById("passwdconfirmError");

        if(confirmPasswordInput.value != passwordInput.value) {
            error.textContent = "Le password non coincidono";
            confirmPasswordInput.className = "input input-error";
        }
        else {
            error.textContent = "";
            confirmPasswordInput.className = "input input-ok";
        }
        DisableSubmitButtonCheck();
    });
});