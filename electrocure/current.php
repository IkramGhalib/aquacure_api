<?php
require_once 'opendb.php';
if($conn){

$cid=$_POST['cid'];

$sql="SELECT cid,c1,c2,c3,owner,occupant from connections where owner='$cid' or occupant='$cid'";
$resc = $conn->query($sql) or die($conn->error);
// $response=array();
if(mysqli_num_rows($resc)>0){
    while($row = $resc->fetch_assoc()){
        $connection=$row['cid'];
        $owner=$row['owner'];
        $occupant=$row['occupant'];
       
        $c1=$row['c1'];
        $c2=$row['c2'];
        $c3=$row['c3'];
        $current=($row['c1']+$row['c2']+$row['c3']/3);
       
        $response['error']="200";
        $response['message']="Data fetch Success";
        $data=array('connection'=>$connection,'owner'=>$owner,'occupant'=>$occupant,'c1'=>$c1,'c2'=>$c2,'c3'=>$c3,'current'=>$current); 

    }
}
else{
    $response['error']="400";
    $response['message']="Does not show Data";
}
echo json_encode($data);
}
?>