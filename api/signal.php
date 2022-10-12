<?php
require_once 'opendb.php';

   $query="SELECT tr_current_logs.trid, transformer.name,transformer.location, transformer.zone, transformer.nc, transformer.uc, COUNT(*) cnt, date(tr_current_logs.datetime) dt from tr_current_logs, transformer where transformer.trid = tr_current_logs.trid and date(tr_current_logs.datetime) = CURDATE()-INTERVAL 1 DAY GROUP by tr_current_logs.trid, name, location, zone, nc, uc, date(tr_current_logs.datetime)";
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