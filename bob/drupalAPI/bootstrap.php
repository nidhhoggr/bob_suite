<?php
chdir('../');
$dir = dirname(__FILE__);
require_once($dir . '/classes/DrupalBird.class.php');
require_once('./includes/bootstrap.inc');
require_once($dir . '/classes/DrupalModel.class.php');
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
define('BIRD_ORDER_VOCAB_ID',2);
define('BIRD_SPECIES_VOCAB_ID',7);
require_once($dir . '/../../birdfinder/config/bootstrap.php');
$DrupalModel = new DrupalModel($connection_args);
