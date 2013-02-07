<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
//définition des constantes pour le relative time
define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);
 
function relative_time($time){
    $delta = strtotime('+1 minute') - $time;
    if ($delta < 2 * MINUTE) {
        return "Il y a moins d'une minute";
    }
    if ($delta < 45 * MINUTE) {
        return "Il y a ".floor($delta / MINUTE) . " minutes";
    }
    if ($delta < 90 * MINUTE) {
        return "Il y a une heure";
    }
    if ($delta < 24 * HOUR) {
        return "Il y a ".floor($delta / HOUR) . " heures";
    }
    if ($delta < 48 * HOUR) {
        return "hier";
    }
    if ($delta < 30 * DAY) {
        return "Il y a ".floor($delta / DAY) . " jours";
    }
    if ($delta < 12 * MONTH) {
        $months = floor($delta / DAY / 30);
        return $months <= 1 ? "Il y a un mois" : "Il y a ".$months . " mois";
    } else {
        $years = floor($delta / DAY / 365);
        return $years <= 1 ? "Il y a un an" : "Il y a ".$years . " ans";
    }
}
?>

<?php
/**
* @desc getTimeline return the last tweets and manage a file cache system.
* @param int $count number of tweets to display
* @param string $username tweeter username
* @param string $cache_file name of cache file
* @param int $interval expire time of cache
* @return array
*/
function getTimeline($count, $username,$cache_file,$interval) {
    //dans ce cas le fichier doit ?tre dans le m?me répertoire que le script.
    $path = realpath(dirname(__FILE__))."/".$cache_file;
    $last = filemtime($path);
    $now = time();
    // check the cache file
    if ( !$last || (( $now - $last ) > $interval) ) {
        $url = 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$username.'&count='.$count;
        $tweets = json_decode(file_get_contents($url),TRUE);
        $newTweets = array();
        $i=0;
        foreach($tweets as $tweet){
            $time = strtotime($tweet["created_at"]);
            //récupération du temps relatif
            $create = relative_time($time);
            //on traite le contenu pour récupérer liens et tags
            $content = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@','<a href="$1" target="_blank">$1</a>',$tweet["text"]);
            $content = preg_replace('#(@[_\-a-z0-9]+)#','<a href="http://twitter.com/$1" target="_blank">$1</a>',$content);
            $content = preg_replace('#href="http://twitter.com/@([_\-a-z0-9]+)#','href="http://twitter.com/$1',$content);
            $content = preg_replace('/(\B#\w*[a-zA-Z]+\w*)/','<a href="http://twitter.com/search?q=$1" target="_blank">$1</a>',$content);
            $content = str_replace('href="http://twitter.com/search?q=#','href="http://twitter.com/search?q=%23',$content);
            $newTweets[$i]["create"] = $create;
            $newTweets[$i]["content"] =$content;
            $i++;
        }
        $cache_static = fopen($path, 'wb');
        fwrite($cache_static, serialize($newTweets));
        fclose($cache_static);
        $tweets = $newTweets;
    }else{
        $tweetsSr = file_get_contents($path);
        $tweets = unserialize($tweetsSr);
    }
    return $tweets;
}
?>
        
