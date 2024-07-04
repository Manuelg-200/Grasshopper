document.addEventListener("DOMContentLoaded", function() {
    var editButton = document.getElementById("editButton");
    var changePasswordButton = document.getElementById("changePasswordButton");
    editButton.addEventListener('click', function(event) {
        var oldDocument = document;
        var values = document.querySelectorAll(".values");

        // Replace spans with input to edit data
        values.forEach(function(span) {
            var input = document.createElement("input");
            input.type = "text";
            input.value = span.textContent;
            input.id = span.id;
            span.replaceWith(input);
        });

        // Replace edit button with save button
        var saveButton = document.createElement("button");
        saveButton.textContent = "Salva";
        saveButton.className = "editButton";
        editButton.replaceWith(saveButton);

        // Replace change password button with cancel button
        var cancelButton = document.createElement("button");
        cancelButton.textContent = "Annulla";
        cancelButton.className = "deleteButton";
        var changePasswordButton = document.getElementById("changePasswordButton");
        changePasswordButton.replaceWith(cancelButton);

        // Hide delete password button
        var deleteButton = document.getElementById("deleteButton");
        deleteButton.style.display = "none";
        
        // Add event listener to save buttonn and send new data to server
        saveButton.addEventListener('click', function(event) {
            var inputs = document.querySelectorAll("input");
            var data = {};
            inputs.forEach(function(input) {
                data[input.id] = input.value;
            });
            console.log(data);
            fetch('editProfile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                if(data.error == "DBerror") {
                    fetch('profileError.php')
                    .then(response => response.text())
                    .then(data => {
                        document.open();
                        document.write(data);
                        document.close();
                    });
                }
                else {
                    document = oldDocument;
                    location.reload();
                }
            });
        });
        // Add event listener to cancel button
        cancelButton.addEventListener('click', function(event) {
            document = oldDocument;
            location.reload();
        });
    });
});