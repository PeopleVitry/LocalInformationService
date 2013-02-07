<?php
//http://127.0.0.1/Geolocalisation/script.php?latitude=48.7936&longitude=2.39472

if(isset($_GET["latitude"]) AND !empty($_GET["latitude"]) AND isset($_GET["longitude"]) AND !empty($_GET["longitude"])){
$reponse["erreur"] = 0;
$maxLong = $_GET["longitude"] + 0.009;
$minLong = $_GET["longitude"] - 0.009;
$maxLat	 = $_GET["latitude"] + 0.009;
$minLat	 =$_GET["latitude"] - 0.009;
try
		{
		$bdd = new PDO('mysql:host=localhost;dbname=vitrydb', 'root', '');
		$req = $bdd->prepare("SELECT * FROM station WHERE latitude > ? AND latitude < ? AND longitude > ? AND longitude < ?");
		$req->execute(array($minLat, $maxLat, $minLong, $maxLong));

			$i=0;
			
     		while($donnees = $req->fetch()){
				$sql = $bdd->prepare("SELECT bus.num_bus FROM bus,bus_station WHERE(bus.id_bus = bus_station.id_bus AND bus_station.id_station = ?)");
				$sql->execute(array($donnees["id_station"]));
				$bus="Bus: ";
				while($databus = $sql->fetch()){
				$bus=$bus.$databus["num_bus"].' ';
				}
				
				$reponse["latitude"][$i] = $donnees["latitude"];
				$reponse["longitude"][$i] = $donnees["longitude"];
				$reponse["info"][$i] = '<a href="itineraire.php?departLat='.$_GET["latitude"].'&departLong='.$_GET["longitude"].'&arriveLat='.$donnees["latitude"].'&arriveLong='.$donnees["longitude"].'">Itinéraire</a><p>'.$donnees["adresse"].'</p><p>'.$bus.'</p>';
				
				$i++;
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
}else{
$reponse["erreur"] = 1;

}



header('Content-Type: application/json');
echo json_encode($reponse);



?>
