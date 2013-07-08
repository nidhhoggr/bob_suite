<?php
//SET THE DIRECTORY GLOBALS HERE
define("BF_LIB_DIR",dirname(__FILE__). '/../libs/');
define("BF_TEST_DIR",dirname(__FILE__). '/../tests/');
define("BF_MODEL_DIR", dirname(__FILE__). '/../models/');
define("BF_CONTROLLER_DIR", dirname(__FILE__). '/../controllers/');
define("BF_SOURCE_DIR", dirname(__FILE__). '/../sources/');
define("BF_VIEW_DIR", dirname(__FILE__). '/../views/');
define("BF_UTIL_DIR", dirname(__FILE__). '/../utils/');



$prodbox = false;
$staging = true;
//only for shell usage
$sandbox = false;

if(@strstr($_SERVER['HTTP_HOST'],'beautyofbirds.com') || $prodbox) {

    //SET THE CONNECTION GLOBALS HERE
    define('DBUSER','beautyof');
    define('DBPASSWORD','QbkAz#486K9;');
    define('DBNAME','beautyof_birdfinder');
    define('DBNAME_DRUPAL','beautyof_bob');
    define('DBHOST','localhost');
    define('DBDRIVER','mysql');
    define("PEAR_LIB",'/home/beautyof/php/');

    define('bird_manager_url','http://beautyofbirds.com/birdfindermanager/web/');
    define('bird_interface_url','http://beautyofbirds.com/birdfinder/interface/');
    define('bird_drupal_url','http://beautyofbirds.com/');
    ini_set('include_path', PEAR_LIB);
}
else if(@strstr($_SERVER['HTTP_HOST'],'supraliminalsolutions.com') || $staging) {

    //SET THE CONNECTION GLOBALS HERE
    define('DBUSER','suprali1');
    define('DBPASSWORD','A1genda666!');
    define('DBNAME','suprali1_birdfinder');
    define('DBNAME_DRUPAL','suprali1_bob');
    define('DBHOST','localhost');
    define('DBDRIVER','mysql');
    define("PEAR_LIB",'/home/suprali1/php/');

    define('bird_manager_url','http://supraliminalsolutions.com/clients/sibylle/birdfindermanager/web/');
    define('bird_managertemplate_url','http://supraliminalsolutions.com/clients/sibylle/birdfinder/interface/backend.html');
    define('bird_interface_url','http://supraliminalsolutions.com/clients/sibylle/birdfinder/interface/');
    define('bird_drupal_url','http://supraliminalsolutions.com/clients/sibylle/bob/');
    // Works in all PHP versions
    ini_set('include_path', PEAR_LIB);
} 
else if(@strstr($_SERVER['HTTP_HOST'],'clients') || $sandbox) {

    //SET THE CONNECTION GLOBALS HERE
    define('DBUSER','root');
    define('DBPASSWORD','root');
    define('DBNAME','bob_birdfinder');
    define('DBNAME_DRUPAL','bob');
    define('DBHOST','localhost');
    define('DBDRIVER','mysql');
    define("PEAR_LIB",null);

    define('bird_manager_url','http://beautyofbirds/birdfindermanager/web/');
    define('bird_interface_url','http://beautyofbirds/birdfinder/interface/');
    define('bird_drupal_url','http://beautyofbirds/bob/');
}
