<?php
namespace src\core\controllers;
class Controller{
    public static $pagesList = [];
    public static function view($url, $pageName)
    {
        self::$pagesList[] = [
            'url' => $url,
            'pageName' => $pageName
        ];
    }
    public static function myPost($url, $class, $method)
    {
        self::$pagesList[] = [
            'url' => $url,
            'class' => $class,
            'method' => $method
        ];
    }
    public static function getContents()
    {
        $rout = $_GET['rout'] ?? '';
        foreach (self::$pagesList as $val) {
            if ($val['url'] === '/' . $rout) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    switch ($val['url']) {
                        case '/updateItem':
                        case '/updateImage':
                        case '/updateType':
                        case '/updateImageType':
                        case '/addItem':
                        case '/deleteItem':
                        case '/deleteType':
                        case '/registration/add':
                        case '/login/get':
                        case '/quit':
                        case '/updateUserPassword':
                        case '/updateUserData':
                        case '/addNews':
                        case '/addType':
                        case '/updateNews':
                        case '/updateImageNews':
                        case '/deleteNews':
                        case '/addPost':
                        case '/postComment':
                        case '/deletePost':
                        case '/updatePost':
                        case '/updateImagePost':
                        case '/makeOrder':
                        case '/updateStatus':
                            $class = new $val['class'];
                            $method = $val['method'];
                            $class->$method();
                            break;
                    }
                } else {
                    require_once __DIR__ . '/../views/' . $val['pageName'] . '.php';
                    die();
                }
            }
        }
    }
}