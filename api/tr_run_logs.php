
<?php
require_once 'opendb.php';

  $id=$_POST['id'];
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate'];
  $query="SELECT `tid`,time_to_sec(`rh`)/60 as rmin,`on_off_events`,`signal_strength`,tbl_rh.`datetime`, twid, zone, uc, nc, name, location FROM `tbl_rh`, transformer WHERE transformer.trid = tid and tbl_rh.datetime between '".$fromdate."' and '".$todate."' and tid = '".$id."'";
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