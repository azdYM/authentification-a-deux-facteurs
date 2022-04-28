<?php

use Framework\Database\MySql as DatabaseMySql;
use Framework\Repository\Repository;

class App 
{
    private static $_instance;
    private $db_instance;

    /**
     * singleton qui retourne une instance de App
     * 
     * @return self 
     */
    public static function getInstance(): self {
        if (self::$_instance === null) {
            self::$_instance = new App();
        }

        return self::$_instance;
    }

    public function load(): void {
        session_start();
        require ROOT . '/vendor/autoload.php';
        require ROOT . '/core/vendor/autoload.php';
    }

    /**
     * initialise une instance de la base de deonnée
     */
    public function getDb(): DatabaseMySql {
        if ($this->db_instance === null) {
            $this->db_instance = new DatabaseMySql(ROOT . '/config/config.php');
        }

        return $this->db_instance;
    }

    public function getRepository($name): Repository {
        $class_name = "App\\Repository\\" . ucfirst($name) . "Repository";
        return new $class_name($this->getDb());
    }
}