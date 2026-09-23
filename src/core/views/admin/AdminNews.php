<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/reset.css" />
    <link rel="stylesheet" href="/css/style.css" />
    <title>ХоббиХаб</title>
</head>
<body>
    <?
    use src\core\models\Users;
    if (isset($_SESSION['user_id'])) {
        $user = Users::getUser($_SESSION['user_id']);
    }
    if ($user['role'] === 'user' or empty($_SESSION['user_id'])) {
        header("Location: /");
    }
    ?>
    <header>
        <a href="/"><img id="logo" src="/svg/GuitarLogo.svg" alt="Логотип"></a>
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
                <img src="/svg/cart.svg">
                <p>Корзина</p>
              </a>
        </div>
    </header>

    <main>
        <?
        use scr\core\models\Items;
        $newsdata = Items::getLatestNews();
        ?>
      <h1 class="maintext">Админ-панель</h1>
      <div class="admin-list">
        <a href="/admin" class="admin-item">Все заказы</a>
        <a href="/admin/items" class="admin-item">Управление товарами</a>
        <a href="/admin/types" class="admin-item">Управление категориями</a>
        <a href="/admin/allnews" class="admin-item">Управление новостями</a>
      </div>

            <form action="/addNews" method="post" class="admin-add-item-form" enctype="multipart/form-data">
              <h1 style="font-size:30px">Добавить Новость</h1>
              <label for="title">Заголовок:</label>
              <input type="text" name="title" id="title" required>
              <label for="text">Текст новости:</label>
              <textarea name="text" id="text" rows="5" required></textarea>
              <label for="image">Изображение:</label>
              <input type="file" name="FileUp" id="FileUp"  required>
              <button type="submit" style="margin-top:30px">Добавить Новость</button>
          </form>

        <h1 class="maintext">Все новости</h1>
        <div class="admin-list">
        <?
        foreach ($newsdata as $news) { ?>
            <a class="admin-item" href="/admin/news?news=<?= $news['id'] ?>">
                <?= $news['title'] ?>
            </a>
        <? } ?>
        </div>
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
        <a href=""><img src="/svg/soc1.svg"></a>
        <a href=""><img src="/svg/soc2.svg"></a>
        <a href=""><img src="/svg/soc3.svg"></a>
        <a href=""><img src="/svg/soc4.svg"></a>
      </div>
    </div>
  </footer>
    <script src="/js/dot.js"></script>
</body>
</html>
