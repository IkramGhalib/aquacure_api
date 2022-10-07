<?php
      function search_arr($data, $key){
      for ($a=0; $a < sizeof($data); $a++) { 
        if ($data[$a][0] == $key) {
        return $a;
        }
      } 
      return -1;
    }
    require_once("opendb.php");
    $from = $_POST['fromdate'];
    $to = $_POST['todate'];
    $interval = new DateInterval('P1D');
    $realEnd = new DateTime($to);
    $realEnd->add($interval);
    $realto = $realEnd->format('Y-m-d');

    $trans = "SELECT `trid`,`twid`,`name`,`zone`,`uc`,`nc`,`location`, discharge, flowmeter FROM `transformer`";

              // echo $trans;

              $trans_result = $conn -> query($trans) or die(error);

              $pumps = array();
              foreach ($trans_result as $key) {
                array_push($pumps, array($key['trid'],$key['twid'],$key['name'],$key['zone'],$key['uc'],$key['nc'],$key['location'],0,0,0,0,0,$key['discharge'],$key['flowmeter'],0));
              }
                //   code  by ikram for kwh consumation
                  $kwh = "select trid, sum(kwh) as kwh_total from tbl_kwh where date between '".$from."' and '".$to."' group by trid";
                   // echo $kwh;
                  $result = $conn -> query($kwh) or die(error);
                  foreach($result as $row){
                    $index = search_arr($pumps, $row['trid']);
                    if ($index != -1) {
                      $pumps[$index][7] = $row['kwh_total'];
                    }
                  }
                  $rh="SELECT tid, sum(TIME_TO_SEC(rh)/60) as total_min, sum(on_off_events) as ofe, avg(signal_strength) ss FROM `tbl_rh` where datetime between '".$from."' and '".$to."' group by tid ";
              // echo $rh;
              $result = $conn -> query($rh) or die(error);
              foreach($result as $row){
                $index = search_arr($pumps, $row['tid']);
                $pumps[$index][8] = round($row['total_min']);
                $pumps[$index][9] = round($row['ofe']);
                $pumps[$index][14] = round($row['ss']);



              }

              $water_pumped = "select pump_id, max(water_pumped) maxv, min(water_pumped) minv from fm_logs where datetime between '".$from."' and '".$realto."' group by pump_id";
              // echo $water_pumped;
              $result = $conn -> query($water_pumped) or die(error);
              foreach ($result as $row) {
                $index = search_arr($pumps, $row['pump_id']);
                if ($index != -1) {
                  $pumps[$index][10] = round($row['maxv'],2);
                  $pumps[$index][11] = round($row['minv'],2);
                 
                }
              }
              for ($d=0; $d < sizeof($pumps); $d++) { 
                $temp = round($pumps[$d][10]-$pumps[$d][11],2);
              }
              echo json_encode($pumps[$d][7]);
             
            
              ?>