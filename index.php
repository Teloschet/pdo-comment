<?php
include_once("class.php");

$feedcomment = $pdo->prepare("SELECT * FROM comment");
$feedcomment->execute();
$feedcommentid = $feedcomment->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>API with Ajax</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1>Post</h1>
        </header>
        <hr>
        <main>
            <div class="comment" style="text-align:justify;">
                <h3>I have a title!</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam massa lorem, pretium id euismod at, gravida vitae elit. Etiam volutpat turpis nec mauris porttitor tempus. Suspendisse potenti. Nam porta est ullamcorper, placerat nulla eget, consequat lorem. Nulla a risus ante. Mauris scelerisque augue eget massa convallis, et gravida nunc efficitur. Donec feugiat rhoncus lobortis. Nunc vel pretium augue, ut ullamcorper elit. In ultricies odio et volutpat feugiat. Donec fringilla lectus purus. Ut a ante finibus, egestas lorem et, mollis turpis. Proin sit amet semper elit.</p>
            </div>

            <h2>Make your comment here</h2>
            <form id="formcomment" class="form-control">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Your name</label>
                    <input type="text" id="name" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Write your name here">
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Your comment</label>
                    <textarea class="form-control" id="comment" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Publish</button>
                </div>
            </form>

            <hr>
            <h2>Comments here</h2>
            <?php

            $list = $pdo->prepare("SELECT * FROM comment ORDER BY id DESC");
            $list->execute();
            $comentarios = $list->fetchAll(PDO::FETCH_ASSOC);

            $total_comentarios = $list->rowCount();

            foreach ($comentarios as $comment) {
            ?>
                <div class="row gy-5" style="margin-bottom:10px;">
                    <div class="col-100">
                        <div id="tuamae" class="p-3 border bg-light">
                            <div class="left">
                                <h5><?= htmlspecialchars($comment['name']) ?></h5>
                                <p><?= htmlspecialchars($comment['comment']) ?></p>
                            </div>
                            
                            <div class="right">
                                    <button onclick="delet(<?= $comment['id'] ?>)" data-row-id="<?= $comment['id'] ?>" class="form-input">
                                        <i class="fas fa-trash"></i>
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>

        $('#formcomment').submit(function(e) {
                    e.preventDefault();

                    var u_name = $('#name').val();
                    var u_comment = $('#comment').val();

                    $.ajax({
                                url: '/inserir.php',
                                type: 'POST',
                                data: {'name': u_name, 'comment': u_comment},
                                async: true,
                                success: function(resultado)
                                {
                                    window.location.href = "/";
                                }
                            });
                });

        function delet(idComment) {
            var deletButton = document.querySelector('.form-input[data-row-id="' + idComment + '"]');

            $.ajax({
                method: 'POST',
                url: '/delete.php',
                data: 'idComment=' + idComment
            });
            window.location.href = "/";
        }
    </script>
</body>

</html>