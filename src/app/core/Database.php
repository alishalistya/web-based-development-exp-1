<?php


class Database
{
    private $dbhost = HOST;
    private $pass = PASSWORD;
    private $user = USER;
    private $port = PORT;
    private $database = DB_NAME;

    private $conn;
    private $statement;


    public function __construct()
    {
        $db_url = 'mysql:host=' . $this->dbhost . ";port=". $this->port . ";dbname=" .  $this->database;

        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->conn = new PDO($db_url, $this->user, $this->pass);
        } catch (PDOException) {
            throw new Exception('Bad Gateway', STATUS_BAD_GATEWAY);
        }
    }

    public function query(string $query) : void
    {
        $this->statement = $this->conn->prepare($query);
    }

    public function bind($param, $value, $type = null) : void
    {
        try {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value) :
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value) :
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value) :
                        $type = PDO::PARAM_NULL;
                        break;
                    default :
                        $type = PDO::PARAM_STR;
                }
            }
            $this->statement->bindValue($param, $value, $type);
        } catch (PDOException) {
            throw new Error();
        }
    }

    public function execute() : void{
        $this->statement->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }
}