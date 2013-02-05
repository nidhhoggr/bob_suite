<?php

$hdp = new simple_html_dom();
$hdp->load_file(dirname(__FILE__) . '/index.html');

$exceptions = array('location','body-shape','size','color','bill-shape','wing-shape');

foreach($hdp->find('.BrowseTable') as $taxonomytyperow) {

    $taxtypename = $taxonomytyperow->find('.BrowseTableHeader a');
    $taxtypename = dir_name($taxtypename[0]->innertext);

    if(!in_array($taxtypename,$exceptions)) {

        echo "$taxtypename \n";
        exec("mkdir work/$taxtypename");

        foreach($taxonomytyperow->find('table a') as $links) {

            $taxonomy = dir_name($links->innertext);
            $link = $links->href;
            echo "\t$taxonomy\n";
            exec("mkdir work/$taxtypename/$taxonomy");
            exec("curl '$link' > work/$taxtypename/$taxonomy/index.html");

        }
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
