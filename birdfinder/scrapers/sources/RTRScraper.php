<?php

$hdp = new simple_html_dom();
$hdp->load_file(dirname(__FILE__) . '/rtr.html');

$ttcount = 0;
foreach($hdp->find('form p') as $taxonomytyperow) {
    if($ttcount<=10) {
    $ttcount++;
    $taxtypename = $taxonomytyperow->find('b');
    $taxtypename = dir_name($taxtypename[0]->innertext);

        echo "$taxtypename \n";
        exec("mkdir work/$taxtypename");

        foreach($taxonomytyperow->find('input') as $inputs) {

            $taxonomy = dir_name($inputs->value);

            $url = "http://www.realtimerendering.com/cgi-bin/birds.cgi?". $inputs->name . '=' . $inputs->value;
            echo "\t$taxonomy\n";
            exec("mkdir work/$taxtypename/$taxonomy");
            exec("curl '$url' > work/$taxtypename/$taxonomy/index.html");

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
