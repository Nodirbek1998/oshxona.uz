<?php
    $dbhost = 'localhost';
    $dbname = 'osh';
    $dbuser = 'root';
    $dbpass = '';

    $connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

    if ($connection->connect_error){
        die("MySQlda ulanishda xatolik sodir bo`ldi");
    }

    define('SITE','http://oshxona.uz');
?>
