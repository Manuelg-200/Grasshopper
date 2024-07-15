document.addEventListener('DOMContentLoaded', function() {
    var removeButtons = document.querySelectorAll('.removeButton');
    var payButton = document.querySelector('.paymentButton');

    removeButtons.forEach(function(removeButton) {
        removeButton.addEventListener('click', function() {
            var gameName = this.id;
            var cookies = document.cookie.split(';').map(cookie => decodeURIComponent(cookie.trim()));
            var cartCookie = cookies.find(cookie => cookie.startsWith('cart='));
            cart = decodeURIComponent(cartCookie.split('=')[1]).split(',');
            if(cart.length == 1)
                document.cookie = 'cart=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/';
            else {
                cart = cart.filter(game => game != gameName);
                var expires = new Date();
                expires.setTime(expires.getTime() + 1000*60*60*24*4); // Cookie expires in 4 days
                document.cookie = 'cart=' + encodeURIComponent(cart.join(',')) + ';expires=' + expires.toUTCString() + ';path=/';
            }
            location.reload();
        });
    });

    payButton.addEventListener('click', function() {
        document.cookie = 'cart=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/';
        alert('Pagamento effettuato con successo!');
        alert('Non hai immesso nessun dato di pagamento? Non preoccuparti, i nostri operativi sono venuti a prendere il denaro di persona (senza farsi vedere)!');
        location.href = '../index.php';
    });
});