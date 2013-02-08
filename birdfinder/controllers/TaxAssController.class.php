<?php
class TaxAssController {

    /**
     * ajax method to get a select of taxonomies by
     * the taxonomy type id
     */
    public function getTaxonomySelector($args) {
        extract($args);

        $select = FormUtil::getTaxonomySelector($ttid);

        echo FormUtil::wrapDiv('Taxonomy:' . $select);
    }
 
    /**
     * ajax method to append inputs to the form
     */
    public function getCreateAssFormInputs($args) {
        extract($args); 

        echo TaxAssView::getCreateAssInputs(empty($withBird));
    }

    /**
     * indicate that a submission has been omitted if it already existed
     */
    public function saveForm($args) {
        extract($args);

        //var_dump($form_data);

        $input_groups = $this->parseFormData($form_data);

        //var_dump($input_groups);

        foreach($input_groups as $ig) {

           $saved = $this->saveInputGroup($ig);

           if(!empty($saved['flash'])) 
               $flashes[] = $saved['flash'];
        }

        echo json_encode(array('flashes'=>$flashes));    
    }

    public function getBird($args) {
        global $BirdModel;
        extract($args);
        $birds = $BirdModel->findBy(array('conditions'=>array("id=".$bird_id),'fetchArray'=>true));
        echo json_encode($birds[0]);
    }

    private function parseFormData($form_data) {

        $fd = explode('&',$form_data);

        $input_groups = array_chunk($fd,3);

        foreach($input_groups as $i=>$input) {

            $input_groups[$i] = array();

            foreach($input as $in) {
                $keyval = explode('=',$in);
                $input_groups[$i][$keyval[0]] = $keyval[1];
            }
        }
       
        return $input_groups;
    }

    private function saveInputGroup($ig) {
        global $BirdTaxonomyModel;

        extract($ig);

        $exists = $BirdTaxonomyModel->find(array(
            'bird_id='.$bird_id,
            'taxonomy_id='.$taxonomy_id
        ));

        if(count($exists) == 0) { 

            $BirdTaxonomyModel->bird_id = $bird_id;
            $BirdTaxonomyModel->taxonomy_id = $taxonomy_id;
            $BirdTaxonomyModel->save();
            $msg = 'Saved An Association!';
            $class = "success";
        }
        else {
            $msg = 'An Association Already Existed!';
            $class = "error";
        }

        $flash = FormUtil::wrapDiv($msg,'igFlash '. $class);

        return array('flash'=>$flash);
    }
}
