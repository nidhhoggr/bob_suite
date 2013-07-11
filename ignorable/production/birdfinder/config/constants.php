<?php
//SET THE DIRECTORY GLOBALS HERE
define("BF_LIB_DIR",dirname(__FILE__). '/../libs/');
define("BF_TEST_DIR",dirname(__FILE__). '/../tests/');
define("BF_MODEL_DIR", dirname(__FILE__). '/../models/');
define("BF_CONTROLLER_DIR", dirname(__FILE__). '/../controllers/');
define("BF_SOURCE_DIR", dirname(__FILE__). '/../sources/');
define("BF_VIEW_DIR", dirname(__FILE__). '/../views/');
define("BF_UTIL_DIR", dirname(__FILE__). '/../utils/');

$prodbox = true;

    //SET THE CONNECTION GLOBALS HERE
    define('DBUSER','beautyof');
    define('DBPASSWORD','@Joseph7a*');
    define('DBNAME','beautyof_birdfinder');
    define('DBHOST','localhost');
    define('DBDRIVER','mysql');
    define("PEAR_LIB",'/home/beautyof/php/');

    define('bird_manager_url','http://beautyofbirds.com/birdfindermanager/web/');
    define('bird_managertemplate_url','http://beautyofbirds.com/birdfindermanager/web/frontend.php');
    define('bird_interface_url','http://beautyofbirds.com/birdfinder/interface/');
    define('bird_drupal_url','http://beautyofbirds.com/');
