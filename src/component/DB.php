<?php

namespace App\Component;

use PDO;
use PDOException;

class DB
{
    private static PDO $db;

    private function __construct() {}

    public static function getConnection() : PDO {
        if (empty(self::$db)) {
            $config = yaml_parse_file(__DIR__ . '/../../db_config.yaml');
            $missed = array_diff(['host', 'dbname', 'user', 'password'], array_keys($config));
            if (!empty($missed)) {
                $missed = implode(', ', $missed);
                echo "You forget to add $missed into db_config.yaml";
                exit();
            }

            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};chartset=utf8";
            try {
                $opt = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ];
                self::$db = new PDO($dsn, $config['user'], $config['password'], $opt);

            } catch (PDOException $e) {
                echo "DB error: " . $e->getMessage();
                exit();
            }
        }
        return self::$db;
    }
}