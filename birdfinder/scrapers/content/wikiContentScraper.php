<?php

require_once(BF_LIB_DIR . '/wikiScraper/wikiScraper.php');

$ws = new WikiScraper();

$query = "select * from bird where about IS NULL";
$BirdModel->query($query);
$bm = clone $BirdModel; 


while($bird = $BirdModel->fetchNextObject()) {

    $search = $bird->name;
    $ws->loadFindAndScrapeFromQuery($search);
    $content = $ws->getScrapedContent();

    if(!empty($content)) {

        $bm->id = $bird->id;
        $bm->about = mysql_real_escape_string($content);  
        $bm->save(); 
    }
}
