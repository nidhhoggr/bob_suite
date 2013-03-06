<?php
require_once(dirname(__FILE__)  . '/bootstrap.php');

$speciesinfo = array(
    'body'=>'very ugly',
    'title'=>'Fart Smoker',
    'taxonomy'=>array(
        'name'=>'Fart Smoker',
        'description'=>'this bird is infamous for smoking farts',
        'parent'=array(),
    ),
    'image'=>array(
        'url'=>'http://stevesuttie.files.wordpress.com/2012/05/no-farting.jpg',
        'name'=>'fartsmoker_again.jpg'
    )
);

$updatespeciesinfo = array(
    'nid'=>237,
    'title'=>'Fart Huffer',
    'body'=>'very smelly',
    'taxonomy'=>array(
        'name'=>'Fart Huffer',
        'description'=>'this bird is infamous for huffing farts'
        'parent'=array(),
    ),
);

$dps = new DrupalBirdSpecies();
//print_r($dps->createBirdSpecies($speciesinfo));
//$dps->deleteBirdSpecies(236);
//print_r($dps->updateBirdSpecies($updatespeciesinfo));
