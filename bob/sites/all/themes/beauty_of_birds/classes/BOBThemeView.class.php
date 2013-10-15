<?php

class BOBThemeView {

    
   function __construct(BOBThemeLogic $btl) {

       $this->theme_logic = $btl;
   }

   function displayNodeTaxonomies($node_taxes_info) {

        foreach($node_taxes_info as $nti) {

            extract($nti);

            $content .= '<div class="node-tax-title"><a href="'.$link.'">'.$name.'('.$vocab.')</a></div>';

            $content .= '<div class="node-tax-image"><a href="'.$link.'"><img src="'.$image.'" height="200"/></a></div>';

        }

        return $content;
    }

    function getAndDisplayNodeTaxByNode($node) {

        $node_taxes_info = $this->theme_logic->getNodeTaxonomiesInfo($node);

        $content = $this->displayNodeTaxonomies($node_taxes_info);

        if(!empty($content))
            return '<div id="node-taxes-info">'.$content.'</div>'; 
    }

    function getMetaDataFields() {

        return array(

            'field_authorinfo'=>'Author Name and Contact Information',
            'field_licensing'=>'Licensing',
            'field_author_comments'=>'Author Comments'
        );

    }

    function displayMetaData($node)
    {

        $contents = null;

        $meta_data_fields = $this->getMetaDataFields();

        foreach($meta_data_fields as $class=>$label) {

            $node_val = $node->$class;

            if(!empty($node_val[0]['value'])) {
                $contents .= '<div class="md_'.$class.'"><h2>'.$label.'</h2><p class="md_value">'.$node_val[0]['value'].'</p></div>';
            }
        }
   
        $wrapped = '<div class="node_md">'.$contents.'</div>';

        return $wrapped;
    }
}
