<?php
class BaseController {

    protected $model;

    //load the model dependency
    function __construct($class_name=null) {

        if(function_exists('get_called_class'))
            $model_class = str_replace('Controller','',get_called_class()) . 'Model';
        else 
            $model_class = str_replace('Controller','',$class_name) . 'Model';

        global $$model_class;
        $this->model = $$model_class;
    }
}
