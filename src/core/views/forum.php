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
    <?
        use scr\core\models\Items;
        $forumStats = Items::getForumStats();
        $posts = Items::getPosts();
    ?>
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
<main>

    <h1 class="maintext">Форум</h1>
    <div class="forum-container">
      <div class="forum-main">
        <div class="forum-title">
          <p>Тема</p>
          <div class="forum-title-right">
            <p>Ответов</p>
            <p>Создано</p>
          </div>
        </div>
        <?php
        if (isset($_SESSION['user_id'])) {
            $user = Users::getUser($_SESSION['user_id']); // Получаем данные текущего пользователя
        }

        foreach ($posts as $post) { ?>
            <div class="forum-post">
                <a href="/post?post=<?= $post['id'] ?>"><img class="forum-image" src="<?= $post['image'] ?>"></a>
                <div class="forum-textbox">
                    <a class="forum-text-title" href="/post?post=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    <p class="forum-text"><?= $post['text'] ?></p>
                </div>
                <div class="forum-post-numbers">
                    <p><?= $post['comment_count'] ?></p>
                    <p><?= $post['creation_date'] ?></p>
                </div>
            </div>
                
                <?php 
                // Проверяем, может ли пользователь управлять постом
                if (isset($user) && ($user['role'] === 'admin' || $user['id'] === $post['author'])) { ?>
                  <div>
                        <a href="/post/redact?id=<?= $post['id'] ?>" class="header-cart-button" style="border: 1px solid rgba(0, 0, 0, 0.2)">Изменить</a>
                        <form action="/deletePost" method="post" >
                            <input type="hidden" name="id" value="<?= $post['id'] ?>">
                            <button type="submit" class="header-cart-button" style="border: 1px solid rgba(0, 0, 0, 0.2)">Удалить</button>
                        </form>
                        </div>
                <?php } ?>
        <?php } ?>



      </div>

      <div class="forum-panel">
        <div class="forum-counter first"><?= $forumStats['userCount'] ?> участников</div>
        <div class="forum-counter last"><?= $forumStats['postCount'] ?> постов</div>
        <div class="forum-postbutton">
            <? if (isset($_SESSION['user_id'])) {?>
               <a href="/post/create" class="logged">
                Создать пост
              </a>
            <?} else{?>
              Для создания поста войдите в свой аккаунт
              <?}?>
            </div>
      </div>
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
