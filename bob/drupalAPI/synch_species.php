<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php'); 

$dps = new DrupalBirdSpecies();

$args = getopt("a:tb::");
$action = $args['a'];
$test = isset($args['t']);
$method = $action . 'Bird';
$birdid = $args['b'];

if($birdid) {

    $bird = $BirdModel->findOneBy(array(
        'conditions'=>array(
            "id = $birdid"
        ),
        'fetchArray'=>true
    ));

    $BirdTaxonomyModel->findByTaxTypeAndBird(36,$birdid);

    while($order = $BirdTaxonomyModel->fetchNextObject()) {
        $drupalinfo = $Utility->dbGetArray($order->drupalinfo);
    }

    $method($bird);
}
else {

    $birds = $BirdModel->findBy(array(
        'conditions'=>array(
            'paraphrased'=>1
        )
    ));

    foreach($birds as $bird) {

        $BirdTaxonomyModel->findByTaxTypeAndBird(36,$bird['id']);

        while($order = $BirdTaxonomyModel->fetchNextObject()) {

           $drupalinfo = $Utility->dbGetArray($order->drupalinfo);
        }

 
        $method($bird);
    }
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

    $name = str_replace("'", '', $name);

    $drupalinfo = $Utility->dbGetArray($drupalinfo);
 
    $tagContent = getBirdTagContent($bird);

    $orderinfo = array(
        'nid'=>$drupalinfo['nid'],
        'body'=>$tagContent,
        'title'=>$name,
        'taxonomy'=>array(
            'name'=>str_replace("'", '', $name),
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

function getBirdTagContent($bird) {
    global $BirdController;
    return $BirdController->displayAssociatedTags($bird['id']);
}
