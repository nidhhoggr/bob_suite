<?php
//chdir('../');
$diro = __DIR__;
//$diro = dirname(__FILE__);

require_once($diro . '/classes/DrupalBird.class.php');
require_once('./includes/bootstrap.inc');
require_once($diro . '/classes/DrupalModel.class.php');
require_once($diro . '/classes/DrupalURLAliases.php');
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
define('BIRD_ORDER_VOCAB_ID',2);
define('BIRD_SPECIES_VOCAB_ID',7);
require_once(__DIR__ . '/../../birdfinder/config/bootstrap.php');
$DrupalModel = new DrupalModel($connection_args);
