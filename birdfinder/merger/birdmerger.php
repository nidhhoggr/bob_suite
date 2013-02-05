<?php

require_once(dirname(__FILE__) . '/../config/bootstrap.php');

require_once(dirname(__FILE__) . '/merger.php');

$result = $BirdModel->find("1=1 ORDER BY name ASC","*");

$mergable = $Utility->findNEquivelantFromSortedResult(3,$result,array('Zone-tailed Hawk'),true);

//var_dump(count($result),count($mergable));

echo '<pre>';

print_r($mergable);

echo '</pre>';

//$mergable['Zone-tailed Hawk'] = array(1711,822,293);

//mergeBirds($mergable);
