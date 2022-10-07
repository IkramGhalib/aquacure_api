
<?php
require_once 'opendb.php';

  $id=$_POST['id'];
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate'];
  $query="SELECT tr_current_logs.*, transformer.name, transformer.twid, zone, uc, nc FROM tr_current_logs ,transformer WHERE tr_current_logs.trid = transformer.trid and tr_current_logs.trid = '".$id."' AND tr_current_logs.datetime BETWEEN '".$fromdate."' AND '".$todate."' order by datetime desc";
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