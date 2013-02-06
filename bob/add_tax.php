<?php

require_once(dirname(__FILE__)  . '/includes/bootstrap.inc');

drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


//create a term

/*
$term = array(
    'vid' => 2, // Voacabulary ID
    'name' => 'Fart Smoker', // Term Name 
    'description' => 'This bird is infamous for smoking farts'
);

taxonomy_save_term($term);
*/

//update a term

/*
$term = array(
    'tid' => 115,
    'name'=>'fart smoking mongolian',
    'description' => 'This bird is infamous for smoking farts'
);

taxonomy_save_term($term);
*/

//add image from url

//taxonomy_image_add_from_url(115,'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRSiZLaRxq7JsSrHlEww-1i5gR0f1s4yWY2IuF-zfKoKl1_QH4dk85k-w','fartsmoker.jpg');

//delete taxonomy image
/*

$db = array(
85,
78
);

foreach($db as $d) 
    taxonomy_del_term($d);    
*/


//taxonomy_image_delete($d);

// load a node

/*

$nid = 226;

$node = node_load(array("nid" => $nid));

var_dump($node);

*/

//create a node associated to an existing term

/*

$node = new stdClass();

$node->name = 'Traits';
$node->title = $node_name;
$node->body = "<h3>Fart</h3>";
$node->type = "trait";
$node->status = 1;
$node->created = time();
$node->taxonomy = array(taxonomy_get_term(7));

if ($node = node_submit($node)) {
  node_save($node);
}

var_dump($node);

*/
