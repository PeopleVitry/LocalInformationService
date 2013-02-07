<?php
define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', dirname(__FILE__).DS);
?>
<link rel="stylesheet" type="text/css" href="<?php echo elgg_get_site_url(); ?>/vendors/css/style-localinformation.css" media="all">
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
		setInterval(function(){
          $('#ajax-refresh').load("mod/LocalInformationService/views/default/page/layouts/horaires.php");
        }, 3000);
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

<div id="conteneur_left">
<div class="menu">
<h3 class="menu_title">Actualités</h3>
 <div style="height:200px;width:100%;">
            <marquee onMouseOver="this.stop()" onMouseOut="this.start()" scrollAmount="1"  direction="Up" align="left">
            <?php
                include('tweets.php');
                $tweets = getTimeline(6,"mairievitry","content.txt",100);

                for($i = 0; $i < 6; $i++){
                    echo "<strong>".$tweets[$i]["create"]." : </strong>";
                    echo $tweets[$i]["content"];
                    echo '</br></br>';}?>
            </marquee>  
  </div>  
</div>
<br /><br />
<div class="menu">
<h3 class="menu_title">Donnez votre avis</h3>
 <div style="height:auto;width:100%;text-align:center">
     <a href="https://docs.google.com/spreadsheet/viewform?formkey=dEx2YXkyYnRkQ3NEa204cHVTODFRRnc6MQ#gid=0">
	   <img src="mod/LocalInformationService/graphics/feedback.jpg" border="0" width="180px" height="200px" title="commentaire" alt="commentaire" />
	 </a>  
  </div>  
</div>
<ul>
   <li class="facebook"><a href="https://www.facebook.com/SmartCityVitry?fref=ts" target="_blank" title="Share on Facebook">Facebook</a></li>
   <li class="twitter"><a href="https://twitter.com/Peopleproject2" target="_blank"  title="Share on Twitter">Twitter</a></li>
   <li class="linkedin"><a href="http://www.linkedin.com/groups?home=&gid=3376587&trk=anet_ug_hm" target="_blank" title="Share on linkedin">Linkedin</a></li>
</ul>
</div>
<div id="conteneur_right">
    <div id="a1" class="zoom levelPlan">
        
        <h6 class="title">Plan</h6>
        <p>
			<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
				src="mod/LocalInformationService/views/default/page/layouts/Geolocalisation/index.php">
          
            </iframe>
        </p>
   
    </div>
	    
    <div id="a5" class="zoom levelAir">
        <h6 class="title">Local Search</h6>
		<div style="margin-left:5px;margin-top:15px;float:left;">
       <a href="../SemanticSearch/"><img src="mod/LocalInformationService/graphics/world-search.png" /></a>
	   </div>
	   <div style="float:left;margin-top:35px;">
	   <h2 style="color:#222;">LOCAL SEARCH</h2>
	   <p>Rechercher une adresse de ma ville avec Google Maps</p>
	   </div>
    </div> 
    
    <div id="a4" class="zoom levelMeteo">
        <h6 class="title">Météo Et Qualité de l'Air</h6>    
        <div style="margin-left:2px;width:50%;margin-top:20px;float:left; ">
            <div id="widget_b3e2d1a30c710a9f7883610fc1f13136">
                <a href="http://www.my-meteo.fr/previsions+meteo+france/paris.html" title="M&eacute;t&eacute;o Paris"></a>
                <script type="text/javascript" src="http://www.my-meteo.fr/meteo+webmaster/widget/js.php?ville=251&amp;format=horizontal&amp;nb_jours=2&amp;icones&amp;c1=414141&amp;c2=21a2f3&amp;c3=d4d4d4&amp;c4=FFF&amp;id=b3e2d1a30c710a9f7883610fc1f13136"></script>
            </div>        
        </div>
        <div style="border:1px solid #d4d4d4;width:25%;height: 120px;margin-top: 20px;float:right;margin-left:2px;">       
                <div style="text-decoration:underline;font-size:9px;text-align:center;margin:2px 0 4px 0; color: #21a2f3;">
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
                    <img src="mod/LocalInformationService/graphics/logo-airparif.png" width="50" height="35" alt="Air et climat de votre commune" title="Air et climat de votre commune"/>
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
		 <div id="ajax-refresh">
       <?php include(BASE_PATH.'horaires.php');?>
	    </div>
	   <img style="float:right;margin-top:-50px;" src="mod/LocalInformationService/graphics/home_e.gif" border="0" title="infos ratp" alt="infos ratp" />
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
</div>
<div style="clear:both;margin-bottom:0;width:100%;height:100px;background:#00233F;">
		<div class="elgg-footer-copyright" style="margin-left: 181px;margin-top:10px;padding: 8px;font-weight:normal;">
		<p>ICOS has been developed within the project "PEOPLE: Pilot smart urban Ecosystems leveraging Open innovation for Promoting and enabLing future E- services", which is partly funded by the European Commission. Copyright © 2012 URENIO Research</p>
		<p>Proudly powered by Citypassenger</p>
		</div>
		<div class="elgg-footer-logos" style="margin-top:10px;">
		<img src ="<?php echo elgg_get_site_url(); ?>mod/vitryhubtheme/graphics/logo-people.png" border="0" alt="People Smart Cities" title="People Smart Cities"/>
		<img src ="<?php echo elgg_get_site_url(); ?>mod/vitryhubtheme/graphics/logo-eu-small.png" border="0" alt="UE logo" title="UE logo" />
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




