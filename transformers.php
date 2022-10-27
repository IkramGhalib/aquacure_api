<?php
	// Code by Mansoor Khan, Research Assocate NCAI UET Peshawar

	if (isset($_GET['subdivid'])) {
		$subdivid = $_GET['subdivid'];
		if (isset($_GET['api'])) {
			$api = $_GET['api'];
			if ($api == "ftrv10") {
				if (isset($_GET['sf'])) {
					$sf = $_GET['sf'];
					if ($sf == 'all') {
						$query = "select * from transformer";
					}else{
						$query = "select * from transformer where trid = '".$sf."'";
					}
					$conn = dbconn($subdivid);
					$result = $conn -> query($query) or die(error);
					$data = array();
					foreach ($result as $row) {
						array_push($data, $row);
					}
					header("Content-Type: application/json");
					echo json_encode($data);
					//print_r($data);
			
				}else{
					echo "Error 4: Selection flag missing";
				}
			}else{
				echo "Error 3: Invalid API Flag";
			}
		}else{
			echo "Error 2: API Flag missing";
		}			
	}else{
		echo "Error 1: subdivid missing!";
	}


	function dbconn($subdivid){
		$servername = "10.13.144.6";
		$username = "user_".$subdivid;
		$password = "Adm1n@".$subdivid;
		$dbname = "wssp_".$subdivid;

		$servername = "localhost";
		$username = "root";
		$password = "";
		// $dbname = "wssckht";

		try {
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo  $e->getMessage();
		}
		return $conn;
	}
	

?>