<?php

require_once(dirname(__FILE__) . '/../config/bootstrap.php');

$duplicates = array(
397=>184,
363=>306
);
foreach($duplicates as $butthole=>$duper) { 


    //echo $butthole . "\r\n";

    foreach((array)$duper as $dup) {

        //echo $dup . "\r\n";
        reassociateMetaData($butthole,$dup);
    }
}


//$TaxonomyModel->setDebugMode(true);

//$taxonomies = $TaxonomyModel->findBy(array('conditions'=>'id IN('.implode(',',array_keys($duplicates)).')'));

function reassociateMetaData($orid,$dupid) {

    $qry = "UPDATE bird_taxonomy SET taxonomy_id = $orid WHERE id = taxonomy_id = $dupid";

    $del_1 = "DELETE FROM taxonomy_source where taxonomy_id = $dupid";

    $del_2 = "DELETE FROM taxonomy where id = $dupid";

    echo $qry . ";\r\n";
    echo $del_1 . ";\r\n";
    echo $del_2 . ";\r\n";
}

foreach($taxonomies as $taxonomy) {

    if(empty($taxonomy['about'])) var_dump($taxonomy); 

}


/*
while($row = mysql_fetch_object($tww)) {

    var_dump($row->described);
}
*/
