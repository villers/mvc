<?php

class PDO2 extends PDO
{
    private static $_instance;

    /* Constructeur: héritage public obligatoire par héritage de PDO. */
    function __construct(){}

    /* Singleton */
    public static function getInstance()
    {
        if (!isset(self::$_instance))
            try
            {
                $pdo = sprintf("%s:host=%s;dbname=%s", Application::$config["PDO_DRIVER"], Application::$config["PDO_HOST"],Application::$config["PDO_DATABASE"]);
                self::$_instance = new PDO($pdo, Application::$config["PDO_USER"], Application::$config["PDO_PASSWORD"]);
            } catch (PDOException $e) {}

        return self::$_instance; 
    }
}
?>