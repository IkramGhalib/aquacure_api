<?php
require_once 'opendb.php';

$query = "SELECT eid,round(AVG(temp)) as temp,round(AVG(humidity)) as hum,round(AVG(air_pressure)) as ap,round(AVG(wind_speed)) as ws,round(AVG(D_10)) as d10,round(AVG(D2_5)) as d2_5,round(AVG(NO)) as no,round(AVG(No_x)) as nox,round(AVG(NO2)) as no_2,round(AVG(SO_2)) as so_2,datetime from devices_logs";
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