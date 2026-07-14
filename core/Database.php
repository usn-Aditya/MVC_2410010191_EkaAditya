<?php

class Database {
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            require_once '../config/database.php';
            self::$conn = getConnection();
        }
        return self::$conn;
    }
}
