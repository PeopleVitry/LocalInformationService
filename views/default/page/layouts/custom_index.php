<style type="text/css">
   
    #container {
        position: absolute;
		width:100%;
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
	img{max-width:100%;}
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
		$(".elgg-page-footer").remove();//suppression du footer de semantic search
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
<?php function GetPollutionIndex($url) {
    if ($ouverture = @fopen($url, "rb")) {
        if ($lecture = stream_get_contents($ouverture))
                        {
				$cpos = strpos($lecture, 'header_airquality');
				$pos = strpos($lecture, 'header_tools');
                                $inf=substr($lecture, $cpos+19, $pos - $cpos-19);
                                $cval=substr($inf,strpos($inf, '<strong>')+8,2);                               		
			}
            return $cval;
        }
    @fclose($ouverture);
}?>

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
    
    <div id="a4" class="zoom levelMeteo">
        <h6 class="title">Météo Et Qualité de l'Air de Votre Commune</h6>    
        <div style="margin-left: 10px; margin-top:30px;float:left;">
            <div id="widget_b3e2d1a30c710a9f7883610fc1f13136">
                <a href="http://www.my-meteo.fr/previsions+meteo+france/paris.html" title="M&eacute;t&eacute;o Paris"></a>
                <script type="text/javascript" src="http://www.my-meteo.fr/meteo+webmaster/widget/js.php?ville=251&amp;format=horizontal&amp;nb_jours=2&amp;icones&amp;c1=414141&amp;c2=21a2f3&amp;c3=d4d4d4&amp;c4=FFF&amp;id=b3e2d1a30c710a9f7883610fc1f13136"></script>
            </div>        
        </div>
        <div style="border:1px solid #d4d4d4;width: 130px; height: 120px; margin-right:10px; margin-top: 15px;margin-left:auto">       
                <div style="text-decoration:underline;font-style:italic;font-size:14px;text-align:center;margin:2px 0 4px 0; color: #21a2f3;">
                     Indice de Pollution
                </div>
                <div style="float:left;">
                    <img src="mod/LocalInformationService/graphics/pollution1.png" width="50" height="90" />
                </div>
                <div style="margin-left:70px;margin-top:30px;font-weight: bold;font-size:16px;">   
                    <?php
                    $url="http://www.airparif.fr/etat-air/air-et-climat-commune/ninsee/94081";
                    echo GetPollutionIndex($url); ?> 
                </div> 
                <div style="margin-left:77px;margin-top:15px;">
                    <img src="mod/LocalInformationService/graphics/logo-airparif.png" width="50" height="35" />
                </div>
            </div> 
    </div>
    <br style="clear: both" />
    <div id="a3" class="zoom levelInfo">
        <h6 class="title">Bulletin Trafic Routier</h6>
        <script type="text/javascript" src="http://www.infotrafic.com/js/affiliate.js.php?Affi=d51aee2659ed0810cd1aa232df22a3a2" ></script>
    </div>
    <!------->
     <div id="a2" class="zoom levelBus">
        <h6 class="title">Horaire de bus</h6>
        <div style="float:left;margin-top:5px;">
            <img src="mod/LocalInformationService/graphics/132.jpg" />
        </div>     
        <div style="float:left;line-height:20px;">
            <ol>
                <?php
                //Url de la page web
                $domaine = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B132/132_566_598/A";
                $domaine1 = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B132/132_566_598/R";
                //On affiche le code 
                //Dirction Vitry Moulin Vert
                echo '<li> Vitry Moulin Vert dans :' . AfficheSource($domaine)."</li>";
                //Dirction BFM
                echo '<li> BFM dans :' . AfficheSource($domaine1).'</li>';
                ?>
            </ol>
           </div>
        <div style="float:left;margin-top:5px;">
           <img src="mod/LocalInformationService/graphics/180.jpg" />         
        </div>
        <div style="float:left;line-height:20px;">
             <ol>
                <?php
                //Url de la page web
                $domaine = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B180/180_313_344/R";
                $domaine1 = "http://www.ratp.fr/horaires/fr/ratp/bus/prochains_passages/PP/B180/180_313_344/A";
                //On affiche le code 
                //Dirction Louis Aragant
                echo '<li> Villejuif Louis Aragon  dans :'. AfficheSource($domaine)."</li>";
                //Dirction Choisy Sud 
                echo '<li>Charenton-Ecoles dans :' . AfficheSource($domaine1).'</li>';
                ?>
             </ol>
            </div> 
        <img style="float:right;" src="mod/LocalInformationService/graphics/home_e.gif" border="0" title="infos ratp" alt="infos ratp" />
    </div>
    
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

      


<div style="clear:both;margin-bottom:0;width:100%;height:100px;background:#008080;">
		<div class="elgg-footer-copyright" style="margin-left: 181px;margin-top:10px;padding: 8px;font-weight:normal;">
		<p>ICOS has been developed within the project "PEOPLE: Pilot smart urban Ecosystems leveraging Open innovation for Promoting and enabLing future E- services", which is partly funded by the European Commission. Copyright © 2012 URENIO Research</p>
		<p>Proudly powered by Citypassenger</p>
		</div>
		<div class="elgg-footer-logos" style="margin-top:10px;">
		<img src ="<?php echo elgg_get_site_url(); ?>mod/vitryhubtheme/graphics/logo-people.png" border="0" alt="People Smart Cities" title="People Smart Cities"/>
		<img src ="<?php echo elgg_get_site_url(); ?>mod/vitryhubtheme/graphics/logo-eu-small.png" border="0" alt="UE logo" title="UE logo" />
		</div>
	  
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




