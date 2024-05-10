<?php
include_once 'config.php';

	$Name = $_POST['Navn'];
	$fireWeakness = $_POST['3'];
	//array_push($weaknessList, $fireWeakness);
	$thunderWeakness = $_POST['1'];
	$waterWeakness = $_POST['2'];
	$iceWeakness = $_POST['5'];
	$dragonWeakness = $_POST['4'];
	$weaknessList = array($thunderWeakness, $waterWeakness, $fireWeakness, $dragonWeakness, $iceWeakness);



	$idquery = mysqli_query($db, "SELECT MAX(idDamageChart) FROM DamageChart");
	$idpluss = mysqli_fetch_array($idquery);
	$newidDC = $idpluss[0] +1;

	$idquery = mysqli_query($db, "SELECT MAX(idMonster) FROM Monster");
	$idpluss = mysqli_fetch_array($idquery);
	$newidM = $idpluss[0] +1;

 	$sql1 = "INSERT INTO Monster (idMonster, Navn) VALUES ('$newidM', '$Name')";
	mysqli_query($db, $sql1);
	//$sql2 = "INSERT INTO DamageChart (idDamageChart, One_Star, Two_Stars, Three_Stars, Monster_idMonster, Elements_idElements)
	//VALUES ('$newidE', '$Weakness', '$OneStar', '$TwoStars', '$ThreeStars', '$newidM', '$')";
	$weaknessId = 1;
	foreach ($weaknessList as $element) {
		if($element == 1){
			$sql2 = "INSERT INTO DamageChart (idDamageChart, One_Star, Two_Stars, Three_Stars, Monster_idMonster, Elements_idElements)
			VALUES ('$newidDC', 'Yes', 'X', 'X', '$newidM', '$weaknessId')";
		} elseif ($element == 2) {
			$sql2 = "INSERT INTO DamageChart (idDamageChart, One_Star, Two_Stars, Three_Stars, Monster_idMonster, Elements_idElements)
			VALUES ('$newidDC', 'X', 'Yes', 'X', '$newidM', '$weaknessId')";
		} elseif ($element == 3) {
			$sql2 = "INSERT INTO DamageChart (idDamageChart, One_Star, Two_Stars, Three_Stars, Monster_idMonster, Elements_idElements)
			VALUES ('$newidDC', 'X', 'X', 'Yes', '$newidM', '$weaknessId')";
		}
		if($element==1 || $element==2 || $element==3){
       	mysqli_query($db, $sql2);
      }
			$weaknessId++;
  }
	if($sql1 && $sql2){
		header("location: MWeak.php?Insert=success");
	}
	else{
			header("location: MWeak.php?Insert=failure");
	}

		if(isset($_GET["Insert"])){
			$statusMessage = $_GET["Insert"];
			echo $statusMessage;
			if($statusMessage == "success"){
				echo "<p>Success!
				<br/>
				The new monster is added to the database.
				</p>";
			}
			elseif ($statusMessage == "failure"){
					echo "<p>Insert failed</p>";
				}
		}
?>
