<?php
//load the drupalAPI bootstrap
require_once(dirname(__FILE__) . '/bootstrap.php');
//load the birdfinder bootstrap
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php'); 

$dua = new DrupalURLAliases($DrupalModel); 

$args = getopt("a::f::g::");

if(isset($args['a'])) {

    $dua->flushAliases();
    $dua->generateAliases();
}
else {

    if(isset($args['g'])) {

        $dua->generateAliases();
    }

    if(isset($args['f'])) {

        $dua->flushAliases();
    }
}
