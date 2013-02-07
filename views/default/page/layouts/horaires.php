<?php function AfficheSource($url) {

    if ($ouverture = @fopen($url, "rb")) {
        if ($lecture = stream_get_contents($ouverture)) {
            $pos = strpos($lecture, 'mn<');
            $inf = substr($lecture, $pos - 3, 5);
            if (strpbrk($inf, '<')) {
                $inf = strtr($inf, '<', ' ');
            }
            if (strpbrk($inf, '>')) {
                $inf = strtr($inf, '>', ' ');
            }
            return $inf;
        }
    }
    @fclose($ouverture);
}?>

<?php
//IUT
$latitude="48.776824";
$longitude="2.376373";
//Cantine
//$latitude="48.781886";
//$longitude="2.398174";

$maxLong = $longitude + 0.007;
$minLong = $longitude - 0.007;
$maxLat	 = $latitude + 0.007;
$minLat	 =$latitude - 0.007;
try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=vitrydb', 'root', '');
			$req = $bdd->prepare("SELECT * FROM station WHERE latitude > ? AND latitude < ? AND longitude > ? AND longitude < ?");
			$req->execute(array($minLat, $maxLat, $minLong, $maxLong));
			
     		while($donnees = $req->fetch()){
				
				$sql = $bdd->prepare("SELECT bus.num_bus, bus_station.key_ratp, bus.code_direction, bus.direction FROM bus, bus_station WHERE ( bus.id_bus = bus_station.id_bus AND bus_station.id_station =?)");
				$sql->execute(array($donnees["id_station"]));
				
				echo '<div>'.$donnees["nom_station"].' ('.$donnees["adresse"].')'.'</div >';
				echo '<div>';
				echo '<ol>';
				while($databus = $sql->fetch()){
				 $url="http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B".$databus["num_bus"]."/".$databus["key_ratp"]."/".$databus["code_direction"];
					echo '<li> <img src="mod/LocalInformationService/graphics/'.$databus["num_bus"].'.png"/>'.' '.$databus["direction"].' :' . AfficheSource($url)."</li>";
					
				}
				echo '</div>';
				echo '</ol>';
			
			}
			$reponse["taille"] = $i ;		
		}
		catch(Exception $e)
		{
		  die('Erreur : '.$e->getMessage());
		  $reponse["erreur"] = 1;
		  header('Content-Type: application/json');
		  echo json_encode($reponse);

		}

?>
  <p style="clear:both;"></p>
     
       