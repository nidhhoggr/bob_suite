<?php
require_once(dirname(__FILE__) . '/../config/bootstrap.php');
require_once(dirname(__FILE__) . '/template/bob_template.class.php');

/**
 * check if the association already exists before populating
 */

$bt = new BobTemplate("http://supraliminalsolutions.com/clients/sibylle/birdfindermanager/web/backend.php/bird");

$styling =<<<EOF

<style type="text/css">

.assForm .inputs {

    width: 500px;
    border: 1px inset #000;
    padding: 10px;
    margin: 15px;
    background-color: #FCFFF0;
}

.assApp .input {
    margin: 5px 5px 20px;
    font-weight: bold; 
}

.assApp .input select {
    
    display: block;
    margin-left: 20px;
}

.assApp .igFlash {

    width: 100%;
    background-color: #FAF0E6;
    border: 1px solid #EECBAD;
    marging: 3px;
    padding: 3px;
}

.assApp .error {
    color: #FF3300;
    font-weight: bold;
}

.assApp .success {
    color: #385E0F;
    font-weight: bold;
}

</style>

EOF;

$scripts = '<script type="text/javascript">var ajaxurl = \''.bird_interface_url.'ajax_handler.php\';</script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/taxAss.js"></script>';

$bt->enqueueHead($styling.$scripts);
$html = $bt->getTemplate();


$html->find('#frontpage-intro', 0)->innertext = FormUtil::wrapDiv(TaxAssView::getModifier(),'assApp');

echo $html;
