<?php
      if(isset($_GET['status'])){
        $status = $_GET['status'];
      }
      else{
        $status = "all"; 
      
      }
        date_default_timezone_set("Asia/Karachi");
        include_once("../opendb.php");
        $offlineTime = 120;

        $query = "select * from transformer order by CONVERT(SUBSTRING(transformer.trid,6,3),UNSIGNED INTEGER) asc";
        // echo $query;
        $result = $conn -> query($query) or die("Query error");
        // echo $result;
        $values = array();
        $splitval = array();
        $onc = 0;
        $offc = 0;
        $offlc = 0;
        $allc = 0 ;
        foreach ($result as $row) {
          $count =0 ;
          $avgVoltage  = round(($row['v1'] + $row['v2'] + $row['v3'])/3 ,2);
          $sumCurrent = round(($row['c1']+ $row['c2'] + $row['c3']),2);
          $NC = 0;
          $kva1 = round(($row['c1'] * $row['v1'])/1000,2);
          $kva2 = round(($row['c2'] * $row['v2'])/1000 ,2);
          $kva3 = round(($row['c3'] * $row['v3'])/1000 ,2);
          $totalKVA  = round(($kva1 + $kva2 + $kva3),2);
          

          $avgPf = round(($row['pf1']+$row['pf2']+$row['pf3'])/3,2);
          
          if ($avgPf < 0.78)
          {
            $avgPf =max($row['pf1'],$row['pf2'],$row['pf3']);
            if($avgPf < 0.78)
              $avgPf = 0.78;
            //   echo $avgPf.'<br>';
          }
          
          $currenttime = strtotime(date('Y-m-d H:i:s'));
          
          $datetime = substr($row['datetime'],2);
          $datetime = strtotime($datetime);
          $date = date('Y-m-d H:i:s',$datetime);
          $lasttime=strtotime($date); 
          $timediff = ceil(abs($currenttime-$lasttime)/60);
          
          
          $pump_power = $row['kva_capacity']*0.7457;
          $highPhaseCurrent = ($pump_power *1000)/(3*230*0.86);
          $lowPhaseCurrent =  $highPhaseCurrent * 0.2;

          $switchTime = "";


          if ($timediff <= $offlineTime){

            if ($row['status'] == "On"){
              $onc = $onc + 1;
              $switchTime = $row['switch_ontime'];
              
            }
            else{
              $offc = $offc +1;
              $switchTime = $row['switch_offtime'];
            }
          }
          else{
            $offlc = $offlc + 1;
            $switchTime = $row['datetime'];
          }
        //   $signal = $row['ss']/60*100;
        $new=array();
          array_push($values, array($row['trid'],$row['name'], $avgVoltage, $sumCurrent, $NC, $totalKVA, $avgPf,$row['datetime'],$timediff, $pump_power, $highPhaseCurrent, $lowPhaseCurrent, $row['cause'],$switchTime, $row['twid'], $row['zone'], $row['uc'], $row['nc'], $row['location'], $row['twid'], $switchTime));
           

          array_push($splitval,array($row['trid'],$row['v1'],$row['v2'],$row['v3'],$row['c1'],$row['c2'],$row['c3'],$row['pf1'],$row['pf2'],$row['pf3'],$row['status']));
        //   print_r($splitval).'<br>';


    }
    
                $ona = 0;
                $offa = 0;
                $offla = 0;
                $count = sizeof($values);
                //echo $count;
                if(sizeof($values) > 0)
                {
                  for ($i=0; $i < $count ; $i++) {


                    if($values[$i][8] <= $offlineTime){
                      if ($splitval[$i][10] == "On") {
                        $color = "bg-green";
                        $state = "On";
                      }else {
                        $color = "bg-blue";
                        $state = "Off";
                      }
                                         
                            
                        }
                        else{
                          $color = "bg-red";
                          $state = "Offline"; 
                        }

                       
                        
                         if ($status === "ON" and ($state ==="Offline" or $state === "Off")) {
                            goto skip;
                        }elseif($status === "OFL" and ($state ==="Off" or $state === "On" or $state === "Under Voltage" or $state === "Over Voltage" or $state === "Link Down")) {
                            goto skip;
                        }elseif ($status === "OFF" and ($state ==="Offline" or $state === "On" or $state === "Under Voltage" or $state === "Over Voltage" or $state === "Link Down")) {
                            goto skip;   
                        }
                        
                      skip:
                   } 
                  
                    print_r($value);
                // echo json_encode($color);
                    
                }
                else
                {
                  echo "<b>No Transformers Added Yet!</b>";
                }
              ?>
                           


