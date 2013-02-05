<?php
class AjaxHandler {

    public function __construct($args) {

        $result = $this->callController($args);

        $this->displayResponse($result);
    }

    private function callController($args) {
        extract($args);
        global $$controller;
 
        if(!is_array($arguments)) {
            parse_str($arguments,$update_args);
            $result = $$controller->{$function}($update_args);
        }
        else {
            $result = $$controller->{$function}($arguments);
        }
       
        return $result;
    }

    private function displayResponse($result) {
        if(!empty($result))
            echo json_encode($result);
    }
}
