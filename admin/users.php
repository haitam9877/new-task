<?php


include 'init.php';

include 'includes/template/navbar.php';





$sit = $conn->prepare("SELECT * FROM users");
$sit->execute();
$users = $sit->fetchAll();
$usersCont = $sit->rowCount();

?>




<div class="container-teble  p-4">



  <div class="container mt-5">

    <h3 class="h3">
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


<?php

include 'includes/template/footer.php';
?>