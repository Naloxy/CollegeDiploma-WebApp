var cartItems = localStorage.getItem("cartItems");
    var cartDot = document.getElementById("cart-dot");

    if (cartItems && cartItems.length > 0 && cartDot) {
      cartDot.style.display = "block";
    } else {
      if (cartDot) {
        cartDot.style.display = "none";
      }
    }