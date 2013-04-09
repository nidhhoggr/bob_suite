<?php
require_once(BF_LIB_DIR.'HTML-DOM-Parser/simple_html_dom.php');

class BobTemplate {

    function __construct($url) {
        $this->html_dom = file_get_html($url);
    }

    function setBaseHref($baseHref) {

        $this->enqueueHead('<base href="'.$baseHref.'">','before');
    }

    function enqueueHead($enqueue,$sequence = "after") {

        if($sequence == "after")
        $this->html_dom->find('head',0)->innertext .= $enqueue;
        else 
        $this->html_dom->find('head',0)->innertext = $enqueue . $this->html_dom->find('head',0)->innertext;
         
    }

    function setPageTitle($title) {

        $this->html_dom->find('title',0)->plaintext = "this is the title";
    }

    function removeHeadScripts() {
        
        foreach( $this->html_dom->find('script') as $script) { 
        $this->html_dom->find('head',0)->innertext = str_replace($script->outertext,"",$this->html_dom->find('head',0)->innertext);
        }
    }

    function resetContent($content="") {
        $this->html_dom->find('.sidebar-left', 0)->outertext = "";
        $this->html_dom->find('.topbanner', 0)->outertext = "";
        $this->html_dom->find('#bottom_ad2', 0)->outertext = "";
        $this->html_dom->find('#middle-wrapper', 0)->outertext = $content;
    }

    function getTemplate() {
        return $this->html_dom;
    }
}
