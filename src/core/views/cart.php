<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>ХоббиХаб</title>
</head>
<body>
  <?
    use src\core\models\Users;

    if (isset($_SESSION['user_id'])) {
      $user = Users::getUser($_SESSION['user_id']);
      
    }
  ?>
    <header>
        <a href="/"><img id="logo" src="svg/GuitarLogo.svg" alt="Логотип"></a>
        <nav>
          <a href="/catalog">Каталог</a>
          <a href="/forum">Форум</a>
          <a href="/newslist">Новости</a>
          <?
            if (!empty($user) && $user['role'] === 'admin') { ?>
              <a href="/admin" style="color: #53A2BE">Админ панель</a>
            <? }
          ?>
        </nav>
        <div class="header-right">
            <?
            session_start();
            if (isset($_SESSION['user_id'])) {?>
               <a href="/profile" class="logged">
                <?=$user['login']?>
              </a>
            <?} else{?>
                <a href="/login" class="header-login-button"> Войти </a>
              <?}?>
            <div id="divider"></div>
              <a href="/cart" class="header-cart-button">
                <img src="svg/cart.svg">
                <p>Корзина</p>
              </a>
        </div>
    </header>
  <?
  use scr\core\models\Items;

  $items = Items::getItems();
  ?>
<main>

  <h1 class="maintext">Корзина</h1>
  <div class="cart-main" id="cart-container"></div>
  
  <div class="cart-bottom">
    <p>Сумма заказа:</p>
    <span class="total-price">0 р.</span>
  </div>
  
  <form class="cart-form" action="/makeOrder" method="post" onsubmit="return prepareOrderData();">
  <div class="cart-form-box">
    <p class="cart-form-text">Пожалуйста, введите вашу контактную информацию, чтобы мы с вами связались</p>
    <div class="cart-form-input-box">
      <input class="cart-form-input" name="fullname" placeholder="Ваше ФИО" required>
      <input class="cart-form-input" type="tel" name="phone" placeholder="Номер телефона" required>
    </div>
    <input type="hidden" name="totalprice" id="order-total">
    <input type="hidden" name="orderdata" id="orderdata">
  </div>
  <button type="submit" class="cart-form-button">Оформить заказ</button>
</form>

</main>
<footer>
    <div class="footer-section1">
      <h2>Контакты</h2>
      <div id="dividerfooter1"></div>
      <div class="footer-section-text">
        <p>+7 (960) 765-67-99</p>
        <p>info@hobbyhub.ru</p>
      </div>
    </div>
    <div class="footer-section2">
      <h2>Разделы</h2>
      <div id="dividerfooter2"></div>
      <div class="footer-section-text">
        <a href="/">‣ Главная</a>
        <a href="/catalog">‣ Каталог</a>
        <a href="/cart">‣ Корзина</a>
        <a href="/forum">‣ Форум</a>
        <a href="/newslist">‣ Новости</a>
      </div>
    </div>
    <div class="footer-section1">
      <h2>Соцсети</h2>
      <div id="dividerfooter1"></div>
      <div class="footer-images">
        <a href=""><img src="svg/soc1.svg"></a>
        <a href=""><img src="svg/soc2.svg"></a>
        <a href=""><img src="svg/soc3.svg"></a>
        <a href=""><img src="svg/soc4.svg"></a>
      </div>
    </div>
  </footer>
  <script>
    function prepareOrderData() {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
    const totalPriceText = document.querySelector('.total-price').textContent;
    const totalPrice = parseInt(totalPriceText.replace(/\D/g, '')) || 0;

    document.getElementById('order-total').value = totalPrice;
    document.getElementById('orderdata').value = JSON.stringify(cartItems);

    return true; // разрешить отправку формы
}
  // Функция для обновления цен на странице оформления заказа
function updateCheckoutPrices() {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
    const items = <?php echo json_encode($items); ?>;

    // Получаем элемент для отображения суммы заказа
    const sumElement = document.querySelector('.total-price');

    // Рассчитываем сумму заказа
    let sum = 0;
    for (const itemId in cartItems) {
        if (cartItems.hasOwnProperty(itemId)) {
            const quantity = cartItems[itemId];
            const item = items.find(item => item.id === itemId.toString());
            if (item) {
                const price = item.price;
                sum += price * quantity;
            }
        }
    }

    // Обновляем отображаемую сумму заказа
    sumElement.textContent = sum.toFixed(2).replace('.00', '') + ' р.';
}

function displayCartItems() {
    // Получаем данные о товарах из локального хранилища
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
    console.log('Данные из локального хранилища:', cartItems);

    // Получаем список всех товаров
    const items = <?php echo json_encode($items); ?>;
    console.log('Данные из БД:', items);

    // Находим контейнер для корзины
    const cartContainer = document.getElementById('cart-container');

    // Генерируем HTML для товаров в корзине
    let cartHTML = '';
    if (Object.keys(cartItems).length === 0) {
        // Если корзина пуста, добавляем сообщение "Пусто"
        cartHTML = '<p style="font-size: 40px; align-self:center;">Пусто</p>';
    } else {
        for (const itemId in cartItems) {
            if (cartItems.hasOwnProperty(itemId)) {
                const quantity = cartItems[itemId];
                // Находим товар по ID
                const item = items.find(item => item.id === itemId.toString());
                if (item) {
                    // Рассчитываем цену товара с учетом количества
                    const price = item.price;
                    const totalPrice = (price * quantity).toFixed(2); // Округляем до двух знаков после запятой
                    // Формируем HTML для товара
                    cartHTML += `
                        <div class="cart-item-box" data-product-id="${item.id}">
                            <a class="cart-image-bg" href="/item?item=${item.id}">
                                <img class="cart-image" src="${item.image}">
                            </a>
                            <div class="cart-content">
                            <a href="/item?item=${item.id}" class="cart-name">${item.name}</a>
                            <p class="cart-price">${totalPrice.replace('.00', '')} р.</p>
                                  <div class="counter" data-product-id="${item.id}">
                                      <button class="minus">-</button>
                                      <div class="number">${quantity}</div>
                                      <button class="plus">+</button>
                                  </div>
                              </div>
                                  <img src="svg/cross.svg" style="cursor: pointer;" class="remove-item"/>
                        </div>`;
                }
            }
        }
    }

    // Вставляем сгенерированный HTML для товаров в корзине в контейнер корзины
    cartContainer.innerHTML = cartHTML;

    // Назначаем обработчики событий для кнопок плюс и минус
    const minusButtons = document.querySelectorAll('.minus');
    const plusButtons = document.querySelectorAll('.plus');

    minusButtons.forEach(minusButton => {
        minusButton.addEventListener('click', (event) => {
            const productId = event.target.closest('.counter').getAttribute('data-product-id');
            updateCartItem(productId, -1);
        });
    });

    plusButtons.forEach(plusButton => {
        plusButton.addEventListener('click', (event) => {
            const productId = event.target.closest('.counter').getAttribute('data-product-id');
            updateCartItem(productId, 1);
        });
    });

    // Назначаем обработчик события для удаления товара из корзины
    const removeButtons = document.querySelectorAll('.remove-item');
    removeButtons.forEach(removeButton => {
        removeButton.addEventListener('click', (event) => {
            const productId = event.target.closest('.cart-item-box').getAttribute('data-product-id');
            removeCartItem(productId);
            displayCartItems(); // После удаления товара обновляем отображение корзины
        });
    });

    updateCheckoutPrices(); // После отображения товаров обновляем цены на странице оформления заказа
}

// Функция для удаления товара из корзины
function removeCartItem(productId) {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
    delete cartItems[productId];
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    updateCheckoutPrices(); // После удаления товара обновляем цены на странице оформления заказа
}

// Функция для обновления количества товара в корзине
function updateCartItem(productId, change) {
    const cartItems = JSON.parse(localStorage.getItem('cartItems')) || {};
    cartItems[productId] = Math.max(0, (cartItems[productId] || 0) + change);
    localStorage.setItem('cartItems', JSON.stringify(cartItems));
    displayCartItems(); // После обновления количества товара обновляем отображение корзины
}

// Вызываем функцию отображения товаров в корзине при загрузке страницы
document.addEventListener('DOMContentLoaded', displayCartItems);

var cartItems = localStorage.getItem("cartItems");
var cartDot = document.getElementById("cart-dot");

if (cartItems && cartItems.length > 0 && cartDot) {
    cartDot.style.display = "block";
} else {
    if (cartDot) {
        cartDot.style.display = "none";
    }
}
</script>
<script src="/js/dot.js"></script>
</body>
</html>
