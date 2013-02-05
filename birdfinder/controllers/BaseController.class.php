<?php
class BaseController {

    protected $model;

    //load the model dependency
    function __construct() {

        $model_class = str_replace('Controller','',get_called_class()) . 'Model';
        global $$model_class;
        $this->model = $$model_class;
    }
}
