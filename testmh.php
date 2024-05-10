
<?php
  include 'database.php'; 
  $resultat = mysqli_query($kobling,"Select Monster.navn, Element.weakness, DamageChart.idDamageChart, DamageChart.Head, DamageChart.Neck, DamageChart.Back,
DamageChart.Abdominal, DamageChart.Tail, DamageChart.Wings, DamageChart.Legs From Monster
Join Monster_has_Element On idMonster = Monster_idMonster
Join Element On Element_idElement = idElement
Join DamageChart_has_Element ON DamageChart_has_Element.Element_idElement = idElement
Join DamageChart ON idDamageChart = DamageChart_idDamageChart");

	
	$Monsters = array();
	$Monsters = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
  ?>
  
  <?php
  foreach ($Monsters as $rad) {
		echo $rad['navn'].": ";
		echo $rad['weakness']." ";
		echo $rad['Head']." ";
		echo $rad['Neck']." ";
		echo $rad['Back']." ";
		echo $rad['Abdominal']." ";
		echo $rad['Tail']." ";
		echo $rad['Wings']." ";
		echo $rad['Legs']."<br>";
	}
  ?>