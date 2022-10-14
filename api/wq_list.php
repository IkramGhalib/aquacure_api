<?php
require_once 'opendb.php';

//   $id=$_POST['id'];
//   $fromdate = $_POST['fromdate'];
//   $todate = $_POST['todate'];
  $query="select *,water_quality.name wqn, water_quality.location wql, water_quality.latitiude wqlat, water_quality.longitude wqlong, transformer.trid, transformer.name twn, transformer.location twl, transformer.zone, transformer.uc, transformer.nc,transformer.twid, water_quality.datetime wqdt from water_quality, transformer WHERE transformer.trid = water_quality.trid";
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