<?php
require_once(dirname(__FILE__) . '/classes/DrupalModel.class.php');
$dbuser = 'root';
$dbpassword  = 'root';
$dbname = 'bob';
$dbhost = 'localhost';
$driver = 'mysql';

$connection_args = compact('dbuser','dbname','dbpassword','dbhost','driver');

$DrupalModel = new DrupalModel($connection_args);
//$DrupalModel->cleanTaxAndNode(" > 105");
$DrupalModel->cleanNode(" > 226");
$DrupalModel->cleanTax(" > 0");
$DrupalModel->cleanUrlAliases("pid > 463");

