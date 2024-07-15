function getCartCookie() {
    var cookies = document.cookie.split(';').map(cookie => decodeURIComponent(cookie.trim()));
    var cartCookie = cookies.find(cookie => cookie.startsWith('cart='));
    return cartCookie;
}

function addToCart(gameName) {
    // Get the cart cookie
    var cartCookie = getCartCookie();
    var cart;
    // If the cartCookie is already set there is something already in the cart and the new game needs to be added
    if(cartCookie) {
        cart = decodeURIComponent(cartCookie.split('=')[1]).split(',');
        if(cart.length >= 10) {// Cart can't have more than 10 games
            alert('Il carrello non può contenere più di 10 prodotti');
            return false;
        }
        cart.push(gameName);
    }
    // If the cartCookie is not set it needs to be created
    else
        cart = [gameName];
    var expires = new Date();
    expires.setTime(expires.getTime() + 1000*60*60*24*4); // Cookie expires in 4 days
    document.cookie = 'cart=' + encodeURIComponent(cart.join(',')) + ';expires=' + expires.toUTCString() + ';path=/';
    return true;
}

function removeFromCart(gameName) {
    // Get the cart cookie
    var cartCookie = getCartCookie();
    var cart = decodeURIComponent(cartCookie.split('=')[1]).split(',');
    // If the cart has only one game remove the cookie
    if(cart.length == 1)
        document.cookie = 'cart=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/';
    // Else Remove the game from the cart
    else {
        cart = cart.filter(game => game != gameName);
        var expires = new Date();
        expires.setTime(expires.getTime() + 1000*60*60*24*4); // Cookie expires in 4 days
        document.cookie = 'cart=' + encodeURIComponent(cart.join(',')) + ';expires=' + expires.toUTCString() + ';path=/';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var cartIcons = document.querySelectorAll('.shoppingCart');
    var headerCart = document.getElementById('headerCart');

    cartIcons.forEach(function(cartIcon) {
        // If the icon is a cart turn it into a checkmark and add item to cookie
        cartIcon.addEventListener('click', function() {
            if(this.className == "fa-solid fa-cart-shopping shoppingCart") {
                if(addToCart(this.id)) {// Game name is saved in the icon id
                    this.className = "fa-solid fa-check shoppingCart";
                    this.style.color = "green";
                    this.setAttribute('aria-label', 'Rimuovi dal carrello');
                    // Update the cart icon in the header
                    var cartClass = headerCart.className;
                    if(cartClass == "fa-solid fa-cart-shopping fa-lg") // cart is empty
                        headerCart.className = "fa-solid fa-1 fa-lg";
                    else
                        headerCart.className = cartClass.replace(/(fa-)(\d+)/, (match, p1, p2) => p1 + (parseInt(p2) + 1));
                }
            }
            // If the icon is a checkmark turn it into a cart
            else {
                removeFromCart(this.id); // Game name is saved in the icon id
                this.className = "fa-solid fa-cart-shopping shoppingCart";
                this.style.color = "black";
                this.setAttribute('aria-label', 'Aggiungi al carrello');
                // Update the cart icon in the header
                var cartClass = headerCart.className;
                if(cartClass == "fa-solid fa-1 fa-lg") // cart has only one item
                    headerCart.className = "fa-solid fa-cart-shopping fa-lg";
                else
                    headerCart.className = cartClass.replace(/(fa-)(\d+)/, (match, p1, p2) => p1 + (parseInt(p2) - 1));
            }
        });
    });
});