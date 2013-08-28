<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php'); 

$notificationEmails = array('joseph@supraliminalsolutions.com','sf@avianweb.com');

$emailTitle = 'new unpublished content';

$result = db_query("SELECT * FROM bob_node where status = 0 AND admin_notified = 0");

$contentFound = false;

while($row = mysqli_fetch_object($result)) {

    $nodeinfo = node_load($row->nid);

    $content .= "'".$nodeinfo->title."' viewable at " . $GLOBALS['base_url'] . '/' .  $nodeinfo->path . "\r\n";

    $notified_nodes[] = $row->nid;

    if(!$contentFound) $contentFound = true; 
}

if($contentFound) {

    $content = "new unpublished content: \r\n\r\n".$content;

    foreach($notificationEmails as $notificationEmail) { 

        mail($notificationEmail,$emailTitle,$content);

    }

    foreach($notified_nodes as $node_id) {

        db_query("UPDATE bob_node set admin_notified = 1 where nid = $node_id");

    }
}
