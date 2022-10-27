<?php
require_once 'opendb.php';

//   $device_id=$_POST['device_id'];
  $query="select * from water_quality";
  $result=mysqli_query($conn,$query);
  $response=array();
  if($result){
    foreach($result as $row){
        $response[]=$row;
  }
}
  else{
    $response['error']="400";
    $response['message']="Data does not exist";

  }
  echo json_encode($response);
 

?>