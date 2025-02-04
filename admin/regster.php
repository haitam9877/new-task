<?php 

session_start();
include "init.php";




if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["regster"])){
 
     $username = $_POST["username"];

     $email = $_POST["email"];
     $password = $_POST["password"];
     $hashPassword = sha1($password);

     $timeNow = date("Y/m/d , h:m:s");

     
     if(!empty($username) && !empty($email) && !empty($password)){
        $insertData = $conn->prepare("INSERT INTO users (id,username,email,password,role,status,created_at,updetd_at) VALUES (NULL,?,?,?,'admin',0,?,NULL)");
        $insertData->execute(array($username,$email,$hashPassword,$timeNow));
   
   
        $rowData = $insertData->rowCount();

         
        print_r($insertData->fetch());
      


     }else{
        echo "soory";
     }
 
 
    ;
     

     
     
    }
 }

?>


<div class="container">
    <h1  class="text-center mt-5">Regster </h1>
    <div class="box-form ">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username">
               
                 </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="text" class="form-control" name="email">
               
                 </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
               
            <button type="submit" class="btn btn-primary" name="regster">Submit</button>
        </form>
    </div>
</div>


