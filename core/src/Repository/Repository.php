<?php

namespace Framework\Repository;

use PDOException;
use Framework\Database\MySql;

class Repository 
{   
    protected MySql $db;
    protected $table;

    public function __construct()
    {
        if ($this->table === null) {
            $class_name = explode('\\', get_class($this));
            $this->table = strtolower(str_replace('Repository', '', end($class_name)));
        }
    }

    public function findAll(): array {

        return $this->db->query(
            "SELECT * FROM $this->table", 
            str_replace('Repository', 'Entity', get_class($this))
        );
    }

    public function find(int $id) {

        return $this->db->prepare(
            "SELECT * FROM $this->table WHERE id = ?", [$id], 
            str_replace('Repository', 'Entity', get_class($this)), 
            true
        );
    }

    public function findOneBy(array $attribute) {
        $key = key($attribute);

        return $this->db->prepare(
            "SELECT * FROM $this->table WHERE $key = ?", 
            [$attribute[$key]], str_replace('Repository', 'Entity', get_class($this)),
            true
        );
    }

    public function update(string $table, array $attributes, int $id) {

        $sqlQuery = "UPDATE $table SET ";

        foreach($attributes as $k => $v) {
            $sqlQuery .= "$k = :$k, ";
        }

        $sqlQuery = substr($sqlQuery, 0, -2);
        $sqlQuery .= ' WHERE id = :id';
        $attributes['id'] = $id;
        var_dump($sqlQuery, $id, $attributes);
        $this->db->prepare($sqlQuery, $attributes);    
    }

    public function insert(string $table, array $attributes) {

        $attrs = "";
        $keys = "";
        
        foreach($attributes as $k => $v) {
            var_dump($k);
            $attrs .= "$k, ";
            $keys .= ":$k, ";
        }

        $attrs = substr($attrs, 0, -2);
        $keys = substr($keys, 0, -2);

        $sqlQuery = "INSERT INTO $table ($attrs) VALUES ($keys)";
        var_dump($sqlQuery, $attributes);
        $this->db->prepare($sqlQuery, $attributes);
        
    }
}

