<?php

class TaxAssView {

    public static function getCreator() {

        $form .= '<img id="one_for_all_img" />';
        $form .= FormUtil::wrapDiv("One For All?" . FormUtil::getBirdSelector("one_for_all"));
        $form .= self::getCreateAssForm();
        $form .= self::getCreateButtons();

        return $form;
    }

    
    public static function getModifier() {

        $form .= '<img id="modify_bird_img" />';
        $form .= FormUtil::wrapDiv("Bird: " . FormUtil::getBirdSelector("modify_bird"));
        $form .= self::getModifyAssForm();
        $form .= self::getModifyButtons();

        return $form;
    }

    public static function getCreateButtons() {

        $buttons = array('addAss'=>'Add Associator',
                         'remAss'=>'Delete Associator',
                         'putAss'=>'Save',
                         'wipeAss'=>'Reset');

        foreach($buttons as $k=>$v) $btns .= FormUtil::getButton($k,$v);

        return FormUtil::wrapDiv($btns,'btns');
    }

    public static function getModifyButtons() {

        $buttons = array(
                         'putModAss'=>'Save',
                         'wipeModAss'=>'Reset');

        foreach($buttons as $k=>$v) $btns .= FormUtil::getButton($k,$v);

        return FormUtil::wrapDiv($btns,'btns');
    }

    public static function getCreateAssForm($withBird=true) {

        $form = '<form class="assForm">' . self::getCreateAssInputs() . '</form>';
        return $form;
    }
  
    public static function getModifyAssForm($withBird=true) {

        $form = '<form class="assForm"></form>';
        return $form;
    }

    public static function getCreateAssInputs($withBird=true) {

        if($withBird)
        $form .= FormUtil::wrapDiv('Bird:' . FormUtil::getBirdSelector('of_tax'));
        $form .= FormUtil::wrapDiv('Taxonomy Type:' . FormUtil::getTaxonomyTypeSelector());
        return FormUtil::wrapDiv($form,'inputs');
    }

    public static function getModifyAssInputs($bird) {
        $form .= FormUtil::wrapDiv('Bird:' . FormUtil::getBirdSelector('of_tax',$bird->id));
        $form .= FormUtil::wrapDiv('Taxonomy Type:' . FormUtil::getTaxonomyTypeSelector($bird->taxonomytype_id));
        $form .= FormUtil::wrapDiv('Taxonomy:' . FormUtil::getTaxonomySelector($bird->taxonomytype_id,$bird->taxonomy_id));
        return FormUtil::wrapDiv($form,'inputs');
    }
}

