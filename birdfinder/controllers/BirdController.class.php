<?php
class BirdController extends BaseController {

    public function __construct() {

        parent::__construct(__CLASS__);
    }

    public function displaySelectedBirds($taxonomy_ids) {

        if(!empty($taxonomy_ids)) {

            $this->model->findAllByTaxonomyIds($taxonomy_ids);
            $count = $this->model->numRows();
        } 
        else {
            $count = 0;
        }

        $html = '<div id="selectedBirdCount">Total Birds <span class="counter">'.$count.'</span></div>';

        $html .= '<ul>';

        while($sb = $this->model->fetchNextObject()) {
  
            $html .= '<li><a target="_blank" href="bird.php?id='.$sb->id.'">' . $sb->name . '</a></li>';
        }
        
        $html .= '</ul>';

        echo $html;
    }

    public function displayAssociatedTags($bird_id) {
        global $TaxonomyTypeModel, $TaxonomyModel;


        $TaxonomyTypeModel->findByBirdId($bird_id);

          while ($taxtype = $TaxonomyTypeModel->fetchNextObject()) {

              $TaxonomyModel->findByBirdIdAndTaxonomyTypeId($bird_id,$taxtype->id);

              $tags .= '<span id="taxtype_label">'.$taxtype->name.'</span>';
              $tags .= '<div id="selection_log">';

              while ($tax = $TaxonomyModel->fetchNextObject()) {
                  $tags .= '<div class="unremovable_tag">'.$tax->name.'</div>';
              }

              $tags .= '</div><div id="cleaner"></div>';
          }

        return $tags;
    }
}
