<?php

session_start();


if(isset($_SESSION["admin"])){
    header("Location:dashbourd.php");
    exit();
}
include 'init.php';



if($_SERVER["REQUEST_METHOD"] == "POST"){

   if(isset($_POST["admin-login"])){

    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashPassword = sha1($password);


    $check = $conn->prepare("SELECT * FROM users WHERE email = ? and password = ?");
    $check->execute(array($email,$hashPassword));
    
    $checkRow = $check->rowCount();


    if($checkRow > 0){

       
        $userData = $check->fetch();

        if($userData["role"] == "admin"){
            $_SESSION["admin"] = $userData["username"];

            header("Location:dashbourd.php");
            exit();
        }else{
            echo"the user is not admin";
        }
       

       

    }else{
        echo"the user is not exitst";
    }

    
   }
}

?>

<div class="container">
    <h1  class="text-center mt-5">Login Admin</h1>
    <div class="box-form ">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="text" class="form-control" name="email">
               
                 </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
               
            <button type="submit" class="btn btn-primary" name="admin-login">Submit</button>
        </form>
    </div>
</div>



