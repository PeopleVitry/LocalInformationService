<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta charset="UTF-8" />
		<title>Titre de votre page</title>
		    <script src="jquery/js/jquery-1.9.0.js"></script>
		<style type="text/css">
			html {
				height: 100%
			}
			body {
			
				width:90%;
				height: 100%;
				margin: 0 auto;
				padding: 0;
				margin-top : 50px;
				
			}
			#EmplacementItineraireCarte{
				height: 90%;
				width:60%;
				float : left;
			}
		 #EmplacementItineraireTexte {
			 	height: 90%
				width:40%;
			}
		</style>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>	
		<script type="text/javascript">
		  $(function() {
		  var latD = $("#latD").val();
			var latA = $("#latA").val();
			var longD = $("#longD").val();
			var longA = $("#longA").val();

		
		  
			function initialisation(){
			  
					var Depart = new google.maps.LatLng(latD, longD);
				var Arrive = new google.maps.LatLng(latA, longA);
				var optionsCarte = {
					zoom: 8,
					center: Depart,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				var itineraireCarte = new google.maps.Map(document.getElementById("EmplacementItineraireCarte"), optionsCarte);
				/**
				 * Moteur de rendu
				 */
				var optionsItineraireAffichage = {
					map: itineraireCarte,
					panel: document.getElementById("EmplacementItineraireTexte")
				}
				var itineraireAffichage = new google.maps.DirectionsRenderer(optionsItineraireAffichage);
				/**
				 * Service itinéraire
				 */
				var itineraireService = new google.maps.DirectionsService();
				/**
				 * Objet littéral
				 */
				 var itineraireRequete = {
	
					origin: new google.maps.LatLng(latD, longD),
					destination: new google.maps.LatLng(latA, longA),
					travelMode: google.maps.TravelMode.WALKING
				}
				/**
				 * Envoie la requête vers les serveurs Google (Asynchrone)
				 */
				itineraireService.route(itineraireRequete, function(itineraireResultat, itineraireCodeStatut) {
					/**
					 * Si le résultat est valide on demande au moteur de rendu
					 * d'utiliser ce résultat pour mettre à jour l'affichage
					 * de l'itinéraire ( carte + roadbook)
					 */
					if (itineraireCodeStatut === google.maps.DirectionsStatus.OK) {
						 itineraireAffichage.setDirections(itineraireResultat);
					/**
					 * Sinon on affiche le code erreur
					 */
					}else{
						alert('Erreur : ' + itineraireCodeStatut);
					}
				});
			}
			google.maps.event.addDomListener(window, 'load', initialisation)
			});
		</script>
	</head>
	<body>
<?php	
  echo	'<input type="hidden" name="latD" id="latD" value="'.$_GET["departLat"].'">
				<input type="hidden" name="latA" id="latA" value="'.$_GET["arriveLat"].'">
				<input type="hidden" name="longD" id="longD" value="'.$_GET["departLong"].'">
				<input type="hidden" name="longA" id="longA" value="'.$_GET["arriveLong"].'">'; ?>

	
		<div id="EmplacementItineraireCarte"></div>
		<div id="EmplacementItineraireTexte"></div>
		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>
	</body>
</html>
