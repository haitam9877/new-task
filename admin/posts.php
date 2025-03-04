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

$sit = $conn->prepare("SELECT * FROM posts");
$sit->execute();
$posts = $sit->fetchAll();
$postsCont = $sit->rowCount();





// if(isset($_GET['user_id'])){

//   $id = intval($_GET['user_id']);

  

//   $showData = $conn->prepare("SELECT * FROM users WHERE id = ?");
//   $showData->execute(array($id));

//   $showUser = $showData->fetch();

// }






?>


<?php if($page == "All"){ ?>


<div class="container-teble  p-4">

<h1 class="text-center">Posts Mangemante</h1>




  <div class="container mt-2">

  <div class="add-user mt-4 mb-4 ">
    <a href="?page=addPost" class="btn btn-primary">Add New Post</a>
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
    Posts <span class="badge bg-secondary"><?php echo $postsCont; ?></span>
    </h3>



    <table class="table table-striped mt-2 table-light table-bordered">
      <thead>


        <tr>


          <th scope="col">#</th>
          <th scope="col">image</th>
          <th scope="col">Title</th>
          <th scope="col">Discrption</th>
          <th scope="col">categoire_id</th>
          <th scope="col">user_id</th>
          <th scope="col">status</th>
          <th scope="col">Controler</th>
        </tr>
      </thead>
      <tbody>

        <?php

        if ($postsCont > 0) {


          foreach ($posts as $post) {

        ?>
            <tr>
              <th scope="row"><?php echo $post['id'] ?></th>
              <td>
                <img src="includes/upload/images/<?php echo $post['image'] ?>" alt="" width="90" height="90">
              </td>
              <td><?php echo $post['title'] ?></td>
              <td><?php echo $post['discrption'] ?></td>
              <td><?php echo $post['categoire_id'] ?></td>
              <td><?php echo $post['user_id'] ?></td>
              <td>
              
              
              <?php

                  if ($post['status'] == "visible") {

                    echo '<p class="badge bg-success">visible</p>';
                  } else {
                    echo '<p class="badge bg-danger">hidden</p>';
                  }


                  ?>
              
              
              </td>
              
             
            

              <td>
                <div class="contr">

              
                  <a data-userid="<?php echo $post["id"]; ?>""  class="btn btn-secondary btn-detilis"  >
                  <i class="fa-solid fa-circle-info"></i>
                  </a>
                  
                
                 

                  <a  class="btn btn-danger btn-delete" data-id="<?php echo $post["id"]; ?>"  data-bs-toggle="modal" data-bs-target="#modelDelete">
                    <i class="fa-solid fa-trash"></i>
                  </a>

                  <a  class="btn btn-primary " href="?page=edit&userid=<?php echo $post["id"]; ?>" >
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




}elseif($page == "addPost"){ ?>

  <div class="container pb-5">
    <p><?php echo $_SESSION["userid"] ?></p>
    <h3  class=" mt-5 mb-5">Add post</h3>
    <div class=" w-50 ">
            <form method="post" action="?page=sevePost">

            <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Image</label>
                    <input type="file" class="form-control" name="image">
               
                 </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">title</label>
                    <input type="text" class="form-control" name="title">
               
                 </div>

                 <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">discrption</label>
                    <input type="text" class="form-control" name="discrption">
               
                 </div>

                 <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Categoire_id</label>

                <select class="form-select" aria-label="Default select example" class="w-20" name="categoire_id">
                  <option selected>Choose</option>

                  <?php
                  $sit = $conn->prepare("SELECT * FROM categories");
                  $sit->execute();
                  $allCategories = $sit->fetchAll();
                 

                 foreach($allCategories as $categorie){

                    echo "<option value='". $categorie["id"]  ."'>". $categorie["title"] ."</option>";
                 }

                  

                  ?>
                 
                 
                </select>
                </div>

             
                <input type="hidden" name="user_id" value="<?php echo $_SESSION["userid"] ?>">
              

                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Status</label>

                <select class="form-select" aria-label="Default select example" class="w-20" name="status">
                  <option selected>Choose</option>
                  <option value="visible">Visbile</option>
                  <option value="hidden">Hidden</option>
                 
                </select>
                </div>
               
            <button type="submit" class="btn btn-primary" name="add-post">Seve</button>
        </form>
    </div>
</div>




<?php }elseif($page == "sevePost") {



    if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(isset($_POST["add-post"])){

        $formPostsError= [];

        $title = $_POST["title"];
        $discrption = $_POST["discrption"];
        $categoire_id = $_POST["categoire_id"];
        $user_id = $_POST["user_id"];
        $status = $_POST["status"];
       


        if(!empty($title)){

            $title = htmlspecialchars($title, ENT_QUOTES, "UTF-8");
        }else{
            $formPostsError[] = "title is required";
        }

        if(!empty($discrption)){

            $discrption = htmlspecialchars($discrption, ENT_QUOTES, "UTF-8");
        }else{
            $formPostsError[] = "discrption is required";
        }

        if(!empty($status)){

            $status = $status;
        }else{
            $formPostsError[] = "status is required";
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
                    <input type="text" class="form-control" name="title_edit" value="<?php echo $datauser["title"];?>">
               
                 </div>

                 <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">discrption</label>
                    <input type="text" class="form-control" name="descrption_edit" value="<?php echo $datauser["discrption"];?>">
               
                 </div>
             
                 <input type="hidden" name="id" value="<?php echo $datauser["id"]; ?>">

                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Status</label>

                <select class="form-select" aria-label="Default select example" class="w-20" name="status_edit" autofocus>
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
}elseif($page == "seveEdit"){
  
  

    if($_SERVER["REQUEST_METHOD"] == "POST"){
  
      if(isset($_POST["edit-categorie"])){
  
        
          $id =  $_POST["id"];
        
  


        $title = $_POST["title_edit"];
        $descrption = $_POST["descrption_edit"];
        $status = $_POST["status_edit"];
  
  
  
       
    
  
        $updetecategorie = $conn->prepare("UPDATE categories SET title = ? , discrption = ? , status = ?,updete_at = now() WHERE id = ?");
  
        $updetecategorie->execute(array( $title,$descrption,$status,$id));
  
        $updeteupdetecategorieCount = $updetecategorie->rowCount();
  
  
        if($updeteupdetecategorieCount > 0){
  
          header("Location:categories.php");
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