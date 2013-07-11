<?php
require_once(dirname(__FILE__) . '/../config/bootstrap.php');

require_once(dirname(__FILE__).'/../../birdfindermanager/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', symfony_deployment_environment, false);

$instance = sfContext::createInstance($configuration);
if(!$instance->getUser()->isAuthenticated()) {
    header("Location: " . bird_manager_url);
}

/*

$pCache = new CachePEAR('BobTemplate');

$cKeyName = 'bobTemplate_taxAss';

if($pCache->bEnabled) {

    if(!$pCache->getData($cKeyName)) {
*/
        $bt = new BobTemplate(bird_managertemplate_url);

        $enqueue ='
        <script type="text/javascript">var ajaxurl = \''.bird_interface_url.'ajax_handler.php\';</script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/taxAss.js"></script>
        <link href="css/taxAss.css" rel="stylesheet" />
        ';

        $bt->enqueueHead($enqueue);
        $html = $bt->getTemplate();
        $html->find('#frontpage-intro', 0)->innertext = FormUtil::wrapDiv(TaxAssView::getInterfaceToggle() . TaxAssView::getCreator(),'assApp');

/*
        $pCache->setData($cKeyName,(string)$html);
    }
    else {
        echo 'fart';
        $html = $pCache->getData($cKeyName);
    }
}
*/
echo $html;
