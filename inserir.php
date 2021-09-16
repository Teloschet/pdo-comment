<?php
header('Content-Type: application/json');

$name = htmlspecialchars($_POST['name']);
$comment = htmlspecialchars($_POST['comment']);

$pdo = new PDO('mysql:host=localhost;dbname=api', 'root', '', [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);

$stmt = $pdo->prepare('INSERT INTO comment(name, comment) VALUES(:na, :co)');
$stmt->bindValue(':na', $name);
$stmt->bindValue(':co', $comment);
$stmt->execute();


if($stmt->rowCount() >= 1) {
    
    $obj = array(
        'status' => "success",
        'name' => $name,
        'comment' => $comment,
    );
    echo json_encode($obj);

} else {
    echo json_encode('Falha ao salvar comentário');
}