<?php
require_once 'opendb.php';
if($conn){

$cid=$_POST['cid'];

$sql="SELECT cid,v1,v2,v3,owner,occupant from connections where owner='$cid' or occupant='$cid'";
$resc = $conn->query($sql) or die($conn->error);
// $response=array();
if(mysqli_num_rows($resc)>0){
    while($row = $resc->fetch_assoc()){
        $connection=$row['cid'];
        $owner=$row['owner'];
        $occupant=$row['occupant'];
       
        $v1=$row['v1'];
        $v2=$row['v2'];
        $v3=$row['v3'];
        $voltage=($row['v1']+$row['v2']+$row['v3']/3);
       
        $response['error']="200";
        $response['message']="Data fetch Success";
        $data=array('connection'=>$connection,'owner'=>$owner,'occupant'=>$occupant,'v1'=>$v1,'v2'=>$v2,'v3'=>$v3,'avg_voltage'=>$voltage); 

    }
}
else{
    $response['error']="400";
    $response['message']="Does not show Data";
}
echo json_encode($data);
}
?>