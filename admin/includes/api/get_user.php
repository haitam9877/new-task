

<?php

include "../db/db.php";

if(isset($_GET['user_id'])){
  
    $id = intval($_GET['user_id']);
    $showData = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $showData->execute(array($id));
    
    if($showData->rowCount() > 0){

      $dataUser = $showData->fetch();

      echo json_encode($dataUser);
    }else{
      echo json_encode(['error' => 'no data user']);

    }
}else{
  echo json_encode(['erorr' => "no id"]);
}



?>
