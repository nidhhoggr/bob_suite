<?php
class FormUtil {

    public static function getButton($id,$value) {
        return '<button id="'.$id.'">'.$value.'</button>';
    }

    public static function wrapDiv($input, $class='input') {
        return '<div class="'.$class.'">'.$input.'</div>';
    }
  
    //needs to be cached
    public static function getBirdSelector($select_id=null,$selected=null,$propername=false) {
        global $BirdModel;

        $pCache = new CachePEAR('FormUtil');

        $cKeyName = 'getBirdSelector_' . $select_id;
        $cKeyName .= ($propername)?'_propername':'';

        if($pCache->bEnabled) {
   
            if(!$pCache->getData($cKeyName)) {

                $content ='<select class="bird_id_'.$select_id.'" name="bird_id"><option value="0"> - select - </option>';

                $BirdModel->findAll(($propername)?'propername':'name');

                while($bird = $BirdModel->fetchNextObject()) {
  
                    $content .='<option value="'.$bird->id.'"';
  
                    if($bird->id == $selected)            
                        $content .= ' selected="selected" ';

                    if($propername)
                        $content .='>'.$bird->propername.'</option>';
                    else
                        $content .='>'.$bird->name.'</option>';
                }

                $content .= '</select>';

                $pCache->setData($cKeyName,$content);
            }
            else {
                $content .= $pCache->getData($cKeyName);
            }
        }

        return $content;
    }

    //needs to be cached
    public static function getTaxonomySelector($ttid,$selected=null) {
        global $TaxonomyModel;

        $pCache = new CachePEAR('FormUtil');

        $cKeyName = 'getTaxonomySelector_'.$ttid;

        if($pCache->bEnabled) {
   
            if(!$pCache->getData($cKeyName)) {

                $content ='<select class="taxonomy_id" name="taxonomy_id"><option value="0"> - select - </option>';

                $TaxonomyModel->query("SELECT * FROM taxonomy WHERE taxonomytype_id = ".$ttid." ORDER BY name ASC");

                while($tm = $TaxonomyModel->fetchNextObject()) {

                    $content .='<option value="'.$tm->id.'"';

                    if($tm->id == $selected) 
                        $content .= ' selected="selected" ';

                    $content .='>'.$tm->name.'</option>';
                }

                $content .= '</select>';

                $pCache->setData($cKeyName,$content);
            }
            else {
                $content .= $pCache->getData($cKeyName);
            }
        }

        return $content;
    }

    //needs to be cached
    public static function getTaxonomyTypeSelector($selected=null,$id="taxonomy_type_id") {
        global $TaxonomyTypeModel;

        $pCache = new CachePEAR('FormUtil');

        $cKeyName = 'getTaxonomTypeSelector_' . $id;

        if($pCache->bEnabled) {

            if(!$pCache->getData($cKeyName)) {

                $content ='<select id="'.$id.'" class="'.$id.'" name="'.$id.'"><option value="0"> - select - </option>';

                $TaxonomyTypeModel->query("SELECT * FROM taxonomytype ORDER BY name ASC");

                while($tt = $TaxonomyTypeModel->fetchNextObject()) {

                    $content .='<option value="'.$tt->id.'"';

                    if($tt->id == $selected) 
                        $content .= ' selected="selected" ';

                    $content .='>'.$tt->name.'</option>';
                }

                $content .= '</select>';

                $pCache->setData($cKeyName,$content);
            }
            else {
                $content .= $pCache->getData($cKeyName);
            }
        }

        return $content;
    }

    public static function getCheckbox($class) {

        return '<input type="checkbox" class="'.$class.'" />';
    }

    public static function getRadio($name,$id,$extra=null) {

        return '<input type="radio" name="'.$name.'" id="'.$id.'" '.$extra.'/>';
    }
}
