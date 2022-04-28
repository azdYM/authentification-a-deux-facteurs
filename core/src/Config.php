<?php

namespace Framework;

class Config 
{
    private static $_instance;
    private $settings = [];

    /**
     * permet de retourner le meme instance de Config
     * 
     * @param Array $file
     * @return Config
     * 
     */
    public static function getInstance($file) 
    {
        if (self::$_instance === null) {
            self::$_instance = new Config($file);
        }

        return self::$_instance;
    }

    public function __construct($file)
    {
        $this->settings = require($file);
    }

    /**
     * permet de retourner une valeur a partir d'une clé
     * 
     * @param string $key
     * @return string 
     */
    public function get($key) 
    {
        if (isset($this->settings[$key])) {
            return $this->settings[$key];
        }
    }
}