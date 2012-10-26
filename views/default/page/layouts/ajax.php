<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	
</head>  
    <body>
       <div id="fb-root"></div>
        <script>
            (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
            }
            (document, 'script', 'facebook-jssdk'));
        </script>
        <script>!
                function(d,s,id){
                var js,fjs=d.getElementsByTagName(s)[0];
                if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}
            }
            (document,"script","twitter-wjs");
        </script>
	
		<h2>
            <center> Semantic search </center> 
        </h2>
		
		
                  <center style ='font-size: large', color='red';>           
                       
					
			
<form name="form1" method="post">
<p>
<label for=" "></label></br> 

<select id="code" name="objet" onchange="form.submit()"  >
	<option value="-1" > Choisir un objet </option>
	<?php
	//Connexion à la base de données
	 $connection= mysql_connect("localhost", "root", "");
	 if (!$connection){
			die('Could not connect: ' . mysql_error());
		}
	mysql_select_db("vitrydb", $connection);
	$sql =  "select libelle, code from objet where type='service'";
				
		$res 	= mysql_query($sql);
			while ($donnees= mysql_fetch_array($res))
			{
			if(isset($_POST["objet"]) && $_POST["objet"] == $donnees['code'] )
			  {
				$selected = "selected";
			  }
			else
			  {
			  $selected = "";
			  }		
			   echo "<option value='".$donnees['code']."' $selected>".$donnees['libelle']."</option>";
			}
	?>
</select>
 

  
 <!-- afficher les differents services choisis -->

<p>
<label for=" "></label></br> 
<select id="choix" name="service"   onchange="form.submit()"  >
<option value="" > Choisir un type </option>
		<?php
		//Connexion à la base de données
		$cod=$_POST['objet'];

		 $connection= mysql_connect("localhost", "root", "");
		 if (!$connection){
				die('Could not connect: ' . mysql_error());
			}
		mysql_select_db("vitrydb", $connection);

		$sql = " select type_class ,numero from class inner join objet on class.objet_code=objet.code where  objet_code='$cod'";
				
			//execution de la requete 
			$res 	= mysql_query($sql);
				while ($donnees= mysql_fetch_array($res))
				  {
					if(isset($_POST["service"]) && $_POST["service"] == $donnees['numero'] )
					 {
					   $selected = "selected";
					 }
					else
					 {
					  $selected = "";
					 }	
			?>
							<option value='<?php echo $donnees['numero'] ?>' <?php echo $selected; ?>> 
					<?php echo  $donnees['type_class']; ?> 
					</option>
             
			 <?php
         }
             ?>
</select>

</p>


<p>
<label for=" "></label></br> 
<select id="choix" name="log" onchange="form.submit()" >
<option value="-1" > Choisir un Nom </option>

		<?php
		//Connexion à la base de données

		$num=$_POST['service'];
		 $connection= mysql_connect("localhost", "root", "");
		 if (!$connection){
				die('Could not connect: ' . mysql_error());
			}
		mysql_select_db("vitrydb", $connection);

		$sql = 
			"select id,nom,adresse,telephone,latitude,longitude from interface inner join class on 
			 interface.class_numero=class.numero where 
					class.numero='$num'
			";
			
			$res 	= mysql_query($sql);
				while ($donnees= mysql_fetch_array($res))
				  {
					if(isset($_POST["log"]) && $_POST["log"] == $donnees['id'] )
					 {
					   $selected = "selected";
					 }
					else
					 {
					  $selected = "";
					 }	
				?>
					  <option  value=' <?php echo $donnees['id'] ?>' <?php echo $selected; ?> > 
					   <?php
						   echo $donnees['nom'];
						   echo $donnees['adresse'];
						   echo $donnees['telephone'];		   
					   ?>
					   </option>
							 
							 
					 
					 <?php
				 }	 
		?>
</select>
<!--<input type="submit" value="Rechercher"  id="choix" >-->

</form>
 <div id="carte" style="width:100%; height:100%"></div>
    
					    </center>    
                  
                    
		<center>
		<?php 
            
			$iden=$_POST['log'];
		
 $connection= mysql_connect("localhost", "root", "");
 if (!$connection){
  		die('Could not connect: ' . mysql_error());
  	}
mysql_select_db("vitrydb", $connection);
$sql= "select latitude,longitude ,adresse from interface where id='$iden'"; 
$res 	= mysql_query($sql);
		while ($donnees= mysql_fetch_array($res))
		    {
		 $x=$donnees['latitude'];
	     $y=$donnees['longitude'];
			$z=$donnees['adresse'];
			}
		?>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
			function initialiser() {
				var latlng = new google.maps.LatLng(<?php echo $x?> ,<?php echo $y?>);
				//objet contenant des propriétés avec des identificateurs prédéfinis dans Google Maps permettant
				//de définir des options d'affichage de notre carte
				var options = {
					center: latlng,
					zoom: 19,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				//constructeur de la carte qui prend en paramêtre le conteneur HTML
				//dans lequel la carte doit s'afficher et les options
				var carte = new google.maps.Map(document.getElementById("carte"), options);
				
				//création du marqueur
                  var marqueur = new google.maps.Marker({
		          position: new google.maps.LatLng( <?php echo $x?> ,<?php echo $y?>),
                   map: carte
	             });
	
	/****************Nouveau code****************/

	//rendre le marqueur "déplaçable"
	marqueur.setDraggable(true);
	
	google.maps.event.addListener(marqueur, 'dragend', function(event) {
		//message d'alerte affichant la nouvelle position du marqueur
         alert("La nouvelle coordonnée du marqueur est : "+event.latLng);
	});
			}
			window.onload = function()
			{
			initialiser();
			}
		</script>
		
		   <footer  style='text-align: center;'>
                <div id="tweet">
                    <h2> </h2>
			<img src="images/sanfrancisco.jpg" alt="Logo de Zozor" id="logo" />
					
                </div>
				<p  style='text-align:right;'> <strong>all rights reserved</strong></p>
        
            </footer>
			
       
             
        

    </body>


</html>