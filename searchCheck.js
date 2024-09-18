document.addEventListener("DOMContentLoaded", function() {
    var searchButton = document.querySelector(".searchButton");
    var searchInput = document.querySelector(".searchBar");

    searchButton.addEventListener('click', function(event) {
        if(searchInput.value == "") {
            event.preventDefault();
            alert("Inserisci un termine di ricerca");
        }
    });
});