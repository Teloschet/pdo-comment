<?php

header("Content-Type: application/json; charset=UTF-8");

$pdo = new PDO('mysql:host=localhost;dbname=api', 'root', '', [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

if (isset($_POST['idComment'])) {

    $deletar = $pdo->prepare("DELETE FROM comment WHERE id = ?");
    $deletar->bindParam(1, $_POST['idComment']);
    $deletar->execute();

    echo json_encode(array(
        'status' => "success",
        'delete' => $_POST['idComment']
    ));
}
