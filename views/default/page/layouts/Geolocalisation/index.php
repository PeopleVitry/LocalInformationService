<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="utf-8">
    
    <script src="jquery/js/jquery-1.9.0.js"></script>
    <style type="text/css">
      body { height: 500px; margin: 0; padding: 0;
}
      #map_canvas { height: 100%; width : 100%;}

      </style>
    <script type="text/javascript"      src="https://maps.googleapis.com/maps/api/js?sensor=true&amp;key=AIzaSyCjGHqba8wJl9XJ25oE5B6rmRoJxfYeZVA">
    </script>

    
    
      <script type="text/javascript">
  $(function() {
 
 
function maPosition(position) {
  
    map = new google.maps.Map(document.getElementById("map_canvas"), {
        zoom: 16,
        center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }); 

	var infowindow = new google.maps.InfoWindow();
    var marker, i;
	  
   $.getJSON("script.php",  
    {"latitude" : position.coords.latitude , "longitude" : position.coords.longitude},
    function(data){
		//alert(data);
		//alert("1");
		if(data.erreur==0){
			//alert("2");
			//afficher les localisation des abris bus renvoyer par le scripte php
			//alert("data.taille  ="+data.taille);
			for(var i=0;i < data.taille; i++){
				//alert("1i");
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(data.latitude[i], data.longitude[i]),
					map: map,
					icon : "http://www.ratp.fr/horaires/images/networks/bus.png"
					});

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(data.info[i]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
    }	
    
		}else{
			//Une Erreur c'est produite !!
			alert("Une Erreur c'est produite !!");
		}
  });
   
   //position du client!!
       marker = new google.maps.Marker({
        position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent("Votre position");
          infowindow.open(map, marker);
        }
      })(marker, i));

   
   
}

 
if (navigator.geolocation){
    navigator.geolocation.getCurrentPosition(maPosition);
}else{
  alert("Votre navigateur ne prend pas en compte la géolocalisation HTML5");    
  
 }
function successCallback(position){
  map.panTo(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
  var marker = new google.maps.Marker({
    position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude), 
    map: map
  }); 
}


function itineraire(){
    origin      = document.getElementById('origin').value; // Le point départ
    destination = document.getElementById('destination').value; // Le point d'arrivé
    if(origin && destination){
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Mode de conduite
        }
        var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
        directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
            if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
            }
        });
    }
};




});

</script>

    
    
  </head>
<body >    

    <!-- Un élément HTML pour recueillir l’affichage -->

<div id="map_canvas"></div>



  </body>
</html>
