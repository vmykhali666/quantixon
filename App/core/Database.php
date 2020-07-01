<?php

namespace Core;


use PDO;
use PDOException;

class Database
{
    private $host;
    private $dbname;
    private $charset;
    private $username;
    private $password;

    private $pdo;

    private $error;

    public function __construct()
    {
        $dbArgs = require_once 'App/config/db_config.php';

        $this->host = $dbArgs['host'];
        $this->dbname = $dbArgs['dbname'];
        $this->charset = $dbArgs['charset'];
        $this->username = $dbArgs['username'];
        $this->password = $dbArgs['password'];
        // Set DSN
        $dsn = "mysql:host=$this->host;dbname=$this->dbname";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
            die();
        }
    }

    public function query($sql, $params = [])
    {
        $statement = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }

        $statement->execute();
        return $statement;
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
