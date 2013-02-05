<?php

$wikiUrl = "http://en.wikipedia.org";


$birds = $BirdModel->findBy(array('conditions'=>"paraphrased = 1"));
$html = new simple_html_dom();


foreach($birds as $bird) {

    $html->load($bird['wikipedia']);

    $image = $html->find('.image', 0);

    if($image) {
   
        $content = null;

        //get the image
        //$imageUrl = $wikiUrl . $image->href;

        //get the scientific name
        //$binomial = $html->find('.binomial i',0)->innertext;

        //scrape and strip the content
        //foreach($html->find('p') as $paragraph) {
 
        //    $content .= strip_tags($paragraph->innertext);
        //}

        //get the conservation status
        $conservationDiv = $html->find('img[height=59]',0)->parent;

        if($conservationDiv) { 
            $conservationStatus = $conservationDiv->find('a',0)->innertext;
            saveBirdTaxonomy($conservationStatus,$bird['id']);
        }

        //saveBird($bird,$imageUrl,$binomial,$content);

        var_dump($bird['id']);
    }
}

function saveBird($bird, $imageUrl,$binomial,$content) {
        global $BirdModel;

        $BirdModel->id = $bird['id'];

        $BirdModel->imageurl = $imageUrl;

        $BirdModel->propername = $binomial;

        $BirdModel->about = mysql_real_escape_string($content);
 
        $BirdModel->save();
}

function saveBirdTaxonomy($conSta,$bird_id) {
    global $BirdTaxonomyModel, $TaxonomyModel;

    $taxonomytype_id = 37;
  
    $tax = $TaxonomyModel->findByNameAndTypeId($conSta,$taxonomytype_id);

    $BirdTaxonomyModel->taxonomy_id = $tax['id'];
    $BirdTaxonomyModel->bird_id = $bird_id;
    $BirdTaxonomyModel->save();
}
