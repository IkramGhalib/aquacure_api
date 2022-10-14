<?php
require_once 'opendb.php';

//   $id=$_POST['id'];
//   $fromdate = $_POST['fromdate'];
//   $todate = $_POST['todate'];
  $query="select * from transformer";
//   $query="select trid,name,longitude,latitude from transformer where trid='$device_id'";
  $result=mysqli_query($conn,$query);
  $response=array();
  if($result){
    foreach($result as $row){
        $response[]=$row;
        $data=array('data'=>$response);
  }
}
  else{
    $response['error']="400";
    $response['message']="Data does not exist";

  }
  echo json_encode($response);
 

?>