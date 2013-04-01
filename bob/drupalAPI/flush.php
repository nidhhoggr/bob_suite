<?php
require_once(dirname(__FILE__) . '/bootstrap.php');
//$DrupalModel->cleanTaxAndNode(" > 105");
$DrupalModel->cleanNode(" > 226");
$DrupalModel->cleanTax(" > 0");
$DrupalModel->cleanUrlAliases("pid > 463");
