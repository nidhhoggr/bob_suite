<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/../bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../../birdfinder/config/bootstrap.php'); 

require_once(dirname(__FILE__) . '/../classes/SynchSpecies.php');
require_once(dirname(__FILE__) . '/../classes/SynchOrder.php');

$ss = new SynchSpecies();
$so = new SynchOrder();

//well use the ferral pigeon
$birdid = "195";
$orderid = "541";

//get the bird
$bird = $BirdModel->findOneBy(array(
    'conditions'=>array(
        "id = $birdid"
    ),
    'fetchArray'=>true
));

//get the order
$order = $TaxonomyModel->findOneBy(array(
    'conditions'=>array(
        "id = $orderid"
    ),
    'fetchArray'=>true
));


$so->saveOrder($order);
$ss->saveBird($bird);
