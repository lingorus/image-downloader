<?php

namespace App\Db;

class Db {
    private static $db;

    private function __constructor()
    {
    }

    public static function getConnect()
    {
        $dbConfig = \App\Config\Config::getConfig()->getParam('db');
        return self::$db ? self::$db : self::$db = self::setConnect($dbConfig);
    }

    private static function setConnect($params)
    {
        $params['port'] = $params['port'] ? $params['port'] : '3306';
        return new \PDO('mysql:
            host=' . $params['host'] . ';port=' . $params['port'] . ';dbname=' . $params['db_name'] . ';charset=UTF8;',
            $params['user'],
            $params['password'],
            array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ));
    }
}
