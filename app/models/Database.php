<?php

class Database
{

    private $host = "localhost";
    private $user = "root";
    private $password = "12345";
    private $port = "3306";
    protected $conn = NULL;
    private $dbname = "m_system";

    public function open()
    {
        $this->conn = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->dbname . '', $this->user, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ));
        return $this->conn;
    }

    public function close()
    {
        $this->conn = NULL;
    }

    public function checkStatus()
    {
        if (! $this->conn)
        {
            echo "<h3> Falha na conexão com banco de dados. Por favor, tente mais tarde!</h3>";
        } else
        {
            echo "<h3> O sistema está conectado a [$this->dbname] em [$this->host]</h3>";
        }
    }

}

?>
