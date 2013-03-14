<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php'); 

$dps = new DrupalBirdSpecies();

$birds = $BirdModel->find(array(
    'conditions'=>array(
        'paraphrased'=>1
    )
));

$args = getopt("a:t");
$action = $args['a'];
$test = isset($args['t']);
$method = $action . 'Bird';

foreach($birds as $bird) {
    
    $order_ids = array();

    $BirdTaxonomyModel->findByTaxTypeAndBird(36,$bird['id']);

    while($order = $BirdTaxonomyModel->fetchNextObject()) {

        var_dump($order);
        $drupalinfo = $Utility->dbGetArray($order->drupalinfo);
        $order_ids[] = $drupalinfo['tid'];
    }

    //if(!count($order_ids)) $empty_birds[] = $bird['name'];
 
    $method($bird);
}

function deleteBird($bird) {
    global $dps, $Utility, $BirdModel;

    extract($bird);
    $drupalinfo = $Utility->dbGetArray($drupalinfo);

    echo "deleting " . $bird['name'] . ": " . $drupalinfo['nid'] . "\r\n";
 
    $dps->deleteBirdSpecies($drupalinfo['nid']);

    $BirdModel->nullifyDrupalInfo($id);
}

function saveBird($bird) {
    global $dps, $test, $Utility, $BirdModel, $order_ids;

    extract($bird);

    $drupalinfo = $Utility->dbGetArray($drupalinfo);

    $orderinfo = array(
        'nid'=>$drupalinfo['nid'],
        'body'=>null,
        'title'=>$name,
        'taxonomy'=>array(
            'name'=>$name,
            'description'=>$about,
            'parent'=>$order_ids
        )
    );
    
    if($test) { print_r($orderinfo);die();}

    if(empty($drupalinfo['nid'])) {
        $orderinfo['image'] = array(
            'url'=>$imageurl,
            'name'=>'sync_' . $Utility->dehumanizeString($name) . '.jpg'
        );

        $node = $dps->createBirdSpecies($orderinfo);
        echo "creating $name \r\n";
    }
    else {
        $node = $dps->updateBirdSpecies($orderinfo);
        echo "updating $name \r\n";
    }
    
    $nid = $node->nid;
    $tid = key($node->taxonomy);

    $BirdModel->id = $id;
    $BirdModel->drupalinfo = $Utility->dbPutArray(compact('nid','tid')); 
    $BirdModel->save();
}
