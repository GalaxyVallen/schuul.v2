<?php

// namespace config;

// class Database
// {
//     private string $DB_HOST = 'localhost';
//     private string $DB_USER = 'root';
//     private string $DB_PASSWORD = '';
//     private string $DB_NAME = 'academic';

//     public function connect()
//     {
//         return mysqli_connect($this->DB_HOST, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);
//     }
// }

$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASSWORD = '';
$DB_NAME = 'academic';

$connect = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
mysqli_select_db($connect, $DB_NAME);
