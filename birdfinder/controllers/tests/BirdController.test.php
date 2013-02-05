<?php

require_once(dirname(__FILE__) . '/../../config/bootstrap.php');
$test = new BirdController();

$test->displaySelectedBirds(array(260));
