<?php

require_once(dirname(__FILE__) . '/../config/bootstrap.php');

require_once(dirname(__FILE__) . '/merger.php');

//$result = $TaxonomyModel->find("taxonomytype_id = 36 ORDER BY name ASC","*");

//$exceptions = array('galliformes','pelecaniformes','trogoniformes');

//$trimmables = array('new-world-','old-world-');


//$mergable = $Utility->findSimilarFromSortedResult($result,$exceptions,$trimmables);

/*
echo '<pre>';

print_r($mergable);

echo '</pre>';
*/

/*
$mergable = array(
    'booby-and-gannets-sulidae'=>array(351,145),
    'rails-gallinules-and-coots'=>array(188,395)
);
*/

mergeTaxonomies(array(36=>$mergable));
