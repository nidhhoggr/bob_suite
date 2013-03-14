<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'prod', false);
sfContext::createInstance($configuration);


$birds = Doctrine_Core::getTable('Bird')->findAll();

$bird_url = "http://supraliminalsolutions.com/clients/sibylle/birdfindermanager/web/backend.php/bird/{id}/edit";

foreach($birds as $bird) {

    if(!isValidExtension($bird->imageurl)) {
        echo '<a href="'.str_replace('{id}',$bird->getId(),$bird_url) . '" target="_blank">'.$bird->name.'</a> ' . $bird->imageurl . "<br />";
    }

}

function isValidExtension($url) {

    $extensions = array('jpg','jpeg','png','gif');
    $valid = false;

    foreach($extensions as $ext) {    

        $ext_frag = strtolower(substr($url, -5));

        if(strstr($ext_frag,$ext) && !strstr($url,'File:')) {
            $valid = true;
            break;
        }
    }
    return $valid;
}
