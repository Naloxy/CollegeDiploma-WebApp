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

        $type = Items::getCategory();
        ?>
        <a href="/admin/types"><h1 class="maintext" style="color:RED">Обратно</h1></a>
            <div class="admin-item-container">
                <form action="/updateImageType" method="post" enctype="multipart/form-data" class="admin-cover-form">
                    <p>Изображение</p>
                    <img class="img-container" src="/<?= $type['image'] ?>" alt="Изображения нет">
                    <input type="file" name="image" id="">
                    <input type="hidden" name="id" value="<?= $type['id'] ?>">
                    <button type="submit" class="button">Изменить обложку</button>
                </form>

                <form action="/updateType" method="post" class="admin-game-form">
                    <p>ID</p>
                    <input type="text" name="" disabled id="" value="<?= $type['id'] ?>">
                    <input type="hidden" name="id" value="<?= $type['id'] ?>">
                    <p>Название</p>
                    <input type="text" name="name" id="" value="<?= $type['name'] ?>">
                    <p for="popular">Разместить на главной:</p>
                    <select id="popular" name="popular">
                      <option value="0" <?= $type['popular'] == 0 ? 'selected' : '' ?>>Нет</option>
                      <option value="1" <?= $type['popular'] == 1 ? 'selected' : '' ?>>Да</option>
                    </select><br><br>
                    <button type="submit" style="background-color:#53A2BE; color:white; border:none">Изменить</button>
                </form>
                <form action="/deleteType" method="post">
                    <input type="hidden" name="id" value="<?= $type['id'] ?>">
                    <button type="submit" style="background-color:red; color:white; border:none">Удалить категорию</button>
                </form>
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
