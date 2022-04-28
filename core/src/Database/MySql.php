<?php

namespace Framework\Database;

use Framework\Config;
use PDO;

class MySql
{
    /**
     * @var PDO
     */
    private $pdo;
    private $name;
    private $host;
    private $user;
    private $password;

    public function __construct($file)
    {
      $config = Config::getInstance($file);
      $this->name = $config->get("name");
      $this->host = $config->get("host");  
      $this->user = $config->get("user");  
      $this->password = $config->get("password");  

    }

    /**
     * peremet de recuperer une instance de pdo
     * 
     */
    protected function getPDO(): PDO
    {
        
        if ($this->pdo === null) {
            $this->pdo = new PDO("mysql:dbname=$this->name;host=$this->host", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function query($statement, $class=null, $one=false) {
        $result = $this->getPDO()->query($statement);

        if ($class === null) {
            $result->setFetchMode(PDO::FETCH_OBJ);
        } else 
            $result->setFetchMode(PDO::FETCH_CLASS, $class);


        return $one ? $result->fetch() : $result->fetchAll();
    }

    /**
     * permet d'effectuer une requete preparé
     * 
     * @param string $statement le requete sql a effectuer
     * @param array $option les attribut
     * @param string $class le class
     * @param bool $one si false renvois tous les données
     * 
     * @return object
     *  
     */
    public function prepare(string $statement, array $options=[], string $class=null, bool $one=false)
    {
        $result = $this->getPDO()->prepare($statement);
        $result->execute($options);

        if ($class === null) {
            $result->setFetchMode(PDO::FETCH_OBJ);
        } else 
            $result->setFetchMode(PDO::FETCH_CLASS, $class);

        
        return $result->fetch();
    }


}