<?php

require_once(dirname(__FILE__) . '/../../libs/HTML-DOM-Parser/simple_html_dom.php');

class BobTemplate {


    function __construct($url) {
        $this->html_dom = new simple_html_dom();
        $this->loadHtml($url);
    }

    function loadHtml($url) { 

        $this->html_dom->load_file($url);

        $this->template = $this->html_dom; //;->find('html', 0);
    }

    function setBaseHref($baseHref) {

        $this->enqueueHead('<base href="'.$baseHref.'">','before');
    }

    function enqueueHead($enqueue,$sequence = "after") {

        if($sequence == "after")
        $this->template->find('head',0)->innertext .= $enqueue;
        else 
        $this->template->find('head',0)->innertext = $enqueue . $this->template->find('head',0)->innertext;
         
    }

    function setPageTtitle($title) {

        $this->template->find('title',0)->plaintext = "this is the titile";
    }

    function removeHeadScripts() {
        
        foreach( $this->template->find('script') as $script) { 
        $this->template->find('head',0)->innertext = str_replace($script->outertext,"",$this->template->find('head',0)->innertext);
        }
    }

    function resetContent($content="") {
        $this->template->find('.sidebar-left', 0)->outertext = "";
        $this->template->find('#middle-wrapper', 0)->outertext = $content;
    }

    function getTemplate() {
        return $this->template;
    }
}
