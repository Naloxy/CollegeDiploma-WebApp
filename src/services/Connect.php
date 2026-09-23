<?php

namespace src\services;

class Connect
{
    public static function getConnect()
    {
        $db = mysqli_connect(
            "127.0.0.1:3306",
            "root",
            "",
            "collection"
        );
        if (!$db) {
            echo "Connection error";
        } else {
            return $db;
        }
    }
}