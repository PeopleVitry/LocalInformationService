<style type="text/css">
    .elgg-inner {
        width: 100%;
        margin: 0 auto;}
    #container {
        position: absolute;
    }
    .zoom {
        margin-left: 8px;
        margin-top: 10px;
        border: 1px solid black;
    }

    .levelPlan {
        margin-left:3em;
        width: 600px;
        height: 380px;
        border: 1px solid #EDBD4E;
    }

    .levelPlan h6 {
        background: #EDBD4E;
        color: #222;
        -moz-border-radius: 10px 10px 0 0;
        -webkit-border-radius: 10px 10px 0 0;
        border-radius: 10px 10px 0 0;
    }

    .levelInfo {
        margin-left:3em;
        width: 600px;
        height: 400px;
        border: 1px solid #7AE37B;
    }

    .levelInfo h6 {
        background: #7AE37B;
        color: #222;
        -moz-border-radius: 10px 10px 0 0;
        -webkit-border-radius: 10px 10px 0 0;
        border-radius: 10px 10px 0 0;
    }

    .levelBus {
        margin-left: 30px;
        width: 500px;
        height: 180px;
        border: 1px solid #24A691;
    }

    .levelBus h6 {
        background: #24A691;
        color: #fff;
        -moz-border-radius: 10px 10px 0 0;
        -webkit-border-radius: 10px 10px 0 0;
        border-radius: 10px 10px 0 0;
    }

    .levelAir {
        width:500px;
        margin-left: 30px;
        float: left;
        height: 180px;
        border: 1px solid #055A9F;
    }

    .levelAir h6 {
        background: #055A9F;
        color: #fff;
        -moz-border-radius: 10px 10px 0 0;
        -webkit-border-radius: 10px 10px 0 0;
        border-radius: 10px 10px 0 0;
    }

    .levelMeteo {
        float: left;
		margin-left: 30px;
        width:500px;
        height: 180px;
        border: 1px solid #FFFF82;
    }

    .levelMeteo h6 {
        background: #FFFF82;
        color: #222;
        -moz-border-radius: 10px 10px 0 0;
        -webkit-border-radius: 10px 10px 0 0;
        border-radius: 10px 10px 0 0;
    }

    .levelTrafic {
        width:500px;
        margin-left: 30px;
        height: 180px;
        border: 1px solid #001975;
    }

    .levelTrafic h6 {
        background: #001975;
        color: #fff;
        -moz-border-radius: 10px 10px 0 0;
        -webkit-border-radius: 10px 10px 0 0;
        border-radius: 10px 10px 0 0;
    }

    .levelPlan,.levelInfo,.levelBus,.levelAir,.levelMeteo,.levelTrafic {
        float: left;
        background: #FFF;
        -moz-border-radius: 15px;
        -webkit-border-radius: 15px;
        border-radius: 15px;
        cursor: pointer;
        box-shadow: 8px 10px 10px rgba(0, 0, 0, 0.5), inset 8px 10px 10px
            rgba(255, 255, 255, 0.75);
        -o-box-shadow: 8px 10px 10px rgba(0, 0, 0, 0.5), inset 8px 10px 10px
            rgba(255, 255, 255, 0.75);
        -webkit-box-shadow: 8px 10px 10px rgba(0, 0, 0, 0.5), inset 8px 10px
            10px rgba(255, 255, 255, 0.75);
        -moz-box-shadow: 8px 10px 10px rgba(0, 0, 0, 0.5), inset 8px 10px 10px
            rgba(255, 255, 255, 0.75);
    }

    .title {
        width: 100%;
        height: 25px;
        text-indent: 10px;
        color: #222;
        font-size: 1.2em;
    }
    /* Fixed Positioned AddThis Toolbox */
    .addthis_toolbox.atfixed {
        position: fixed;
        top: 10%;
        left: 20px;
        border: 1px solid #eee;
        padding: 5px 5px 1px;
        width: 32px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border-radius: 4px;
    }

    .addthis_toolbox .custom_images a {
        width: 32px;
        height: 32px;
        margin: 0;
        padding: 0;
        cursor: pointer;
    }

    .addthis_toolbox .custom_images a img {
        border: 0;
        margin: 0 0 1px;
        opacity: 1.0;
    }

    .addthis_toolbox .custom_images a:hover img {
        margin: 1px 0 0;
        opacity: 0.75;
    }
</style>

<script type="text/javascript" src="<?php echo elgg_get_site_url(); ?>/vendors/jquery/jquery.zoomooz.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".zoom").click(function(evt) {
            evt.stopPropagation();
            $(this).zoomTo();
        });
        $(window).click(function(evt) {
            evt.stopPropagation();
            $("body").zoomTo();
        });
        $("body").zoomTo();
    });
</script>

<script type="text/javascript">
    // Execution de cette fonction lorsque le DOM sera entièrement chargé
    $(document).ready(function() {
        // Masquage des réponses
        $(".contenu").hide();
        // CSS : curseur pointeur
        $(".titre").css("cursor", "pointer");
        // Clic sur la question
        $(".titre").click(function() {
            // Actions uniquement si la réponse n'est pas déjÃ  visible
            if($(this).next().is(":visible") == false) {
                // Masquage des réponses
                $(".contenu").slideUp();
                $(".contenu").css("visibility","visible");
                // Affichage de la réponse placée juste après dans le code HTML
                $(this).next().slideDown();
            }
        });
    });
</script>

<script	type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=YOUR-PROFILE-ID"></script>
<?php
if (elgg_is_logged_in()) {
    forward('activity');
} else {
    $top_box = $vars['login'];
}
?>
<?php

function AfficheSource($url) {
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
}
?>

<div id="container">
    <div id="a1" class="zoom levelPlan">
        <h6 class="title">Plan</h6>
        <p>
            <iframe width="600" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=120+Rue+Paul+Armangot,+Vitry-sur-Seine&amp;aq=1&amp;oq=120+rue+paul+a&amp;sll=46.75984,1.738281&amp;sspn=8.174018,21.643066&amp;ie=UTF8&amp;hq=&amp;hnear=120+Rue+Paul+Armangot,+94400+Vitry-sur-Seine,+Val-De-Marne,+%C3%8Ele-de-France&amp;t=m&amp;z=14&amp;ll=48.776814,2.376365&amp;output=embed"></iframe>
        </p>
        <p>
            <a href="http://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=120+Rue+Paul+Armangot,+Vitry-sur-Seine&amp;aq=1&amp;oq=120+rue+paul+a&amp;sll=46.75984,1.738281&amp;sspn=8.174018,21.643066&amp;ie=UTF8&amp;hq=&amp;hnear=120+Rue+Paul+Armangot,+94400+Vitry-sur-Seine,+Val-De-Marne,+%C3%8Ele-de-France&amp;t=m&amp;z=14&amp;ll=48.776814,2.376365" style="color: FF9900; font-size: 8px;">Agrandir le plan</a>
        </p>
    </div>
	
    <div id="a4" class="zoom levelMeteo">
        <h6 class="title">Météo</h6>
        <p style="text-align:center;margin-top:15px;"><img src ="http://weathersticker.wunderground.com/weathersticker/cgi-bin/banner/ban/wxBanner?bannertype=wu_clean2day_metric_cond&airportcode=LFPO&ForcedCity=Vitry-sur-Seine&ForcedState=&wmo=07149&language=FR" /></p>
    </div>
	
    <div id="a2" class="zoom levelBus">
        <h6 class="title">Horaire de bus</h6>
        <div style="width: 140px; margin-left: 5px; text-align: center; line-height: 30px; float: left">
            <div class="titre">
                <img src="mod/LocalInformationService/graphics/132.jpg" />
            </div>
    
            <div class="contenu" style="background: #66308E; color: #fff;visibility:hidden;">
                <?php
                //Url de la page web
                $domaine = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B132/132_566_598/A";
                $domaine1 = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B132/132_566_598/R";
                //On affiche le code 
                //Dirction Vitry Moulin Vert
                echo '<p style="font-size:10px;">- Vitry Moulin Vert dans :' . AfficheSource($domaine)."<br />";
                //Dirction BFM
                echo '- BFM dans :' . AfficheSource($domaine1).'</p>';
                ?>
           </div>
       </div> 
	   
        <div style="width: 140px; text-align: center; line-height: 30px; float: left">
         <div class="titre">
           <img src="mod/LocalInformationService/graphics/180.jpg" />
         </div>
         <div class="contenu" style="background: #C3C243; color: #222; visibility: hidden;">
             <?php
              //Url de la page web
              $domaine = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B180/180_313_344/R";
              $domaine1 = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B180/180_313_344/A";
              //On affiche le code 
              //Dirction Louis Aragant
              echo '<p style="font-size:10px;">- Louis Aragant  dans :'. AfficheSource($domaine)."<br />";
              //Dirction Choisy Sud 
              echo '- Charenton-Ecoles dans :' . AfficheSource($domaine1).'</p>';
             ?>
       </div>
      
        </div> 
	  
        <img style="float: right;" src="mod/LocalInformationService/graphics/home_e.gif" border="0" title="infos ratp" alt="infos ratp" />
  
        
    </div>
 
    <br style="clear: both" />
    <div id="a3" class="zoom levelInfo">
        <h6 class="title">Bulletin Trafic Routier</h6>
        <script type="text/javascript" src="http://www.infotrafic.com/js/affiliate.js.php?Affi=d51aee2659ed0810cd1aa232df22a3a2"></script>
    </div>
    <!------->
    <div id="a5" class="zoom levelTrafic">
        <h6 class="title">Bulletin Trafic du Transport en Commun</h6>
       	<?php
		$url="http://wap.ratp.fr/siv/perturbation";
		if ($ouverture = @fopen($url, "rb"))
		{
			if ($lecture = stream_get_contents($ouverture))
			{
				$cpos = strpos($lecture, 'Etat du trafic');
				$pos = strpos($lecture, 'Etat des');
				$inf=substr($lecture, $cpos+14, $pos - $cpos-14);
                                //$inf=strtr($inf,'class="bg1"',' ');
                                $cpos=strpos($inf, ")");
                                echo utf8_encode(substr($inf,0, $cpos+1));
                                $pos=$cpos+1;
                                echo '<br/> <br/>';
                                $inf=substr($inf, $cpos+1);
                                echo utf8_encode($inf);
                                
			}
		}
		?>
    </div>

    <div id="a5" class="zoom levelAir">
      <h6 class="title">Autres services</h6>
        <div style="float:left;margin-left:20px;margin-top:20px;">
            <a href="ssearch/">
                <img src="mod/LocalInformationService/graphics/semantic.png" alt="Recherche sémantique" title="Recherche sémantique" />
            </a>
        </div>
	 
     <div style="float:left;margin-left:20px;margin-top:10px;">
         <a href="http://www.airparif.fr/etat-air/air-et-climat-commune/ninsee/94081">      
             <img src="mod/LocalInformationService/graphics/logo_airparif.png" alt="Air et climat de votre commune" title="Air et climat de votre commune" />
         </a>
     </div>
     <br style="clear: both" />
     
     <div>
      <p style="color: #222;text-align: center;">
         Votre avis nous intéresse, merci de remplir   
         <a href="mod/LocalInformationService/views/default/page/layouts/feedback.php"> ce questionnaire </a>.
      </p>
      
     </div>
     
    </div>
	<div class="elgg-page-footer">
		<div class="elgg-footer-copyright">
		<p>ICOS has been developed within the project "PEOPLE: Pilot smart urban Ecosystems leveraging Open innovation for Promoting and enabLing future E- services", which is partly funded by the European Commission. Copyright © 2012 URENIO Research</p>
		<p>Proudly powered by Citypassenger</p>
		</div>
		<div class="elgg-footer-logos">
		<img src ="<?php echo elgg_get_site_url(); ?>mod/vitryhubtheme/graphics/logo-people.png" border="0" alt="People Smart Cities" title="People Smart Cities"/>
		<img src ="<?php echo elgg_get_site_url(); ?>mod/vitryhubtheme/graphics/logo-eu-small.png" border="0" alt="UE logo" title="UE logo" />
		<?php //echo elgg_view('page/elements/footer', $vars); ?></div>
		</div>	      
</div>
<script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>

<script type="text/javascript">
    try {
        var pageTracker = _gat._getTracker("UA-16288001-1");
        pageTracker._trackPageview();
    } catch(err) {}
</script>



