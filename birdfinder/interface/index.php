<?php
require_once(dirname(__FILE__) . '/../config/bootstrap.php');

$it = new BobTemplate(bird_interface_url . "old.php");

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

$bt = new BobTemplate(bird_drupal_url);
$bt->removeHeadScripts();
$bt->enqueueHead($head);
$bt->resetContent($content);
echo $bt->getTemplate();
