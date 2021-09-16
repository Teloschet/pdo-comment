<?php

$pdo = new PDO('mysql:host=localhost;dbname=api', 'root', '', [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

?>