<?php
require_once('opendb.php');
//action from url
// $hostname="localhost";
// $username="root";
// $dbpassword="";
// $dbname="wssp_database";

// $conn=mysqli_connect($hostname,$username,$dbpassword,$dbname);
$offlineTime = 120;

// $action=$_GET['action'];

// if($action=='s_device'){

//  $query=""
    $query="SELECT trid,name,uc,nc,location,peak,offpeak,datetime FROM transformer";
    // echo $query;
    $result=mysqli_query($conn,$query);
    $rowCount=mysqli_num_rows($result);
    // echo $rowCount;

    if($rowCount>0){
        $device=array();
        while($row=mysqli_fetch_assoc($result)){
          $currenttime = strtotime(date('Y-m-d H:i:s'));
          $datetime = substr($row['datetime'],2);
          $datetime = strtotime($datetime);
          $date = date('Y-m-d H:i:s',$datetime);
          $lasttime=strtotime($date); 
          $timediff = ceil(abs($currenttime-$lasttime)/60);
          if($row['datetime']<=$timediff){

          }
          $device[]=$row;
            // echo $device[];
             $deviceData=$device;

        }
    }
    else{
        $deviceData=array('status'=>false,'device'=>$device);

    }

    echo json_encode($device);




// }



?>