document.addEventListener("DOMContentLoaded", function() {
    var firstnameInput = document.getElementById("firstname");
    var lastnameInput = document.getElementById("lastname");
    var emailInput = document.getElementById("email");
    var passwordInput = document.getElementById("pass");
    var confirmPasswordInput = document.getElementById("confirm");
    var submitButton = document.getElementById("Submit");

    // Function that disables the submit button if there are errors
    function DisableSubmitButtonCheck() {
        if(firstnameInput.className == "input input-error" || lastnameInput.className == "input input-error" || emailInput.className == "input input-error" || passwordInput.className == "input input-error" || confirmPasswordInput.className == "input input-error")
            submitButton.disabled = true;
        else
            submitButton.disabled = false;
    }

    // Check if firstname is valid
    firstnameInput.addEventListener('input', function(event) {
        var error = document.getElementById("FirstnameError");
        var errorMessage = "";
        var hasError = false;
        var nameRegex = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;

        if(this.value.length == 0) {
            errorMessage = "Nome non inserito";
            hasError = true;
        }
        else if(this.value.length > 40) {
            errorMessage = "Nome troppo lungo";
            hasError = true;
        }
        // Regex to validate names, only letters and spaces allowed
        else if(!this.value.match(nameRegex)) {
            errorMessage = "Caratteri speciali non ammessi";
            hasError = true;
        }
        
        this.className = hasError ? "input input-error" : "input input-ok";
        DisableSubmitButtonCheck();
        error.textContent = errorMessage;
    });

    // Check if lastname is valid
    lastnameInput.addEventListener('input', function(event) {
        var error = document.getElementById("LastnameError");
        var errorMessage = "";
        var hasError = false;
        var nameRegex = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;

        if(this.value.length == 0) {
            errorMessage = "Cognome non inserito";
            hasError = true;
        }
        else if(this.value.length > 40) {
            errorMessage = "Cognome troppo lungo";
            hasError = true;
        }
        // Regex to validate names, only letters and spaces allowed
        else if(!this.value.match(nameRegex)) {
            errorMessage = "Caratteri speciali non ammessi";
            hasError = true;
        }

        this.className = hasError ? "input input-error" : "input input-ok";
        DisableSubmitButtonCheck();
        error.textContent = errorMessage;
    });


    // Check if email is valid
    emailInput.addEventListener('input', function(event) {
        var error = document.getElementById("EmailError");
        var errorMessage = "";
        var hasError = false;
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if(this.value.length == 0) {
            errorMessage = "Email non inserita";
            hasError = true;
        }
        else if(!this.value.match(emailRegex)) {
            errorMessage = "Email non valida";
            hasError = true;
        }
        else if(this.value.length > 40) {
            errorMessage = "Email troppo lunga";
            hasError = true;
        }
        
        this.className = hasError ? "input input-error" : "input input-ok";
        DisableSubmitButtonCheck();
        error.textContent = errorMessage;
    });

    // Check if password is valid
    passwordInput.addEventListener('input', function(event) {
        var PasswordError = document.getElementById("PasswordError");
        var confirmError = document.getElementById("PasswdConfirmError");
        var errorMessage = "";
        var hasError = false;

        if(this.value.length == 0) {
            errorMessage = "Password non inserita";
            hasError = true;
        }
        if(this.value.length < 6) {
            errorMessage = "Password troppo corta";
            hasError = true;
        }
        if(this.value.length > 40) {
            errorMessage = "Password troppo lunga";
            hasError = true;
        }

        // Password confirmation check if the password field is edited
        if(confirmPasswordInput.value != this.value) {
            confirmError.textContent = "Le password non coincidono";
            confirmPasswordInput.className = "input input-error";
        }
        
        this.className = hasError ? "input input-error" : "input input-ok";
        DisableSubmitButtonCheck();
        PasswordError.textContent = errorMessage;
    });

    // Check for password confirmation
    confirmPasswordInput.addEventListener('input', function(event) {
        var error = document.getElementById("PasswdConfirmError");

        if(this.value != passwordInput.value) {
            error.textContent = "Le password non coincidono";
            this.className = "input input-error";
        }
        else {
            error.textContent = "";
            this.className = "input input-ok";
        }
        DisableSubmitButtonCheck();
    });
});