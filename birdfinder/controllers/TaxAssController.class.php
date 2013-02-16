<?php
class TaxAssController {

    public function getCreator() {

        echo TaxAssView::getCreator();
    }

    public function getModifier() {

        echo TaxAssView::getModifier();
    }

    /**
     * ajax method to get a select of taxonomies by
     * the taxonomy type id
     */
    public function getTaxonomySelector($args) {
        extract($args);

        $select = FormUtil::getTaxonomySelector($ttid);

        echo FormUtil::wrapDiv('Taxonomy:' . $select);
    }

    public function getBirdSelector($args) {
        extract($args);

        echo FormUtil::getBirdSelector($className,null,(bool)$isPropername);    
    }

    /**
     * ajax method to append inputs to the form
     */
    public function getCreateAssFormInputs($args) {
        extract($args); 

        echo TaxAssView::getCreateAssInputs(empty($withBird),$isPropername);
    }

    /**
     * indicate that a submission has been omitted if it already existed
     */
    public function saveForm($args) {
        extract($args);

        //var_dump($form_data);

        $input_groups = $this->parseFormData($form_data,3);

        //var_dump($input_groups);

        foreach($input_groups as $ig) {

           $saved = $this->saveInputGroup($ig);

           if(!empty($saved['flash'])) 
               $flashes[] = $saved['flash'];
        }

        echo json_encode(array('flashes'=>$flashes));    
    }

    /**
     * find existing, deleted, and modified flashes
     */
    public function saveModForm($args) {
        extract($args);

        foreach($form_data as $ig) {

            $saved = $this->modifyInputGroup($bird_id,$ig);

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

    public function getTaxonomies($args) {
        global $BirdTaxonomyModel;
        extract($args);
        $BirdTaxonomyModel->fetchTaxTypeByBirdId($bird_id);
        while($bird_tax = $BirdTaxonomyModel->fetchNextObject()) {
            $bird_taxes[] = $bird_tax;
            $html.= TaxAssView::getModifyAssInputs($bird_tax);
        }

        echo json_encode(array('bird_taxes'=>$bird_taxes,'html'=>$html));
    }

    private function parseFormData($form_data,$chunkCount) {

        $fd = explode('&',$form_data);

        $input_groups = array_chunk($fd,$chunkCount);

        foreach($input_groups as $i=>$input) {

            $input_groups[$i] = array();

            foreach($input as $in) {
                $keyval = explode('=',$in);
                $input_groups[$i][$keyval[0]] = $keyval[1];
            }
        }
       
        return $input_groups;
    }

    private function saveInputGroup($input_group) {
        global $BirdTaxonomyModel;

        extract($input_group); 

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

    
    private function modifyInputGroup($bird_id,$input_group) {
        global $BirdTaxonomyModel;

        extract($input_group);

        if($delete == "true") {
 
            $BirdTaxonomyModel->id = $id;
            $BirdTaxonomyModel->delete();
            $msg = 'Deleted An Association!';
            $class = "success";
        }
        else {
            $BirdTaxonomyModel->id = $id;
            $BirdTaxonomyModel->bird_id = $bird_id;
            $BirdTaxonomyModel->taxonomy_id = $taxonomy_id;
            $BirdTaxonomyModel->save();
            $msg = 'Saved An Association!';
            $class = "success";
        }

        $flash = FormUtil::wrapDiv($msg,'igFlash '. $class);

        return array('flash'=>$flash);
    }

}
