<?php

session_start();


include 'init.php';


if(isset($_SESSION['admin'])){

include 'includes/template/navbar.php';




// check Page

if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = "All";

}



// Get users Data

$sit = $conn->prepare("SELECT * FROM users");
$sit->execute();
$users = $sit->fetchAll();
$usersCont = $sit->rowCount();





// if(isset($_GET['user_id'])){

//   $id = intval($_GET['user_id']);

  

//   $showData = $conn->prepare("SELECT * FROM users WHERE id = ?");
//   $showData->execute(array($id));

//   $showUser = $showData->fetch();

// }






?>


<?php if($page == "All"){ ?>


<div class="container-teble  p-4">

<h1 class="text-center">Users Mangemante</h1>




  <div class="container mt-2">

  <div class="add-user mt-4 mb-4 ">
    <a href="?page=addUser" class="btn btn-primary">Add New User</a>
  </div>

 
  <?php if(isset($_SESSION['message'])){

 

 
  ?>
  
  <div class="alert alert-success" role="alert">
  <?php echo $_SESSION['message'] ; ?>
</div>


  <?php 

    
      unset($_SESSION['message']);
    
    }
  
  ?>
 
    <h3 >
      Users <span class="badge bg-secondary"><?php echo $usersCont; ?></span>
    </h3>



    <table class="table table-striped mt-2 table-light table-bordered">
      <thead>


        <tr>


          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">status</th>
          <th scope="col">Controler</th>
        </tr>
      </thead>
      <tbody>

        <?php

        if ($usersCont > 0) {


          foreach ($users as $user) {

        ?>
            <tr>
              <th scope="row"><?php echo $user['id'] ?></th>
              <td><?php echo $user['username'] ?></td>
              <td><?php echo $user['email'] ?></td>
              <td>
                <p class="badge bg-primary"><?php echo $user['role'] ?></p>
              </td>
              <td><?php

                  if ($user['status'] === "1") {

                    echo '<p class="badge bg-success">Active</p>';
                  } else {
                    echo '<p class="badge bg-danger">Pindding</p>';
                  }


                  ?></td>
              <td>

                <div class="contr">

              
                  <a data-userid="<?php echo $user["id"]; ?>""  class="btn btn-secondary btn-detilis"  >
                  <i class="fa-solid fa-circle-info"></i>
                  </a>
                  
                
                 

                  <a  class="btn btn-danger btn-delete" data-id="<?php echo $user["id"]; ?>"  data-bs-toggle="modal" data-bs-target="#modelDelete">
                    <i class="fa-solid fa-trash"></i>
                  </a>

                  <a  class="btn btn-primary " href="?page=edit&userid=<?php echo $user["id"]; ?>" >
                  <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </div>

              </td>
            </tr>

        <?php
            }
          }
        
        ?>
      </tbody>
    </table>
  </div>
</div>


<div class="modal fade show" id="detailsModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    
      
      <input type="hidden" name="data_user" id="show_id">

      <div class="modal-body" id="userDetails">
        <!-- سيتم عرض البيانات هنا -->
      </div>
    
  

    
    </div>
  </div>
</div> 

<!-- Modal Delete -->
<div class="modal fade" id="modelDelete" tabindex="-1" aria-labelledby="modelDelete" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> you want delete this user ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a type="button" class="btn btn-primary "  id="confirm-delete" >Yes</a>
      </div>
    </div>
  </div>
</div>



<?php 




}elseif($page == "addUser"){ ?>

  <div class="container">
    <h3  class=" mt-5 mb-5">Regster</h3>
    <div class=" w-50 ">
            <form method="post" action="?page=seveUser">
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

                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Role</label>

                <select class="form-select" aria-label="Default select example" class="w-20" name="role">
                  <option selected>Choose</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                 
                </select>
                </div>
               
            <button type="submit" class="btn btn-primary" name="add-user">Seve</button>
        </form>
    </div>
</div>




<?php }elseif($page == "seveUser") {



    if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(isset($_POST["add-user"])){

        $usernameErr= $emailErr=$passwordErr=$roleErr = "";

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $role = $_POST["role"];


        if(!empty($username)){
          $username = htmlspecialchars($username, ENT_QUOTES,"UTF-8");
        }else{
          $usernameErr = "the Username Is Empty";
        }

        if(!empty($email)){
          $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        }else{
          $emailErr = "the Email Is Empty";
        }

        if(!empty($password)){
          $password = htmlspecialchars($password, ENT_QUOTES,"UTF-8");
        }else{
          $passwordErr = "the Password Is Empty";
        }

        if(!empty($role)){
          $role = htmlspecialchars($role, ENT_QUOTES,"UTF-8");
        }else{
          $roleErr = "the Role Is Empty";
        }


        if(empty($usernameErr) && empty($emailErr)  && empty($passwordErr) && empty($roleErr)){

          $sita = $conn->prepare("INSERT INTO users (username, email, password, status, role, created_at) 
        VALUES (:zusername, :zemail, :zpassword, :zstatus, :zrole, NOW())");
          $sita->execute(array(
            ':zusername' => $username,
            ':zemail'    => $email,
            ':zpassword' => sha1($password),
            ':zstatus'   => '0',
            ':zrole'     => $role
          ));

          if($sita->rowCount() > 0){
  
            $_SESSION['message'] = "Add user successfully";
            header("Location:users.php");
            exit();

          } 


        }else{
         
            
          
        }
  
    }
  }
 
}elseif($page == "delete"){

  if(isset($_GET['userid']) && is_numeric($_GET['userid'])){
    $userid = intval($_GET['userid']);
  }else{
    $userid = "";
  }



  $sit = $conn->prepare("SELECT * FROM users WHERE id = ? ");
  $sit->execute(array($userid));


  $rows = $sit->rowCount();

  if($rows > 0){

    $deletesit = $conn->prepare('DELETE  FROM users WHERE id = ?');
    $deletesit->execute(array($userid));



    if($deletesit->rowCount() > 0){

      if ($_SESSION['userid'] == $userid) {
        // إلغاء الجلسة بالكامل إذا كان المستخدم هو نفسه
        session_unset();  // إلغاء كل المتغيرات الجلسة
        session_destroy();  // تدمير الجلسة
        header("Location: login.php");
        exit();
    }
     
      $_SESSION['message'] = "Deleted successfully";
      header("Location:users.php");
      exit();
    }else{
      $_SESSION['message'] = "";

    }

   
  }



}elseif($page == "edit") {

  if(isset($_GET["userid"])){
    $id = intval($_GET["userid"]);
  }else{
    $id = "";
  }

    $data = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $data->execute(array($id));

    $datauser = $data->fetch();
  ?>

<div class="container">
    <h3  class=" mt-5 mb-5">Edit User</h3>
    <div class=" w-50 ">
            <form method="post" action="?page=seveEdit">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username_edit" value="<?php echo $datauser["username"];?>">
               
                 </div>

                 <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="text" class="form-control" name="email__edit" value="<?php echo $datauser["email"];?>">
               
                 </div>
              

                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Role</label>

                <select class="form-select" aria-label="Default select example" class="w-20" name="role_edit" autofocus>
                  <option selected>Choose</option>
                  <option value="admin"  <?php if($datauser["role"] == "admin" ) echo 'selected' ?>>Admin</option>
                  <option value="user " <?php if($datauser["role"] == "user" ) echo 'selected' ?>>User</option>
                 
                </select>
                </div>

                <input type="hidden" name="id" value="<?php echo $datauser["id"]; ?>">

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password Confirm</label>
                    <input type="password" class="form-control" name="password_confirm">
                </div>
               
            <button type="submit" class="btn btn-primary" name="edit-user">Seve</button>
        </form>
    </div>
</div>

<?php
}elseif($page == "seveEdit"){
  
  

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST["edit-user"])){

      
        $id =  $_POST["id"];
      

      $username = $_POST["username_edit"];
      $email = $_POST["email__edit"];
      $role = $_POST["role_edit"];
      $newPassword = $_POST["new_password"];
      $confirmPassword = $_POST["password_confirm"];

      $hashPassword = sha1($newPassword);


      $getPassword = $conn->prepare("SELECT password FROM users WHERE id = ?");
      $getPassword->execute(array($id));
      

      $row = $getPassword->fetch();
    
      $oldPassword = $row["paasword"];

      $passwordFinal = !empty($newPassword) ? htmlspecialchars(sha1($newPassword),ENT_QUOTES , "utf-8") : $oldPassword;
  

      $updete = $conn->prepare("UPDATE users SET username = ? , email = ? , password = ? , role = ? , updetd_at = now() WHERE id = ?");

      $updete->execute(array( $username,$email,$passwordFinal,$role,$id));

      $updeteCount = $updete->rowCount();


      if($updeteCount > 0){

        header("Location:users.php");
        exit();
      }

    }
  

    

  

  }
}
?>


  
<?php

include 'includes/template/footer.php';
}else{
unset($_SESSION['admin']);
  
  header('Location:login.php');
}
?>