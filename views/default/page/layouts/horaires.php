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
echo '<li> Vitry Moulin Vert:' . AfficheSource($domaine)."</li>";
//Dirction BFM
echo '<li> B.F.Mitterrand:' . AfficheSource($domaine1).'</li>';
?>
</ol>
</div>
<p style="clear:both;"></p>
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
echo '<li> Villejuif Louis Aragon:'. AfficheSource($domaine)."</li>";
//Dirction Choisy Sud 
echo '<li>Charenton-Ecoles:' . AfficheSource($domaine1).'</li>';
?>
</ol>
</div> 
       