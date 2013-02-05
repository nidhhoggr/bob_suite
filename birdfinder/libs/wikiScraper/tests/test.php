<?php

require_once(dirname(__FILE__) . '/../wikiScraper.php');

$ws = new wikiScraper(true);

//$searches = array('Dark-sided Flycatcher','Marbled Murrelet','Swallow-tailed Kite');

$searches = array('Dark-sided Flycatcher');

foreach($searches as $search) {
 
    echo "\n scraping $search\n";
    $ws->loadFindAndScrapeFromQuery($search);
    var_dump($ws->getScrapedContent());
}

