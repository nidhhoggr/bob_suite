<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php'); 

require_once(dirname(__FILE__) . '/classes/SynchSpecies.php');

$ss = new SynchSpecies();

$args = getopt("a:tb::");
$action = $args['a'];
$ss->setDebugMode(isset($args['t']));
$method = $action . 'Bird';
$birdid = $args['b'];

if($birdid) {

    $bird = $BirdModel->findOneBy(array(
        'conditions'=>array(
            "id = $birdid"
        ),
        'fetchArray'=>true
    ));

    $ss->$method($bird);
}
else {

    $birds = $BirdModel->findBy(array(
        'conditions'=>array(
            'paraphrased'=>1
        ),
        'fetchArray'=>true
    ));

    foreach($birds as $bird) {

        $ss->$method($bird);
    }
}
