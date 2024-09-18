document.addEventListener('DOMContentLoaded', function () {
    var removeProduct = document.getElementById("removeProduct");

    removeProduct.addEventListener('click', function (event) {
        var searchQuery = prompt("Enter the product name you want to remove:");
        if (searchQuery != null)
            window.location.href = "../search.php?category=" + searchQuery + "&remove=true";
    });
});