<?php
//SET THE DIRECTORY GLOBALS HERE
define("BF_LIB_DIR",dirname(__FILE__). '/../libs/');
define("BF_TEST_DIR",dirname(__FILE__). '/../tests/');
define("BF_MODEL_DIR", dirname(__FILE__). '/../models/');
define("BF_CONTROLLER_DIR", dirname(__FILE__). '/../controllers/');
define("BF_SOURCE_DIR", dirname(__FILE__). '/../sources/');
define("BF_VIEW_DIR", dirname(__FILE__). '/../views/');
define("BF_UTIL_DIR", dirname(__FILE__). '/../utils/');

//only for shell usage
$sandbox = true;

if(@strstr($_SERVER['HTTP_HOST'],'supraliminalsolutions.com') || $sandbox) {

    //SET THE CONNECTION GLOBALS HERE
    define('DBUSER','zmijevik');
    define('DBPASSWORD','2crscM,jxs3Z');
    define('DBNAME','zmijevik_birdfinder');
    define('DBHOST','localhost');
    define('DBDRIVER','mysql');

    define('bird_manager_url','http://supraliminalsolutions.com/clients/sibylle/birdfindermanager/web/backend.php/');
    define('bird_interface_url','http://supraliminalsolutions.com/clients/sibylle/birdfinder/interface/');
} 
else if(@strstr($_SERVER['HTTP_HOST'],'clients') || $sandbox) {

    //SET THE CONNECTION GLOBALS HERE
    define('DBUSER','root');
    define('DBPASSWORD','root');
    define('DBNAME','bob_birdfinder');
    define('DBHOST','localhost');
    define('DBDRIVER','mysql');

    define('bird_manager_url','http://sfprojects/birdfinder/web/backend.php/');
    define('bird_interface_url','http://clients/sibylle/birdsofbeauty/birdfinder/injection_engine/interface/');
}
