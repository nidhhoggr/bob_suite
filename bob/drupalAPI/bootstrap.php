<?php
require_once(dirname(__FILE__) . '/classes/DrupalBird.class.php');
require_once(dirname(__FILE__) . '/../includes/bootstrap.inc');
require_once(dirname(__FILE__) . '/classes/DrupalModel.class.php');
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
define('BIRD_ORDER_VOCAB_ID',2);
define('BIRD_SPECIES_VOCAB_ID',7);
require_once(dirname(__FILE__) . '/../../birdfinder/config/bootstrap.php');
$DrupalModel = new DrupalModel($connection_args);
