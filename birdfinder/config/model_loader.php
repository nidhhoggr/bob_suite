<?php

/**
    a model loader using a factory pattern
*/

//retrive the model files
$model_files = scandir(BF_MODEL_DIR);

foreach($model_files as $mf) {

    if($mf != ".." && $mf != "." && !strstr($mf,'.sw')) {
        require_once(BF_MODEL_DIR . $mf);

        $model_name = str_replace('.class.php','',$mf);

        $$model_name = new $model_name($connection_args);
    }
}

$controller_files = scandir(BF_CONTROLLER_DIR);

//retrive the model files
$view_files = scandir(BF_VIEW_DIR);

foreach($view_files as $vf) {

    if($vf != ".." && $vf != "." && !strstr($vf,'.sw')) {
        require_once(BF_VIEW_DIR . $vf);

        $view_name = str_replace('.class.php','',$vf);

        $$view_name = new $view_name();
    }
}

$controller_files = scandir(BF_CONTROLLER_DIR);


//load the base controller
require_once(BF_CONTROLLER_DIR . 'BaseController.class.php');

foreach($controller_files as $cf) {

    if($cf != ".." && $cf != "." && !is_dir(BF_CONTROLLER_DIR .$cf) && $cf!="BaseController.class.php"  && !strstr($cf,'.sw')) {

        require_once(BF_CONTROLLER_DIR . $cf);

        $controller_name = str_replace('.class.php','',$cf);

        $$controller_name = new $controller_name();
    }
}


//instantiate the utility
require_once(BF_UTIL_DIR . 'Utility.class.php');
$Utility = new Utility();
require_once(BF_UTIL_DIR . 'FormUtil.class.php');
require_once(BF_UTIL_DIR . 'AjaxHandler.class.php');
require_once(BF_UTIL_DIR . 'CachePEAR.class.php');
require_once(BF_UTIL_DIR . 'BobTemplate.class.php');

