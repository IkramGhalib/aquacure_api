<?php
require_once 'opendb.php';

$query = "SELECT eid,AVG(temp) as temp,AVG(humidity) as hum,AVG(air_pressure) as ap,AVG(wind_speed) as ws,AVG(D_10) as d10,AVG(D2_5) as d2_5,AVG(NO) as no,AVG(No_x) as nox,AVG(NO2) as no_2,AVG(SO_2) as so_2, datetime from devices_logs;";
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