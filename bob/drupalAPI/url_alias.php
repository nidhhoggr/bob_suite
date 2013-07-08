<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php'); 

$args = getopt("a::f::g::");

if(isset($args['a'])) {

    flushAliases();
    generateAliases();
}
else {

    if(isset($args['f'])) {
        
        flushAliases();
    }
    if(isset($args['g'])) {

        generateAliases();
    }
}

$DrupalModel->setTable('bob_url_alias');

function flushAliases() { 
    global $DrupalModel;

    $DrupalModel->cleanUrlAliases("pid > 462");
}

function generateAliases() {
    global $DrupalModel;

    $orderAliases = getOrderAliases();

    $speciesAliases = getSpeciesAliases();

    //$aliases = $orderAliases;

    //$aliases = $speciesAliases;

    $aliases = array_merge($orderAliases,$speciesAliases);

    $DrupalModel->setTable('bob_url_alias');

    foreach($aliases as $alias) {
   
        extract($alias);

        $DrupalModel->src = trim($src);
        $DrupalModel->dst = trim($dst);
        $DrupalModel->save();
    }
}

function getOrderAliases() {
    global $Utility, $TaxonomyModel;

    mysql_select_db(DBNAME);

    $orders = $TaxonomyModel->findBy(array(
        'conditions'=>array(
            'taxonomytype_id = 36'
        ),
        'fetchArray'=>true
    ));

    mysql_select_db(DBNAME_DRUPAL);

    foreach($orders as $order) {
        $ordername = $Utility->dehumanizeString($order['name']) . "\n";
        $drupalinfo = $Utility->dbGetArray($order['drupalinfo']);

        $alias[] = array(
            'src'=>'taxonomy/term/'.$drupalinfo['tid'],
            'dst'=>'bird-order/'.$ordername
        );
    }

    return $alias;
}

function getSpeciesAliases() {
    global $Utility, $BirdModel;

    mysql_select_db(DBNAME);

    $birds = $BirdModel->findBy(array(
        'conditions'=>array(
            'paraphrased'=>1
        ),
        'fetchArray'=>true
    ));

    mysql_select_db(DBNAME_DRUPAL);

    foreach($birds as $bird) {
        $birdname = $Utility->dehumanizeString($bird['name']) . "\n";
        $drupalinfo = $Utility->dbGetArray($bird['drupalinfo']);

        $alias[] = array(
            'src'=>'taxonomy/term/'.$drupalinfo['tid'],
            'dst'=>'bird-species/'.$birdname
        );
    }

    return $alias;
}
