document.addEventListener('DOMContentLoaded', function () {
    var newPasswordInput = document.getElementById("newPassword");
    var confirmPasswordInput = document.getElementById("confirmPassword");
    var submitButton = document.getElementById("submit");

    // Function that disables the submit button if there are errors
    function DisableSubmitButtonCheck() {
        if (newPasswordInput.className == "input input-error" || confirmPasswordInput.className == "input input-error")
            submitButton.disabled = true;
        else
            submitButton.disabled = false;
    }

    // Check if password is valid
    newPasswordInput.addEventListener('input', function (event) {
        var newPasswordError = document.getElementById("newPasswordError");
        var confirmPasswordError = document.getElementById("confirmPasswordError");
        var errorMessage = "";
        var hasError = false;

        if (newPasswordInput.value.length == 0) {
            errorMessage = "Password non inserita";
            hasError = true;
        }
        if (newPasswordInput.value.length < 6) {
            errorMessage = "Password troppo corta";
            hasError = true;
        }
        if (newPasswordInput.value.length > 40) {
            errorMessage = "Password troppo lunga";
            hasError = true;
        }

        // Password confirmation check if the password field is edited
        if (confirmPasswordInput.value != newPasswordInput.value) {
            confirmPasswordError.textContent = "Le password non coincidono";
            confirmPasswordInput.className = "input input-error";
        }

        newPasswordInput.className = hasError ? "input input-error" : "input input-ok";
        DisableSubmitButtonCheck();
        newPasswordError.textContent = errorMessage;
    });

    // Check for password confirmation
    confirmPasswordInput.addEventListener('input', function(event) {
        var error = document.getElementById("confirmPasswordError");

        if(confirmPasswordInput.value != newPasswordInput.value) {
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