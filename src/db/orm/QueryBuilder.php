<?php

namespace App\db\orm;

use App\db\orm\DB;
use App\DAO\impl\MoviesDBDAO;



class QueryBuilder {
 
    private string $fields = '*';
 
    private string $where = "";
 
    private ?array $params = null;
 
    private string $sql;
     
    function __construct(private string $table) {
        $this->table = $table;
    }

    public function select(?string $fields = null) {
        $this->fields = (is_null($fields))? '*': $fields;
        return $this;
    }

    public function where(string $field, string $condition, ?string $value) {
        if (is_null($value)) {
            $value = $condition;
            $condition = '=';
        }
        $this->where = "WHERE $field $condition :$field";
        $this->params[":$field"] = $value;
        return $this;
    }

    public function get():array {
        $this->sql = "SELECT $this->fields FROM $this->table $this->where";
        return DB::select($this->sql, $this->params);
    }
         
    public function getOne():\stdClass {
        $this->sql = "SELECT $this->fields FROM $this->table $this->where LIMIT 1";
        return DB::selectOne($this->sql, $this->params);
    }  

    public function find(int $id) {
        $this->where('id', '=', $id);
        return $this->getOne();
    }

    private function toSql() {
        dd($this->sql);
    }

    public function insert(array $data):int {
        $fieldsParams = "";
        foreach ($data as $key => $value) {
            $fieldsParams .= ":$key,";
            $this->params[":$key"] = $value;
        }
        $fieldsParams = rtrim($fieldsParams, ',');
        $fieldsName = implode(",", array_keys($data));
        $this->sql = "INSERT INTO $this->table($fieldsName) VALUES ($fieldsParams)";
        return DB::insert($this->sql, $this->params);
    }

    public function delete(int $id) {
        $this->where('id', '=', $id);
        $this->sql = "DELETE FROM $this->table $this->where";
        return DB::delete($this->sql, $this->params);
    }

    public function update(int $id, array $data): int {
        $fieldsParams = "";
        foreach ($data as $key => $value) {
            $fieldsParams .= "$key=:$key,";// el .= es como += en PHP
            $this->params[":$key"] = $value;
        }
        $this->where('id', '=', $id);
        $fieldsParams = rtrim($fieldsParams, ',');//rtrim quita espacios y los sustituye por comas
        $this->sql = "UPDATE $this->table SET $fieldsParams $this->where";
        return DB::update($this->sql, $this->params);
    }

    //https://phpdelusions.net/pdo_examples/update


}