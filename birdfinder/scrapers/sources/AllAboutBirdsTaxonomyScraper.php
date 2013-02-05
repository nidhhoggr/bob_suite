<?php
for($i=1;$i<=100;$i++) {

    $url = "http://www.allaboutbirds.org/guide/browse_tax/".$i."/";

    $hdp = new simple_html_dom();
    $hdp->load_file($url);

    if(count($hdp->find('.species_item')) > 0) {
        $birdnameandorder = $hdp->find('#browse_viewing .page');
        $birdnameandorderspan = $hdp->find('#browse_viewing .page span');
        $birdnameandorder = $birdnameandorder[0]->innertext;
        $birdnameandorderspan= $birdnameandorderspan[0]->innertext;
        $taxname = dir_name(strip_tags(str_replace($birdnameandorderspan,'',$birdnameandorder)));
        exec("mkdir work/order/$taxname");
        exec("curl '$url' > work/order/$taxname/index.html");
    }
}

function dir_name($name) {

    //remove commas
    $name = str_replace(',','',$name);
    //remove spaces with dashes
    $name = str_replace(' ','-',$name);
    //repace open paren with dash
    $name = str_replace('(','-',$name);
    //remove close paren
    $name = str_replace(')','',$name);
    //remove double dashes
    $name = str_replace('--','-',$name);

    //convert to lowercase
    $name = strtolower($name);

    return $name;
}
