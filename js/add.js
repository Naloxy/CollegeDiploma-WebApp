function addToCart(productId) {
    var cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
    cartItems[productId] = cartItems[productId] || 0;
    cartItems[productId]++;
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    showCounter(productId);
    console.log('Товар с ID ' + productId + ' добавлен в корзину.');
    console.log('Текущее состояние корзины:', cartItems);
}

    function updateCounterDisplay(productId) {
        var numberDisplay = document.getElementById(productId);
        if (numberDisplay) {
            var cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
            var count = cartItems[productId] || 0;
            numberDisplay.textContent = count;
        }
    }

    function showCounter(productId) {
        var counterContainer = document.querySelector('.counterContainer[data-product-id="' + productId + '"]');
        if (counterContainer) {
            var addToCartBtn = counterContainer.previousElementSibling;
            counterContainer.style.display = 'flex';
            addToCartBtn.style.display = 'none';
            updateCounterDisplay(productId);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        var cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
        for (var productId in cartItems) {
            if (cartItems.hasOwnProperty(productId)) {
                showCounter(productId);
            }
        }

        var counters = document.querySelectorAll('.counterContainer');
        counters.forEach(function(counter) {
            var productId = counter.getAttribute('data-product-id');
            var minusButton = counter.querySelector('.minus');
            var plusButton = counter.querySelector('.plus');
            var numberDisplay = counter.querySelector('.number');

            minusButton.addEventListener('click', function() {
                updateCartItem(productId, -1, numberDisplay);
            });

            plusButton.addEventListener('click', function() {
                updateCartItem(productId, 1, numberDisplay);
            });

            updateCounterDisplay(productId);
        });

        function updateCartItem(productId, change, display) {
            var cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
            cartItems[productId] = Math.max(0, (cartItems[productId] || 0) + change);
            display.textContent = cartItems[productId];
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
            if (cartItems[productId] === 0) {
                var counterContainer = document.querySelector('.counterContainer[data-product-id="' + productId + '"]');
                var addToCartBtn = counterContainer.previousElementSibling;
                counterContainer.style.display = 'none';
                addToCartBtn.style.display = 'block';
                delete cartItems[productId];
                localStorage.setItem('cartItems', JSON.stringify(cartItems));
            }
            console.log('Товар с ID ' + productId + ' обновлен в корзине.');
            console.log('Текущее состояние корзины:', cartItems);
        }
    });