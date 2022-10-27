<?php
require_once 'opendb.php';

$device_id=$_POST['device_id'];
  
 
  $query="SELECT c1,c2,c3 FROM transformer WHERE trid='$device_id'";
 
  $result=mysqli_query($conn,$query);
 
 
 
  if(mysqli_num_rows($result)>0){ 
 
    $checkquery="SELECT c1,c2,c3 FROM transformer WHERE trid='$device_id'";
    // echo $checkUserquery;
    $resultant=mysqli_query($conn,$checkquery);
 
    if(mysqli_num_rows($resultant)>0){
        // $response=array();
 
      while($row=$resultant->fetch_assoc()){
        $response['current']=$row;
      // $response['error']="200";
      // $response['message']="fetch success";

      }
    }
    else{
      $response['error']="400";
      $response['message']="Wrong credentials";
 
    }
    
     
  }
  else{
 
    $response['error']="400";
    $response['message']="user does not exist";
 
 
  }
 
  echo json_encode($response);
     


?>