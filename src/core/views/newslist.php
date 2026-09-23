<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
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
        $newsdata = Items::getAllNews();
    ?>
<main>

    <h1 class="maintext">Новости</h1>
    <div class="latestnews">
      <?foreach ($newsdata as $news){ ?>
        <a href="/news?news=<?= $news['id'] ?>" class="container-news">
          <img src="<?= $news['image'] ?>" class="image-news">
          <p class="date-news"><?= $news['date'] ?></p>
          <p class="text-news"><?= $news['title'] ?></p>    
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
        <a href=""><img src="svg/soc1.svg"></a>
        <a href=""><img src="svg/soc2.svg"></a>
        <a href=""><img src="svg/soc3.svg"></a>
        <a href=""><img src="svg/soc4.svg"></a>
      </div>
    </div>
  </footer>
    <script src="/js/dot.js"></script>
</body>
</html>
