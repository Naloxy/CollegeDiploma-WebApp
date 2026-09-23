<?php
namespace src\core\models;
use src\services\Connect;
class Users
{

    public static function login()
{
    $db = Connect::getConnect();
    $identifier = trim($_POST['email']); 
    $password = trim($_POST['password']);

    $stmt = $db->prepare("SELECT `id`, `password` FROM `users` WHERE `email` = ? OR `login` = ? LIMIT 1");
    if (!$stmt) {
        error_log("Ошибка подготовки запроса: " . $db->error);
        header("Location: /login?message=Ошибка сервера");
        exit();
    }
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: /");
            exit();
        } else {
            $message = 'Неверный пароль';
            header("Location: /login?message=$message");
            exit();
        }
    } else {
        $message = 'Пользователь не найден';
        header("Location: /login?message=$message");
        exit();
    }
}

    public static function registration(){
    $db = Connect::getConnect();
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $login = trim($_POST['login']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO `users` (`email`, `password`, `login`) VALUES (?, ?, ?)");
    if (!$stmt) {
        error_log("Ошибка подготовки запроса: " . $db->error);
        header("Location: /registration?message=Ошибка сервера");
        exit();
    }

    $stmt->bind_param("sss", $email, $hashedPassword, $login);

    if ($stmt->execute()) {
        session_start();
        $id = $stmt->insert_id;
        $_SESSION['user_id'] = $id;

        header("Location: /");
        exit();
    } else {
        error_log("Ошибка выполнения запроса: " . $stmt->error);
        $message = 'Ошибка регистрации';
        header("Location: /registration?message=$message");
        exit();
    }
    }


    public static function getUser($id = Null){
        if (!$id){
            $id = $_SESSION['user_id'];
        }
        $db = Connect::getConnect();
        $query = $db -> query("SELECT * from `users` WHERE `users`.`id` = '$id'");
        $user = mysqli_fetch_assoc($query);
        return $user;
    }

    public static function quit(){
        session_start();
        session_unset();
        session_destroy();
        header("Location: /");
    }

public static function updateUserData(){
    $db = Connect::getConnect();
    $id = $_SESSION['user_id'];
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
    $login = htmlspecialchars(trim($_POST['login']), ENT_QUOTES, 'UTF-8');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /profile?message=Некорректный email");
        exit();
    }
    $update = $db -> query("UPDATE `users` SET `login`='$login',`email`='$email' WHERE `users`.`id`='$id'");
    if (!$update) {
        $message = "Ошибка обновления данных";
    } else {
        $message = "Данные успешно обновлены";
    }
    header("Location: /profile?message=$message");
    exit();
}


public static function updateUserPassword(){
    $db = Connect::getConnect();
    $id = (int)$_POST['id'];
    $newPassword = htmlspecialchars(trim($_POST['newpassword']), ENT_QUOTES, 'UTF-8');
    $oldPassword = htmlspecialchars(trim($_POST['oldpassword']), ENT_QUOTES, 'UTF-8');
    $user = Users::getUser($id);
    if (!$user) {
        header("Location: /profile?message=Пользователь не найден");
        exit();
    }
    if (!password_verify($oldPassword, $user['password'])) {
        header("Location: /profile?message=Неверный старый пароль");
        exit();
    }

    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
    $stmt = $db->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");
    $stmt->bind_param("si", $hashedPassword, $id);
    if ($stmt->execute()) {
        $message = 'Пароль успешно обновлён';
    } else {
        $message = 'Ошибка обновления пароля';
    }
    $stmt->close();
    header("Location: /profile?message=$message");
    exit();
}   

}