<?php

require_once(dirname(__FILE__) . '/../config/bootstrap.php');
require_once(dirname(__FILE__) . '/merger.php');

$mergings[15] = array(
    'forked-tail'=>array(334,464)
);

//Habitat
$mergings[32] = array(
    'Deserts'=>array(15,218),
    'Forests'=>array(443,219),
    'Urban'=>array(225,27),
    'Oceans'=>array(224,22),
    'Grasslands'=>array(17,220),
    'Marshes'=>array(442,222,18)
);

//color
$mergings[33] = array(
    'black'=>array(1,84,431),
    'blackandwhite'=>array(432,2),
    'blue'=>array(85,433,3),
    'brown'=>array(86,4,434),
    'gray'=>array(5,88),
    'green'=>array(435,89),
    'yellow'=>array(10,99,439),
    'white'=>array(438,98,9),
    'rust'=>array(437,95),
    'red'=>array(94,436)
);

//body shape
$mergings[34] = array(
    'chicken'=>array(28,70),
    'duck'=>array(29,71),
    'gull'=>array(30,72),
    'hawk'=>array(31,73),
    'hummingbird'=>array(32,74),
    'long-legged'=>array(75,33),
    'owl'=>array(76,34),
    'perching'=>array(36,77),
    'pigeon'=>array(37,78),
    'sandpiper'=>array(38,79),
    'swallow'=>array(39,80),
    'tree-clinging'=>array(40,81),
    'upland-ground'=>array(82,41),
    'upright-perching-water'=>array(83,42),
);

//size
$mergings[35] = array(
    'large'=>array(43,328,331,466),
    'medium'=>array(44,329,467),
    'small'=>array(330,45,468,332)
);

mergeTaxonomies($mergings);
