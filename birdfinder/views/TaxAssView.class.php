<?php

class TaxAssView {

    public static function getCreator() {

        $form .= '<img id="one_for_all_img" />';
        $form .= FormUtil::wrapDiv("One For All?" . self::getBirdSortToggle() . FormUtil::getBirdSelector("one_for_all"),'one-for-all-wrap');
        $form .= self::getCreateAssForm();
        $form .= self::getCreateButtons();

        return FormUtil::wrapDiv($form,'interfaceContainer');
    }

    
    public static function getModifier() {

        $form .= '<img id="modify_bird_img" />';
        $form .= FormUtil::wrapDiv("Bird: " . self::getBirdSortToggle() . FormUtil::getBirdSelector("modify_bird"));
        $form .= FormUtil::wrapDiv("Taxonomy Type: " . FormUtil::getTaxonomyTypeSelector(null,"modify_bird_taxtype"));
        $form .= self::getModifyAssForm();
        $form .= self::getModifyButtons();

        return FormUtil::wrapDiv($form,'interfaceContainer');
    }

    public static function getCreateButtons() {

        $buttons = array('addAss'=>'Add Associator',
                         'remAss'=>'Delete Associator',
                         'putAss'=>'Save',
                         'wipeAss'=>'Reset');

        foreach($buttons as $k=>$v) $btns .= FormUtil::getButton($k,$v);

        return FormUtil::wrapDiv($btns,'btns');
    }

    public static function getInterfaceToggle() {

        $name = "interface_toggle";

        $rad .= FormUtil::wrapDiv("Creator " . FormUtil::getRadio($name,"toggleCreator",'checked'));
        $rad .= FormUtil::wrapDiv("Modifier " . FormUtil::getRadio($name,"toggleModifier"));

        return FormUtil::wrapDiv($rad,'interfaceToggle');
    }

    public static function getBirdSortToggle() {

        $name = "bird_sort_toggle";

        $rad .= FormUtil::wrapDiv("Bird Name " . FormUtil::getRadio($name,"toggleBirdName",'checked'));
        $rad .= FormUtil::wrapDiv("Bird Proper Name " . FormUtil::getRadio($name,"toggleBirdProperName"));

        return FormUtil::wrapDiv($rad,'birdSortToggle');
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

    public static function getCreateAssInputs($withBird=true,$isPropername=false) {

        if($withBird)
        $form .= FormUtil::wrapDiv('Bird:' . FormUtil::getBirdSelector('of_tax',null,(bool)$isPropername));
        $form .= FormUtil::wrapDiv('Taxonomy Type:' . FormUtil::getTaxonomyTypeSelector());
        return FormUtil::wrapDiv($form,'inputs');
    }

    public static function getModifyAssInputs($bird_tax) {
        $form .= FormUtil::wrapDiv('Taxonomy Type:' . FormUtil::getTaxonomyTypeSelector());
        $form .= FormUtil::wrapDiv('Taxonomy:' . FormUtil::getTaxonomySelector($bird_tax->taxonomytype_id));
        $form .= FormUtil::wrapDiv('Delete:' . FormUtil::getCheckbox('deleteAss'));
        $form .= FormUtil::wrapDiv('<input type="hidden" class="birdtaxonomy_id" value="'.$bird_tax->id.'" />');
        return FormUtil::wrapDiv($form,'inputs');
    }
}

