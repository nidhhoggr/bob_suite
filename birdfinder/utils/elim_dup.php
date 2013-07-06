<?php

require_once(dirname(__FILE__) . '/../config/bootstrap.php');

$duplicates = array(
513=>array(527,540,319),
384=>209,
160=>408,
315=>array(391,206),
327=>203,
550=>307,
547=>310,
383=>194,
325=>189,
187=>382,
541=>311,
533=>316,
528=>312,
372=>153,
524=>322,
308=>367,
361=>137,
520=>313,
518=>array(560,317),
314=>353,
139=>401,
572=>array(573,510));

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
