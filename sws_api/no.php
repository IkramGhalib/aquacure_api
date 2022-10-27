<?php
require_once 'opendb.php';
$device_id=$_POST['device_id'];
// $query = "SELECT eid,round(AVG(temp)) as temp,datetime from devices_logs where eid='$device_id' order by datetime desc";


//   $query="SELECT eid, round(avg(temp)) as temp,datetime FROM `devices_logs` where eid='$device_id' ORDER BY `devices_logs`.`datetime` DESC";
// $query="SELECT eid,round(AVG(temp)) as temp, date(datetime) from devices_logs where eid='$device_id' and date(datetime) = date(Now()) group by date(datetime)";
$query="SELECT FROM_UNIXTIME(FLOOR(UNIX_TIMESTAMP(datetime) / (60*60)) * (60*60)) AS hourlytime, round(avg(no)) as no from devices_logs where eid='$device_id' GROUP BY hourlytime ORDER BY hourlytime desc limit 7";



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