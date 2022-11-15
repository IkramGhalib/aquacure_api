<?php
require_once 'opendb.php';
if($conn){

$cid=$_POST['cid'];

$sql="SELECT cid,c1,c2,c3,v1,v2,v3,owner,occupant from connections where owner='$cid' or occupant='$cid'";
$resc = $conn->query($sql) or die($conn->error);
// $response=array();
if(mysqli_num_rows($resc)>0){
    while($row = $resc->fetch_assoc()){
        $connection=$row['cid'];
        $owner=$row['owner'];
        $occupant=$row['occupant'];
       
        $kva1 = round($row['c1'] * $row['v1']/1000,2);
        $kva2 = round($row['c2'] * $row['v2']/1000 ,2);
        $kva3 = round($row['c3'] * $row['v2']/1000 ,2);
        $totalKVA  = round(($kva1 + $kva2 + $kva3),2);
        $current=($row['c1']+$row['c2']+$row['c3']/3);
        // current info
        $c1=$row['c1'];
        $c2=$row['c2'];
        $c3=$row['c3'];
        $current=($row['c1']+$row['c2']+$row['c3']/3);

        // voltage info
        $v1=$row['v1'];
        $v2=$row['v2'];
        $v3=$row['v3'];
        $voltage=($row['v1']+$row['v2']+$row['v3']/3);
       
        $response['error']="200";
        $response['message']="Data fetch Success";
        $data[]=array('connection'=>$connection,'owner'=>$owner,'occupant'=>$occupant,'kva1'=>$kva1,'kva2'=>$kva2,'kva3'=>$kva3,'totalKVA'=>$totalKVA); 

    }
}
else{
    $response['error']="400";
    $response['message']="Does not show Data";
}
echo json_encode($data);
}
?>