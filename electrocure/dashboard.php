
<?php

require_once 'opendb.php';

if($conn){

    $cid=$_POST['cid'];
    
    $sql="SELECT * from connections where owner='$cid' or occupant='$cid'";
    $resc = $conn->query($sql) or die($conn->error);
    // $response=array();
    if(mysqli_num_rows($resc)>0){
        while($row = $resc->fetch_assoc()){
            $connection=$row['cid'];
            $c1=$row['c1'];
            $c2=$row['c2'];
            $c3=$row['c3'];
            $v1=$row['v1'];
            $v2=$row['v2'];
            $v3=$row['v3'];
            $current=($row['c1']+$row['c2']+$row['c3']/3);
            $voltage=($row['v1']+$row['v2']+$row['v3']/3);
            $avg_pf=($row['pf1']+$row['pf2']+$row['pf3']/3);
            $kva1 = round($row['c1'] * $row['v1']/1000,2);
            $kva2 = round($row['c2'] * $row['v2']/1000 ,2);
            $kva3 = round($row['c3'] * $row['v2']/1000 ,2);
            $totalKVA  = round(($kva1 + $kva2 + $kva3),2);
            $response['error']="200";
            $response['message']="Data fetch Success";
            $data[]=array('connection'=>$connection,'Shop'=>$row['occupant'],'c1'=>$c1,'c2'=>$c2,'c3'=>$c3,'v1'=>$v1,'v2'=>$v2,'v3'=>$v3,'avg_voltage'=>$voltage,'avg current'=>$current,'last pulse'=>$row['datetime'],'avg_pf'=>$avg_pf,'kva1'=>$kva1,'kva2'=>$kva2,'kva3'=>$kva3,'total_kva'=>$totalKVA); 

        }
    }
    else{
        $response['error']="400";
        $response['message']="Does not show Data";
    }
    echo json_encode($data);
}


 

//   $cid=$_POST['cid'];
// //   $password=$_POST['password'];
//   // select cidi,assgnee_name,billing_method from connections where cid = :username and password = :pass
 
//   $checksql="select connections.*, billing_postpaid.current_reading, paid_on from connections, billing_postpaid where bill_id in (select max(bill_id) from billing_postpaid group by cid) and billing_postpaid.cid = connections.cid and connections.cid ='$cid'";
 
//   $result=mysqli_query($conn,$checksql);
 
 
 
//   if(mysqli_num_rows($result)>0){ 
 
//     $sql="select connections.*, billing_postpaid.current_reading, paid_on from connections, billing_postpaid where bill_id in (select max(bill_id) from billing_postpaid group by cid) and billing_postpaid.cid = connections.cid and connections.cid ='$cid'";
//     // echo $checkUserquery;
//     $resultant=mysqli_query($conn,$sql);
 
//     if(mysqli_num_rows($resultant)>0){
 
//       while($row=$resultant->fetch_assoc())
       
//       $response['user']=$row;
//       $response['error']="200";
//       $response['message']="data fetch success";
//     }
//     else{
//       $response['error']="400";
//       $response['message']="Wrong credentials";
 
//     }
    
     
//   }
//   else{
 
//     $response['error']="400";
//     $response['message']="Data does not exist";
 
 
//   }
 
//   echo json_encode($response);
     

?>