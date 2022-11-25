<?php
require_once 'opendb.php';

// $query = "SELECT eid,round(AVG(temp)) as temp,round(AVG(humidity)) as hum,round(AVG(air_pressure)) as ap,round(AVG(wind_speed)) as ws,round(AVG(D_10)) as d10,round(AVG(D2_5)) as d2_5,round(AVG(NO)) as no,round(AVG(No_x)) as nox,round(AVG(NO2)) as no_2,round(AVG(SO_2)) as so_2,datetime from devices_logs";
  $query="SELECT device.name as device_name,device.*,devices_logs.* from devices_logs, device where id in (SELECT max(id) from devices_logs group by eid) and device.eid = devices_logs.eid ORDER by device.eid asc";
  $result=mysqli_query($conn,$query);
  $response=array();
  if($result){
    foreach($result as $row){
      // $temp=$row['temp'];
      // $humidity=$row['humidity'];
      // $air_pressure=$row['air_pressure'];
      // $wind_speed=$row['wind_speed'];
      // $D_10=$row['D_10'];
      // $D2_5=$row['D2_5'];
      // $NO=$row['NO'];
      // $No_x=round($row['No_x']);
      // $SO_2=$row['SO_2'];
      // $eid=$row['eid'];
      // $dt=$row['datetime'];
        $response[]=$row;
        // $data[]=array('data'=>$response,'eid'=>$eid,'temp'=>$temp,'humidity'=>$humidity,'air_pressure'=>$air_pressure,'wind_speed'=>$wind_speed,'D_10'=>$D_10,'D2_5'=>$D2_5,'NO'=>$NO,'No_x'=>$No_x,'SO_2'=>$SO_2,'dt'=>$dt);
        $data[]=array('data'=>$response);
  }
}
  else{
    $response['error']="400";
    $response['message']="Data does not exist";

  }
  echo json_encode($response);
  
 

?>