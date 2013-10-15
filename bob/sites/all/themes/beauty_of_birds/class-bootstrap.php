<?php
require_once('classes/BOBThemeView.class.php');
require_once('classes/BOBThemeLogic.class.php');

$CLASS['BTL'] = new BOBThemeLogic();
$CLASS['BTV'] = new BOBThemeView($CLASS['BTL']);
