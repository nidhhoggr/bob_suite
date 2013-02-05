<?php

require_once(dirname(__FILE__)  . '/includes/bootstrap.inc');

drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);


//create a term

/*
$term = array(
    'vid' => 2, // Voacabulary ID
    'name' => 'Fart Smoker', // Term Name 
    'description' => 'This bird is infamous for smoking farts'
);

taxonomy_save_term($term);
*/

//update a term

/*
$term = array(
    'tid' => 115,
    'name'=>'fart smoking mongolian',
    'description' => 'This bird is infamous for smoking farts'
);

taxonomy_save_term($term);
*/

//add image from url

//taxonomy_image_add_from_url(115,'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRSiZLaRxq7JsSrHlEww-1i5gR0f1s4yWY2IuF-zfKoKl1_QH4dk85k-w','fartsmoker.jpg');

//delete taxonomy image

$db = array(
85,
19,
74,
59,
27,
4,
15,
35,
40,
32,
53,
22,
45,
31,
8,
60,
66,
33,
83,
28,
11,
88,
21,
69,
42,
56,
99,
26,
84,
1,
50,
44,
39,
57,
106,
68,
61,
92,
65,
90,
76,
95,
51,
78
);

foreach($db as $d) 
    taxonomy_del_term($d);    



//taxonomy_image_delete($d);
