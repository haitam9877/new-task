<?php


include 'init.php';

include 'includes/template/navbar.php';





$sit= $conn->prepare("SELECT * FROM users");
$sit->execute();
$users= $sit->fetchAll();
$usersCont = $sit->rowCount();

?>




<div class="container-teble  p-4" id="pry-color">

<h2 class="text-center">Users Mangament</h2>

    <div class="container">

    <span class="mt-4 mb-4">users   </span>  <strong class="btn btn-primary"><?php echo $usersCont ?></strong>
    <table class="table table-light">
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
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
    
  </tbody>
</table>
    </div>
</div>



<?php

include 'includes/template/footer.php';
?>