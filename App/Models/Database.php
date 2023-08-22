<?php

namespace ev\Models;

class Database
{
    private string $dbHost = 'localhost';
    private string $dbUser = 'root';
    private string $dbPass = '';
    private ?string $dbName = 'akademik';
    private int $dbPort = 3306;
    private ?\mysqli $connection = null;

    public function __construct()
    {
        $this->conn();
    }

    private function conn()
    {
        $this->connection = new \mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName, $this->dbPort);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection()
    {
        if ($this->connection !== null) {
            $this->connection->close();
            $this->connection = null;
        }
    }
}
///bleajar

/// $DB_HOST = 'localhost';
// $DB_USER = 'root';
// $DB_PASSWORD = '';
// $DB_NAME = 'datasiswa';

/// $connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
/// $connect ?: 'Error to connect';

/// $connect = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
// if ($connect->connect_errno) {
//     // throw new RuntimeException('connection error: ', $connect->connect_error);
    
///     echo 'connection error: ' . $connect->connect_error;
//     die;
// }

/// mysqli_select_db($connect, $DB_NAME);
