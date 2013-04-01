<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php'); 

require_once(dirname(__FILE__) . '/classes/SynchOrder.php');

$so = new SynchOrder();

$args = getopt("a:o::");
$action = $args['a'];
$method = $action . 'Order';
$orderid = $args['o'];

if($orderid) {

    $order = $TaxonomyModel->findOneBy(array(
        'conditions'=>array(
            "id = $orderid"
        ),
        'fetchArray'=>true
    ));

    $so->$method($order);
}
else { 

    $orders = $TaxonomyModel->findBy(array(
        'conditions'=>array(
            'taxonomytype_id = 36'
        ),
        'fetchArray'=>true
    ));

    foreach($orders as $order) {
        $so->$method($order);
    }
}
