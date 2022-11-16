<?php

namespace App\db\impl;

use App\db\IPDOConnection;

class MysqlPDO implements IPDOConnection{

    public static function connect():\PDO {
        try {
            $pdo = new \PDO('mysql:host='.$_ENV['DDBB_HOST'].'dbname='.$_ENV['DDBB_NAME'], $_ENV['DDBB_USER'], $_ENV['DDBB_PASSWORD']);
            $pdo->exec("set names utf8");
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\Throwable $th) {
            throw new \Exception("Error al conectar con la base de datos", 500);
        }
    }

}

