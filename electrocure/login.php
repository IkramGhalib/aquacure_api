
<?php

require_once 'opendb.php';
 

  $cid=$_POST['cid'];
  $password=$_POST['password'];
  // select cidi,assgnee_name,billing_method from connections where cid = :username and password = :pass
 
  $checkUser="SELECT * FROM users WHERE userid='$cid'";
 
  $result=mysqli_query($conn,$checkUser);
 
 
 
  if(mysqli_num_rows($result)>0){ 
 
    $checkUserquery="select userid, name,owner,occupant from users where userid ='$cid' and password='$password'";
    // echo $checkUserquery;
    $resultant=mysqli_query($conn,$checkUserquery);
 
    if(mysqli_num_rows($resultant)>0){
 
      while($row=$resultant->fetch_assoc())
       
      $response['user']=$row;
      $response['error']="200";
      $response['message']="login success";
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