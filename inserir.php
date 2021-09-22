<?php
header('Content-Type: application/json');

if (!isset($_POST['name']) || !isset($_POST['comment']))
    die(json_encode(array(
        'status' => "error",
        'message' => "Missing name and comment."
    )));

$name = htmlspecialchars($_POST['name']);
$comment = htmlspecialchars($_POST['comment']);

$pdo = new PDO('mysql:host=localhost;dbname=api', 'root', '', [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

$stmt = $pdo->prepare('INSERT INTO comment (name, comment) VALUES(?, ?)');
$stmt->bindParam(1, $name);
$stmt->bindParam(2, $comment);
$stmt->execute();

if ($stmt->rowCount() >= 1) {
    $obj = array(
        'status' => "success",
        'name' => $name,
        'comment' => $comment,
    );
    echo json_encode($obj);
} else {
    echo json_encode(array(
        'status' => "error",
        'message' => "Falha ao salvar comentário"
    ));
}
