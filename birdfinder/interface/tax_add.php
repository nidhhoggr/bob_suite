<?php
require_once(dirname(__FILE__) . '/../config/bootstrap.php');
require_once(dirname(__FILE__) . '/template/bob_template.class.php');

/**
 * check if the association already exists before populating
 */

$bt = new BobTemplate("http://supraliminalsolutions.com/clients/sibylle/birdfindermanager/web/backend.php/bird");

$styling =<<<EOF

<style type="text/css">

.assForm {

    width: 500px;
    border: 1px inset #000;
    padding: 10px;
    margin: 15px;

}

.assApp .input {
    margin: 5px 5px 20px;
    font-weight: bold; 
}

.assApp .input select {
    
    display: block;
    margin-left: 20px;
}

</style>

EOF;


$bt->enqueueHead($styling);
$html = $bt->getTemplate();

$content = FormUtil::wrapDiv("One For All?" . FormUtil::getBirdSelector()) . getAssForm() . getButtons();

$html->find('#frontpage-intro', 0)->innertext = FormUtil::wrapDiv($content,'assApp');

echo $html;

function getButtons() {

    $buttons = array('addAss'=>'Add Associator',
                     'remAss'=>'Delete Associator',
                     'putAss'=>'Save');

    foreach($buttons as $k=>$v) $btns .= FormUtil::getButton($k,$v);

    return FormUtil::wrapDiv($btns,'btns');
}

function getAssForm() {

    return '<form class="assForm">'.FormUtil::wrapDiv('Bird:' . FormUtil::getBirdSelector()) . 
            FormUtil::wrapDiv('Taxonomy Type:' . FormUtil::getTaxonomyTypeSelector()).'</form>';
}
