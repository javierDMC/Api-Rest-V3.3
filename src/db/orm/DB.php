<?php

namespace App\db\orm;

use App\DAO\IMoviesDAO;
use App\DTO\MovieDTO;
use App\factories\DBFactory;
use App\db\orm\DB;

class DB {


    public static function select(string $sql, ?array $params = null):array {
        $result = array();
        $data = self::execute($sql, $params);
        foreach ($data as $record) {
            $result[] = ((object) $record);
        }
        return $result;
    }

    public static function selectOne(string $sql, ?array $params = null): \stdClass {
        $data = self::execute($sql, $params);
        if(count($data) > 0) {
            return (object) $data[0];
        }
        throw new \Exception("Recurso no encontrado", 404);        
    }

    public static function insert(string $sql, array $params): int {
        return self::executeNoResult($sql, $params);
    }

    private static function execute(string $sql, ?array $params = null):array {
        $pdo = DBFactory::getConnection()::connect();
        $ps = $pdo->prepare($sql);
        $ps->execute($params);
        return $ps->fetchAll(\PDO::FETCH_ASSOC); 
    }
         
    private static function executeNoResult(string $sql, array $params):int {
        $pdo = DBFactory::getConnection()::connect();
        try {
            $ps = $pdo->prepare($sql);
            echo($sql);
            var_dump($params);
            return $ps->execute($params); 
              
        } catch (\Throwable $th){
            //throw $th;
            throw new \Exception("Error al insertar el recurso", 400);
        }
    }
    
    public static function table(string $table):QueryBuilder {
        return new QueryBuilder($table);
    }

    public static function delete(string $sql, array $params){
        return self::executeNoResult($sql, $params);
    }

    public static function update(string $sql, ?array $params){
        return self::executeNoResult($sql, $params);
    }

    
}