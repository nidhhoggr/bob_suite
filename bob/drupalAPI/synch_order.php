<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php'); 

$orders = $TaxonomyModel->findBy(array('conditions'=>array('taxonomytype_id = 36')));

$dpo = new DrupalBirdOrder();

$args = getopt("a:");
$action = $args['a'];
$method = $action . 'Order';
$method($orders);

function displayOrder($orders) {

    foreach($orders as $t) {
        global $Utility;
        extract($t);
        echo $name . "\r\n";
        $drupalinfo = $Utility->dbGetArray($drupalinfo);
        extract($drupalinfo);
        echo "\tnid:$nid \r\n";
        echo "\ttid:$tid \r\n";
    }
}

function deleteOrder($orders) {
    global $dpo, $Utility, $TaxonomyModel;

    foreach($orders as $t) {
        extract($t);
        $drupalinfo = unserialize(base64_decode($drupalinfo));
        $dpo->deleteBirdOrder($drupalinfo['nid']);

        $nid = null;
        $tid = null;

        $TaxonomyModel->id = $id;
        $TaxonomyModel->drupalinfo = base64_encode(serialize(compact('nid','tid')));
        $TaxonomyModel->save();
    }
}

function saveOrder($orders) {
    global $dpo, $Utility, $TaxonomyModel;


    foreach($orders as $t) {
        extract($t);

        $name = $Utility->humanizeString($name);

        $drupalinfo = unserialize(base64_decode($drupalinfo));

        $orderinfo = array(
            'nid'=>$drupalinfo['nid'],
            'body'=>null,
            'title'=>$name,
            'taxonomy'=>array(
                'name'=>$name,
                'description'=>$about,
            )
        );

        if(empty($drupalinfo['nid'])) {
            $orderinfo['image'] = array(
                'image'=>array(
                    'url'=>$imageurl,
                    'name'=>'sync_' . $name
                )
            );
            $node = $dpo->createBirdOrder($orderinfo);
            echo "creating $name \r\n";
        }
        else {
            $node = $dpo->updateBirdOrder($orderinfo);
            echo "updating $name \r\n";
        }
    
        $nid = $node->nid;
        $tid = key($node->taxonomy);

        $TaxonomyModel->id = $id;
        $TaxonomyModel->drupalinfo = base64_encode(serialize(compact('nid','tid'))); 
        $TaxonomyModel->save();
    }
}
