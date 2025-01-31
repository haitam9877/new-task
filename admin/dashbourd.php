<?php

include 'init.php';

include 'includes/template/navbar.php';



$con  = include 'includes/db/db.php';



$stm = $conn->prepare('SELECT * FROM users');
$stm->execute();
$users = $stm->rowCount();

$stm = $conn->prepare('SELECT * FROM categories');
$stm->execute();
$categories = $stm->rowCount();

$stm = $conn->prepare('SELECT * FROM posts');
$stm->execute();
$posts = $stm->rowCount();

$stm = $conn->prepare('SELECT * FROM comments');
$stm->execute();
$comments = $stm->rowCount();

?>





<div class="box p-5">
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card p-3  text-white" style="width: 18rem;">

                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $users ?></h5>

                        <h4>Users</h4>
                    </div>
                    <div class="icon d-flex">
                        <i class="fa-solid fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card p-3  text-white" style="width: 18rem;">

                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $categories ?></h5>

                        <h4>categories</h4>
                    </div>
                    <div class="icon d-flex">
                        <i class="fa-solid fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card p-3  text-white" style="width: 18rem;">

                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $posts ?></h5>

                        <h4>posts</h4>
                    </div>
                    <div class="icon d-flex">
                        <i class="fa-solid fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card p-3  text-white" style="width: 18rem;">

                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $comments ?></h5>

                        <h4>Comments</h4>
                    </div>
                    <div class="icon d-flex">
                        <i class="fa-solid fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php

include 'includes/template/footer.php';
?>