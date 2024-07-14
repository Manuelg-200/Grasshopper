document.addEventListener("DOMContentLoaded", function() {
    var mainDiv = document.querySelector(".ProfileContainer");
    var editButton = document.getElementById("editButton");
    var changePasswordButton = document.getElementById("changePasswordButton");
    var deleteButton = document.getElementById("deleteButton");

    // Edit profile button implementation
    editButton.addEventListener('click', function(event) {
        var fieldContainers = document.querySelectorAll(".fieldContainer");

        // Replace spans with input to edit data
        fieldContainers.forEach(function(container) {
            var label = container.querySelector("label");
            var input = document.createElement("input");
            var span = container.querySelector("span");
            if(label.htmlFor == "email")
                input.type = "email";
            else
                input.type = "text";
            input.value = span.textContent;
            input.name = label.htmlFor;
            span.replaceWith(input);
        });

        // Replace edit button with save button
        var saveButton = document.createElement("input");
        saveButton.type = "submit";
        saveButton.name = "submit";
        saveButton.value = "Salva";
        saveButton.className = "editButton";
        this.replaceWith(saveButton);

        // Replace editButton with submit button
        var submitButton = document.createElement("input");
        submitButton.type = "submit";
        submitButton.name = "submit";
        submitButton.value = "Salva";
        submitButton.className = editButton.className;
        editButton.replaceWith(submitButton);            

        // Replace change password button with cancel button
        var cancelButton = document.createElement("button");
        var changePasswordLink = document.getElementById("changePasswordLink");
        changePasswordLink.href = "#";
        cancelButton.textContent = "Annulla";
        cancelButton.className = "deleteButton";
        changePasswordButton.replaceWith(cancelButton);
        cancelButton.addEventListener('click', function(event) {
            event.preventDefault();
            location.reload();
        });

        // Hide delete password button
        deleteButton.style.display = "none";
        
        // Replace mainDiv with form to submit data through post method
        var form = document.createElement("form");
        form.method = "post";
        form.action = "update_profile.php";
        form.className = mainDiv.className;
        while(mainDiv.firstChild)
            form.appendChild(mainDiv.firstChild);
        mainDiv.replaceWith(form);
    });

    // Delete profile button implementation
    deleteButton.addEventListener('click', function(event) {
        event.preventDefault();
        var confirmation = confirm("Sei sicuro di voler eliminare il tuo account?");
        if(confirmation)
            window.location.href = "deleteProfile.php";
    });
});