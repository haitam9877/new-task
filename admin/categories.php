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

$sit = $conn->prepare("SELECT * FROM categories");
$sit->execute();
$categories = $sit->fetchAll();
$categoriesCont = $sit->rowCount();





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
    <a href="?page=addCategorie" class="btn btn-primary">Add New Categorie</a>
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
    Categories <span class="badge bg-secondary"><?php echo $categoriesCont; ?></span>
    </h3>



    <table class="table table-striped mt-2 table-light table-bordered">
      <thead>


        <tr>


          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Discrption</th>
          <th scope="col">status</th>
          <th scope="col">Controler</th>
        </tr>
      </thead>
      <tbody>

        <?php

        if ($categoriesCont > 0) {


          foreach ($categories as $categorie) {

        ?>
            <tr>
              <th scope="row"><?php echo $categorie['id'] ?></th>
              <td><?php echo $categorie['title'] ?></td>
              <td><?php echo $categorie['discrption'] ?></td>
              <td>
              
              
              <?php

                  if ($categorie['status'] == "visible") {

                    echo '<p class="badge bg-success">visible</p>';
                  } else {
                    echo '<p class="badge bg-danger">hidden</p>';
                  }


                  ?>
              
              
              </td>
              
             
            

              <td>
                <div class="contr">

              
                  <a data-userid="<?php echo $categorie["id"]; ?>""  class="btn btn-secondary btn-detilis"  >
                  <i class="fa-solid fa-circle-info"></i>
                  </a>
                  
                
                 

                  <a  class="btn btn-danger btn-delete" data-id="<?php echo $categorie["id"]; ?>"  data-bs-toggle="modal" data-bs-target="#modelDelete">
                    <i class="fa-solid fa-trash"></i>
                  </a>

                  <a  class="btn btn-primary " href="?page=edit&userid=<?php echo $categorie["id"]; ?>" >
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
        <h5 class="modal-title" id="exampleModalLabel"> you want delete this categorie ?</h5>
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




}elseif($page == "addCategorie"){ ?>

  <div class="container">
    <h3  class=" mt-5 mb-5">Regster</h3>
    <div class=" w-50 ">
            <form method="post" action="?page=seveCategorie">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">title</label>
                    <input type="text" class="form-control" name="title">
               
                 </div>

                 <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">descrption</label>
                    <input type="text" class="form-control" name="descrption">
               
                 </div>
              

                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Status</label>

                <select class="form-select" aria-label="Default select example" class="w-20" name="status">
                  <option selected>Choose</option>
                  <option value="visible">Visbile</option>
                  <option value="hidden">Hidden</option>
                 
                </select>
                </div>
               
            <button type="submit" class="btn btn-primary" name="add-categorie">Seve</button>
        </form>
    </div>
</div>




<?php }elseif($page == "seveCategorie") {



    if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(isset($_POST["add-categorie"])){

        $usernameErr= $emailErr=$passwordErr=$roleErr = "";

        $title = $_POST["title"];
        $descrption = $_POST["descrption"];
        $status = $_POST["status"];
       


        if(!empty($title)){
          $title = htmlspecialchars($title, ENT_QUOTES,"UTF-8");
        }else{
          
        }

        if(!empty($descrption)){
          $descrption =  htmlspecialchars($descrption, ENT_QUOTES,"UTF-8");
        }else{
         
        }

        if(!empty($status)){
          $status = htmlspecialchars($status, ENT_QUOTES,"UTF-8");
        }else{
        
        }

      

       

          $sita = $conn->prepare("INSERT INTO categories (title, discrption, status,created_at) 
        VALUES (:ztitle, :zdiscrption,  :zstatus,  NOW())");
          $sita->execute(array(
            ':ztitle' => $title,
            ':zdiscrption'    => $descrption,
            ':zstatus'   => $status,
          ));

          if($sita->rowCount() > 0){
  
            $_SESSION['message'] = "Add Categorie successfully";
            header("Location:categories.php");
            exit();

          } 


        
  
    }
  }
 
}elseif($page == "delete"){

  if(isset($_GET['userid']) && is_numeric($_GET['userid'])){
    $userid = intval($_GET['userid']);
  }else{
    $userid = "";
  }



  $sit = $conn->prepare("SELECT * FROM categories WHERE id = ? ");
  $sit->execute(array($userid));


  $rows = $sit->rowCount();

  if($rows > 0){

    $deletesit = $conn->prepare('DELETE  FROM categories WHERE id = ?');
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
      header("Location:categories.php");
      exit();
    }else{
      $_SESSION['message'] = "";

    }

   
  }



}elseif($page == "edit") {

  if(isset($_GET["userid"])){
    $id = intval($_GET["userid"]);

    $data = $conn->prepare("SELECT * FROM categories WHERE id = ?");
    $data->execute(array($id));

    $datauser = $data->fetch();
  }
  ?>

<div class="container">
    <h3  class=" mt-5 mb-5">Edit Categorie</h3>
    <div class=" w-50 ">
            <form method="post" action="?page=seveEdit">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $datauser["title"];?>">
               
                 </div>

                 <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">descrption</label>
                    <input type="text" class="form-control" name="descrption" value="<?php echo $datauser["discrption"];?>">
               
                 </div>
             

                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Role</label>

                <select class="form-select" aria-label="Default select example" class="w-20" name="status" autofocus>
                  <option selected>Choose</option>
                  <option value="visible"  <?php if($datauser["status"] == "visible" ) echo 'selected' ?>>Visible</option>
                  <option value="hidden " <?php if($datauser["status"] == "hidden" ) echo 'selected' ?>>Hidden</option>
                 
                </select>
                </div>
               
            <button type="submit" class="btn btn-primary" name="edit-categorie">Seve</button>
        </form>
    </div>
</div>

<?php
}elseif($page == "edit-user"){
  
}
?>


  
<?php

include 'includes/template/footer.php';
}else{
unset($_SESSION['admin']);
  
  header('Location:login.php');
}
?>