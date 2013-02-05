<?php

require_once(dirname(__FILE__) . '/../../config/bootstrap.php');

$taxid=$_GET['taxid'];

if(!empty($taxid)) {
    $result = $BirdModel->findByTaxonomyId($taxid);

    $taxresult = $TaxonomyModel->findOne("id=$taxid");
    $taxtyperesult = $TaxonomyTypeModel->findOne("id=".$taxresult['taxonomytype_id']);

    echo '<h2>' . $taxtyperesult['name']  . ' -  ' . $taxresult['name']  . '</h2>';
}
else {
    $result = $BirdModel->findAll();
}

if($_SERVER['HTTP_HOST'] == "clients") {
    $editbarelink = 'http://sfprojects/birdfinder/web/backend.php/bird/';
}
else if($_SERVER['HTTP_HOST'] == "clonedparts.com") {
    $editbarelink = '/birdfindermanager/web/backend.php/bird/';
}


echo '<ul>';
while($r = $BirdModel->fetchNextObject($result)) {

    $editlink = $editbarelink . $r->id . '/edit';

    echo '<li>'.$r->name.' - '. $r->propername  .' <a href="'.$editlink.'" target="_blank">edit</a> </li>';

}

echo '<ul>';
