<?php
require_once 'opendb.php';
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];

$query="SELECT *, (((acos(sin((".$latitude."*pi()/180)) * sin((`latitude`*pi()/180)) + cos((".$latitude."*pi()/180)) * cos((`latitude`*pi()/180)) * cos(((".$longitude."- `longitude`)*pi()/180)))) * 180/pi()) * 60 * 1.1515) as distance FROM waves_location";
  $result=mysqli_query($conn,$query);
  $response=array();
  if($result){
    foreach($result as $row){
        $arived=$row['distance']*100;
        $response=$row;
        $data=array('data'=>$response,'arrive_time'=>$arived);
  }
}
  else{
    $response['error']="400";
    $response['message']="Data does not exist";

  }
  echo json_encode($data);
  
 

?>