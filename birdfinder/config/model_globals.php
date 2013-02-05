<?php
require_once( BF_LIB_DIR . 'UsefulDb/BaseModel.class.php');
require_once( BF_LIB_DIR . 'SupraModel/SupraModel.class.php');
global $connection_args;
$connection_args = array('dbuser'=>DBUSER,'dbname'=>DBNAME,'dbpassword'=>DBPASSWORD,'dbhost'=>DBHOST,'driver'=>DBDRIVER);
