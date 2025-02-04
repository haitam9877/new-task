<?php


include 'init.php';

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





?>


<?php if($page == "All"){ 
  
  
  
  ?>

<div class="container-teble  p-4">

<h1 class="text-center">Users Mangemante</h1>




  <div class="container mt-2">

  <div class="add-user mt-4 mb-4 ">
    <a href="?page=addUser" class="btn btn-primary">Add User</a>
  </div>

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

                  <a type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fa-solid fa-circle-info"></i>
                  </a>

                  <a href="#" class="btn btn-danger">
                    <i class="fa-solid fa-trash"></i>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php }elseif($page == "addUser"){ 
  
 
  
  
  ?>

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
          $sita->execute([
            ':zusername' => $username,
            ':zemail'    => $email,
            ':zpassword' => $password,
            ':zstatus'   => '0',
            ':zrole'     => 'admin'
        ]);

          if($sita->rowCount() > 0){


            echo "you have ben sassisfoly";
            header('Location:users.php');
            exit();

          } 


        }else{
          echo  $emailErr;
        }
  
    }
  }

  ?>




  
<?php
  }
include 'includes/template/footer.php';
?>