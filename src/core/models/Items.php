<?php

namespace scr\core\models;

use src\services\Connect;

class Items
{


    public static function getItem($id = Null)
    {
        $db = Connect::getConnect();

        if (!$id) {
            $id = $_GET['item'];
        }
        $item = $db->query("SELECT `item`.*, `types`.`name` AS `types_name`, `stock`.`name` as `stock_name`  from `item` 
        LEFT JOIN `stock` on `item`.`in_stock` = `stock`.`id` LEFT JOIN `types` on `item`.`type` = `types`.`id` WHERE `item`.`id` = $id ");
        $itemData = mysqli_fetch_assoc($item);
        return ($itemData);
    }

    public static function getCategory($id = Null)
    {
        $db = Connect::getConnect();

        if (!$id) {
            $id = $_GET['type'];
        }
        $item = $db->query("SELECT * FROM `types` WHERE `types`.`id` = $id");
        $itemData = mysqli_fetch_assoc($item);
        return ($itemData);
    }

    public static function getItems()
    {
        $db = Connect::getConnect();
        $query = $db->query("SELECT `item`.*, `types`.`name` AS `type_name` 
        FROM `item` LEFT JOIN `types` ON `item`.`type` = `types`.`id` ");
        $itemsList = [];
        while ($item = mysqli_fetch_assoc($query)) {
            $itemsList[] = $item;
        }
        return ($itemsList);
    }

    public static function getCategories()
    {
        $db = Connect::getConnect();
        $query = $db->query("SELECT * from `types`");
        $typesList = [];
        while ($type = mysqli_fetch_assoc($query)) {
            $typesList[] = $type;
        }
        return ($typesList);
    }

    public static function getAllNews()
    {
        $db = Connect::getConnect();
        $query = $db->query("SELECT * from `news`");
        $newsList = [];
        while ($news = mysqli_fetch_assoc($query)) {
            $newsList[] = $news;
        }
        return ($newsList);
    }

    public static function getBanners()
    {
        $db = Connect::getConnect();
        $query = $db->query("SELECT * from `banner`");
        $bannersList = [];
        while ($banner = mysqli_fetch_assoc($query)) {
            $bannersList[] = $banner;
        }
        return ($bannersList);
    }

    public static function updateItem()
    {

        $db = Connect::getConnect();

        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $recommend = $_POST['recommend'];

        $db->query("UPDATE `item` SET `name`='$name',`price`='$price',
        `in_stock`='$stock',`description`='$description', `type`='$type', `recommend`='$recommend' WHERE `item`.`id`='$id'");

        if (mysqli_affected_rows($db) === 0) {
            $msg = 'update error';
            header("Location: /admin/item?item=$id&message=$msg");
        } else {
            $msg = 'update success';
            header("Location: /admin/item?item=$id&message=$msg");
        }
    }

    public static function updateType()
    {

        $db = Connect::getConnect();

        $id = $_POST['id'];
        $name = $_POST['name'];
        $popular = $_POST['popular'];
        $db->query("UPDATE `types` SET `name`='$name', `popular`='$popular' WHERE `types`.`id`='$id'");

        if (mysqli_affected_rows($db) === 0) {
            $msg = 'update error';
            header("Location: /admin/type?type=$id&message=$msg");
        } else {
            $msg = 'update success';
            header("Location: /admin/type?type=$id&message=$msg");
        }
    }

    public static function updateNews()
    {

        $db = Connect::getConnect();

        $id = $_POST['id'];
        $title = $_POST['title'];
        $text = $_POST['text'];
        $date = $_POST['date'];
        $db->query("UPDATE `news` SET `title`='$title', `text`='$text', `date`='$date' WHERE `news`.`id`='$id'");

        if (mysqli_affected_rows($db) === 0) {
            $msg = 'update error';
            header("Location: /admin/news?news=$id&message=$msg");
        } else {
            $msg = 'update success';
            header("Location: /admin/news?news=$id&message=$msg");
        }
    }

    public static function updateImageType()
    {
        $file = 'img/' . date('Ymdhis') . basename($_FILES['image']['name']);
        $uploadStatus = true;
        $id = $_POST['id'];
        print_r($_POST);
        $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg') {
            $uploadStatus = false;
            $message = 'Недопустимый тип файла';
            header("Location: /admin/type?type=$id&message=$message");
            return;
        }
        $item = Items::getCategory($id);
        if (!empty($item['image']))
            $hasImage = true;
        if ($hasImage)
            unlink(($_SERVER['DOCUMENT_ROOT'] . '/' . $item['image']));
        if ($uploadStatus) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                $db = Connect::getConnect();
                $db->query("UPDATE `types` SET `image`='$file' WHERE `types`.`id`='$id'");
                header("Location: /admin/type?type=$id");
            }
        } else {
            $message = 'Не удалось загрузить файл';
            header("Location: /admin/type?type=$id&message=$message");
        }
    }

    public static function updateImageNews()
    {
        $file = 'img/' . date('Ymdhis') . basename($_FILES['image']['name']);
        $uploadStatus = true;
        $id = $_POST['id'];
        print_r($_POST);
        $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg') {
            $uploadStatus = false;
            $message = 'Недопустимый тип файла';
            header("Location: /admin/item?item=$id&message=$message");
            return;
        }
        $item = Items::getNews($id);
        if (!empty($item['image']))
            $hasImage = true;
        if ($hasImage)
            unlink(($_SERVER['DOCUMENT_ROOT'] . '/' . $item['image']));
        if ($uploadStatus) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                $db = Connect::getConnect();
                $db->query("UPDATE `news` SET `image`='$file' WHERE `news`.`id`='$id'");
                header("Location: /admin/news?news=$id");
            }
        } else {
            $message = 'Не удалось загрузить файл';
            header("Location: /admin/news?news=$id&message=$message");
        }
    }

    public static function updateImage()
    {
        $file = 'img/' . date('Ymdhis') . basename($_FILES['image']['name']);
        $uploadStatus = true;
        $id = $_POST['id'];
        print_r($_POST);
        $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg') {
            $uploadStatus = false;
            $message = 'Недопустимый тип файла';
            header("Location: /admin/item?item=$id&message=$message");
            return;
        }
        $item = Items::getItem($id);
        if (!empty($item['image']))
            $hasImage = true;
        if ($hasImage)
            unlink(($_SERVER['DOCUMENT_ROOT'] . '/' . $item['image']));
        if ($uploadStatus) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                $db = Connect::getConnect();
                $db->query("UPDATE `item` SET `image`='$file' WHERE `item`.`id`='$id'");
                header("Location: /admin/item?item=$id");
            }
        } else {
            $message = 'Не удалось загрузить файл';
            header("Location: /admin/item?item=$id&message=$message");
        }
    }

    public static function addItem(){
        $db = Connect::getConnect();
        $name = $_POST['name'];
        $price = $_POST['price'];
        $in_stock = $_POST['stock'];
        $recommend = $_POST['recommend'];
        $description = $_POST['description'];
        $image = 'img/'.date('Ymdhis').basename($_FILES['FileUp']['name']);
        $type = $_POST['type'];
        if(move_uploaded_file($_FILES['FileUp']['tmp_name'], $image)){
            $add = $db->query("INSERT INTO `item`(`id`, `name`,  `price`, `in_stock`, `description`, `image`, `type`, `recommend`) 
            VALUES (NULL,'$name','$price','$in_stock','$description','$image','$type', '$recommend')");
            if (!$add) {
                $message = 'add error';
                header("Location: /admin?message=$message");
            } else {
                $message = 'add success';
                header("Location: /admin?message=$message");
            }
        }
    }

    public static function deleteItem()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $item = Items::getItem($id);
        if (!empty($item["image"]) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $item["image"])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $item["image"]);
        }
        $deleteItem = $db->query("DELETE from `item` WHERE `item`.`id`='$id'");
        if (mysqli_affected_rows($db) === 0) {
            $msg = 'delete error';
            header("Location: /admin?message=$msg");
        } else {
            $msg = 'delete success';
            header("Location: /admin?message=$msg");
        }
    }
    

    public static function deleteType()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $item = Items::getCategory($id);
        if (!empty($item["image"]) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $item["image"])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $item["image"]);
        }
        $deleteItem = $db->query("DELETE from `types` WHERE `types`.`id`='$id'");
        if (mysqli_affected_rows($db) === 0) {
            $msg = 'delete error';
            header("Location: /admin?message=$msg");
        } else {
            $msg = 'delete success';
            header("Location: /admin?message=$msg");
        }
    }
    
    public static function deleteNews()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $item = Items::getNews($id);
        if (!empty($item["image"]) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $item["image"])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $item["image"]);
        }
        $deleteItem = $db->query("DELETE from `news` WHERE `news`.`id`='$id'");
        if (mysqli_affected_rows($db) === 0) {
            $msg = 'delete error';
            header("Location: /admin?message=$msg");
        } else {
            $msg = 'delete success';
            header("Location: /admin?message=$msg");
        }
    }

    public static function getAllType($typeId = null){
    $db = Connect::getConnect();
    if (!$typeId) {
        $typeId = $_GET['type'];
    }

    // Экранируем значение
    $typeId = mysqli_real_escape_string($db, $typeId);
    $typeQuery = $db->query("SELECT `name` FROM `types` WHERE `id` = '$typeId'");
    $typeName = mysqli_fetch_assoc($typeQuery)['name'];

    // Получаем товары вместе с именем категории
    $query = $db->query("SELECT `item`.*, `types`.`name` as `type_name` FROM `item` 
    INNER JOIN `types` ON `item`.`type` = `types`.`id` WHERE `types`.`id` = '$typeId'");

    $itemsList = [];
    while ($item = mysqli_fetch_assoc($query)) {
        $itemsList[] = $item;
    }
    // Возвращаем массив с товарами и именем категории
    return [
        'items' => $itemsList,
        'type_name' => $typeName
    ];
}


public static function getNews($id = Null)
{
    $db = Connect::getConnect();

    if (!$id) {
        $id = $_GET['news'];
    }
    $item = $db->query("SELECT * FROM `news` WHERE `news`.`id` = $id");
    $itemData = mysqli_fetch_assoc($item);
    return ($itemData);
}

public static function getLatestNews()
{
    $db = Connect::getConnect();
    $query = $db->query("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 2");
    $newsList = [];
    while ($news = mysqli_fetch_assoc($query)) {
        $newsList[] = $news;
    }
    return $newsList;
}


public static function addNews(){
    $db = Connect::getConnect();
    $title = $_POST['title'];
    $text = $_POST['text'];
    $date = date('Y-m-d H:i:s');
    $image = 'img/'.date('Ymdhis').basename($_FILES['FileUp']['name']);
    if(move_uploaded_file($_FILES['FileUp']['tmp_name'], $image)){
        $add = $db->query("INSERT INTO `news`(`id`, `title`,  `date`, `text`, `image`) 
        VALUES (NULL,'$title','$date','$text', '$image')");
        if (!$add) {
            $message = 'add error';
            header("Location: /admin?message=$message");
        } else {
            $message = 'add success';
            header("Location: /admin?message=$message");
        }
    }
}
public static function addType(){
    $db = Connect::getConnect();
    $name = $_POST['name'];
    $popular = $_POST['popular'];
    $image = 'img/'.date('Ymdhis').basename($_FILES['FileUp']['name']);
    if(move_uploaded_file($_FILES['FileUp']['tmp_name'], $image)){
        $add = $db->query("INSERT INTO `types`(`id`, `name`, `popular`, `image`) 
        VALUES (NULL,'$name','$popular', '$image')");
        if (!$add) {
            $message = 'add error';
            header("Location: /admin?message=$message");
        } else {
            $message = 'add success';
            header("Location: /admin?message=$message");
        }
    }
}

public static function getPosts()
{
    $db = Connect::getConnect();
    $query = $db->query("SELECT posts.*, COUNT(comments.id) AS comment_count FROM posts 
    LEFT JOIN comments ON posts.id = comments.post GROUP BY posts.id ORDER BY posts.creation_date DESC");
    
    $postsList = [];
    while ($post = mysqli_fetch_assoc($query)) {
        $postsList[] = $post;
    }
    return $postsList;
}


public static function getForumStats()
{
    $db = Connect::getConnect();

    // Получение количества зарегистрированных пользователей
    $userCountResult = $db->query("SELECT COUNT(*) AS user_count FROM `users`");
    $userCount = mysqli_fetch_assoc($userCountResult)['user_count'];

    // Получение количества всех постов
    $postCountResult = $db->query("SELECT COUNT(*) AS post_count FROM `posts`");
    $postCount = mysqli_fetch_assoc($postCountResult)['post_count'];

    return [
        'userCount' => $userCount,
        'postCount' => $postCount,
    ];
}

public static function getPost($postId)
{
    $db = Connect::getConnect();
    
    $query = $db->query("SELECT posts.*, users.login AS author_login FROM posts LEFT JOIN users 
    ON posts.author = users.id WHERE posts.id = $postId LIMIT 1");
    
    $post = mysqli_fetch_assoc($query);
    return $post;
}

public static function getCommentsByPost($postId)
{
    $db = Connect::getConnect();
    
    $query = $db->query("SELECT comments.date, comments.text, users.login AS user_login FROM comments 
    LEFT JOIN users ON comments.user = users.id WHERE comments.post = $postId ORDER BY comments.date ASC");
    
    $comments = [];
    while ($comment = mysqli_fetch_assoc($query)) {
        $comments[] = $comment;
    }
    
    return $comments;
}

public static function addPost()
{
    $db = Connect::getConnect();
    
    $title = $_POST['title'];
    $text = $_POST['text'];
    $author = $_POST['author'];
    $creation_date = $_POST['creation_date'];
    $image = 'img/'.date('Ymdhis').basename($_FILES['FileUp']['name']);
    if(move_uploaded_file($_FILES['FileUp']['tmp_name'], $image)){
        $add = $db->query("INSERT INTO `posts`(`id`, `title`, `text`, `author`, `creation_date`, `image`) 
        VALUES (NULL, '$title', '$text', '$author', '$creation_date', '$image')");
        if (!$add) {
            $message = 'add error';
            header("Location: /forum?message=$message");
        } else {
            $message = 'add success';
            header("Location: /forum?message=$message");
        }
    }
}

public static function postComment()
{
    $db = Connect::getConnect();

    // Получаем данные из формы
    $post_id = (int)$_POST['post_id']; // ID поста
    $comment_text = mysqli_real_escape_string($db, $_POST['comment_text']); // Текст комментария

    // Получаем ID пользователя из сессии
    session_start();
    if (!isset($_SESSION['user_id'])) {
        $message = 'Вы должны быть авторизованы, чтобы оставить комментарий.';
        header("Location: /login?message=$message");
        exit;
    }
    $user_id = (int)$_SESSION['user_id'];

    // Генерируем текущую дату
    $current_date = date('Y-m-d');

    // Сохраняем комментарий в базе данных
    $query = "
        INSERT INTO `comments` (`post`, `user`, `date`, `text`)
        VALUES ($post_id, $user_id, '$current_date', '$comment_text')
    ";
    $result = $db->query($query);

    if (!$result) {
        $message = 'Ошибка при добавлении комментария.';
        header("Location: /post?post=$post_id&message=$message");
    } else {
        $message = 'Комментарий успешно добавлен.';
        header("Location: /post?post=$post_id&message=$message");
    }
    exit;
}

public static function deletePost()
{
    $db = Connect::getConnect();
    $id = $_POST['id'];

    $item = Items::getPost($id);

    // Удаление изображения, если есть
    if (!empty($item["image"]) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $item["image"])) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $item["image"]);
    }

    // Сначала удалим все комментарии, связанные с постом
    $db->query("DELETE FROM `comments` WHERE `post` = '$id'");

    // Затем удаляем сам пост
    $deleteItem = $db->query("DELETE FROM `posts` WHERE `id` = '$id'");

    if (mysqli_affected_rows($db) === 0) {
        $msg = 'delete error';
        header("Location: /forum?message=$msg");
    } else {
        $msg = 'delete success';
        header("Location: /forum?message=$msg");
    }
}


public static function updatePost()
{

    $db = Connect::getConnect();

    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $redact_date = $_POST['redact_date'];

    $db->query("UPDATE `posts` SET `title`='$title',`text`='$text',
    `redact_date`='$redact_date' WHERE `posts`.`id`='$id'");

    if (mysqli_affected_rows($db) === 0) {
        $msg = 'update error';
        header("Location: /post/redact?id=$id&message=$msg");
    } else {
        $msg = 'update success';
        header("Location: /post/redact?id=$id&message=$msg");
    }
}

public static function updateImagePost()
{
    $file = 'img/' . date('Ymdhis') . basename($_FILES['image']['name']);
    $uploadStatus = true;
    $id = $_POST['id'];
    print_r($_POST);
    $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg') {
        $uploadStatus = false;
        $message = 'Недопустимый тип файла';
        header("Location: /post/redact?id=$id&message=$message");
        return;
    }
    $item = Items::getPost($id);
    if (!empty($item['image']))
        $hasImage = true;
    if ($hasImage)
        unlink(($_SERVER['DOCUMENT_ROOT'] . '/' . $item['image']));
    if ($uploadStatus) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
            $db = Connect::getConnect();
            $db->query("UPDATE `posts` SET `image`='$file' WHERE `posts`.`id`='$id'");
            header("Location: /post/redact?id=$id");
        }
    } else {
        $message = 'Не удалось загрузить файл';
        header("Location: /post/redact?id=$id&message=$message");
    }
}
public static function makeOrder()
{
    $db = Connect::getConnect();
    session_start();
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $total = $_POST['totalprice'];
    $orderdata = json_decode($_POST['orderdata'], true);

    $userId = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : "NULL";

    $query = "INSERT INTO `orders` (`user_id`, `phone`, `fullname`, `totalprice`) 
              VALUES (" . ($userId === "NULL" ? "NULL" : $userId) . ", '$phone', '$fullname', '$total')";

    $db->query($query);

    $orderId = mysqli_insert_id($db);

    foreach ($orderdata as $itemId => $quantity) {
        $db->query("INSERT INTO `order_items` (`order_id`, `item_id`, `quantity`) 
                    VALUES ('$orderId', '$itemId', '$quantity')");
    }

    header("Location: /thankyou");
}
public static function getAllOrdersWithDetails() {
    $db = Connect::getConnect();

    $query = "
        SELECT 
            orders.id AS order_id,
            orders.phone,
            orders.status,
            orders.fullname,
            orders.totalprice,
            orders.user_id,
            users.email AS user_email
        FROM orders
        LEFT JOIN users ON orders.user_id = users.id
        ORDER BY orders.id DESC
    ";

    $result = $db->query($query);
    $orders = [];

    while ($order = $result->fetch_assoc()) {
        $orderId = $order['order_id'];

        $itemsResult = $db->query("
            SELECT item.name, order_items.quantity 
            FROM order_items 
            INNER JOIN item ON order_items.item_id = item.id 
            WHERE order_items.order_id = $orderId
        ");

        $itemDetails = [];
        while ($item = $itemsResult->fetch_assoc()) {
            $itemDetails[] = $item['name'] . ' ×' . $item['quantity'];
        }

        $order['items'] = $itemDetails;
        $orders[] = $order;
    }

    return $orders;
}


public static function updateStatus(){
    $db = Connect::getConnect();
    $id = $_POST['id'];
    $status = $_POST['status'];
    $update = $db -> query("UPDATE `orders` SET `status`='$status' WHERE `orders`.`id`='$id'");
    if(!$update){
        header("Location: /admin?msg=updateError");
        die();
    }
    else{
        header("Location: /admin?msg=updateSuccess");
        die();
    }
}
}