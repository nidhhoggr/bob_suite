<?php
require_once(dirname(__FILE__) . '/../config/bootstrap.php');
require_once(dirname(__FILE__) . '/template/bob_template.class.php');

$it = new BobTemplate("http://supraliminalsolutions.com/clients/sibylle/birdfinder/interface/old.php");
$interface = $it->getTemplate();

$head = $interface->find('head',0)->innertext;

$head .= <<<EOF

<script type="text/javascript">

$(function() {
    $('a.active').parent().removeClass('active-trail');
    $('a:contains("Bird ID")').parent().addClass('active-trail');
});

</script>

EOF;
$content = $interface->find('#tabs', 0)->outertext;

$bt = new BobTemplate("http://supraliminalsolutions.com/clients/sibylle/bob/");
//$bt->setBaseHref("http://clonedparts.com/");
$bt->removeHeadScripts();
$bt->enqueueHead($head);
$bt->resetContent($content);
echo $bt->getTemplate();
