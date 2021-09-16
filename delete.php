<?php

header("Content-Type: application/json; charset=UTF-8");

$pdo = new PDO('mysql:host=localhost;dbname=api', 'root', '', [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

if (isset($_POST['idComment'])) {
    $idComment = $_POST['idComment'];

    $deletar = $pdo->prepare("DELETE FROM comment WHERE id = :id");
    $deletar->bindParam(':id', $idComment);
    $deletar->execute();

    $obj = array(
        'status' => "success",
        'delete' => $idComment 
    );
    echo json_encode($obj);
}

?>