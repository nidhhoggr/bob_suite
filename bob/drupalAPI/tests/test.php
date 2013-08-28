<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/../bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../../birdfinder/config/bootstrap.php'); 

require_once(dirname(__FILE__) . '/../classes/SynchSpecies.php');
require_once(dirname(__FILE__) . '/../classes/SynchOrder.php');

$ss = new SynchSpecies();
$so = new SynchOrder();

$tids = array(17774,17775);

foreach($tids as $tid) {

  print_r(taxonomy_get_children($tid));
  //print_r(taxonomy_get_related($tid));
  //print_r(taxonomy_get_parents($tid));
}

$result = db_query("SELECT * FROM bob_node where status = 0");

$contentFound = false;

while($row = mysqli_fetch_object($result)) {

    $nodeinfo = node_load($row->nid);

    $content .= "'".$nodeinfo->title."' viewable at " . $GLOBALS['base_url'] . '/' .  $nodeinfo->path . "\r\n";

    if(!$contentFound) $contentFound = true; 
}

if($contentFound) {

    $content = "new unpublished content: \r\n\r\n".$content;
    mail('joseph@supraliminalsolutions.com','new unpublished content',$content);
}
/*

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

*/
