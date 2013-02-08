<?php
class FormUtil {

    public static function getButton($id,$value) {
        return '<button id="'.$id.'">'.$value.'</button>';
    }

    public static function wrapDiv($input, $class='input') {
        return '<div class="'.$class.'">'.$input.'</div>';
    }

    public static function getBirdSelector($select_id=null) {
        global $BirdModel;

        $content ='<select class="bird_id_'.$select_id.'" name="bird_id"><option value="0"> - select - </option>';

        $BirdModel->findAll();

        while($bird = $BirdModel->fetchNextObject()) {

            $content .='<option value="'.$bird->id.'">'.$bird->name.'</option>';
        }

        $content .= '</select>';

        return $content;
    }

    public static function getTaxonomySelector($ttid) {
        global $TaxonomyModel;

        $content ='<select name="taxonomy_id"><option value="0"> - select - </option>';

        $TaxonomyModel->query("SELECT * FROM taxonomy WHERE taxonomytype_id = ".$ttid." ORDER BY name ASC");

        while($tm = $TaxonomyModel->fetchNextObject()) {

            $content .='<option value="'.$tm->id.'">'.$tm->name.'</option>';
        }

        $content .= '</select>';

        return $content;
    }

    public static function getTaxonomyTypeSelector() {
        global $TaxonomyTypeModel;

        $content ='<select name="taxonomy_type_id"><option value="0"> - select - </option>';

        $TaxonomyTypeModel->query("SELECT * FROM taxonomytype ORDER BY name ASC");

        while($tt = $TaxonomyTypeModel->fetchNextObject()) {

            $content .='<option value="'.$tt->id.'">'.$tt->name.'</option>';
        }

        $content .= '</select>';

        return $content;
    }
}
