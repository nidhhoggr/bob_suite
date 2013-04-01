<?php
class BirdController extends BaseController {

    public function __construct() {

        parent::__construct(__CLASS__);
    }

    public function displaySelectedBirds($taxonomy_ids) {
        global $Utility;

        if(!empty($taxonomy_ids)) {

            $this->model->findAllByTaxonomyIds($taxonomy_ids);
            $count = $this->model->numRows();
        } 
        else {
            $count = 0;
        }

        $html = '<div id="selectedBirdCount">Total Birds <span class="counter">'.$count.'</span></div>';

        $html .= '<table id="selectedBirds">';

        $rowCount = 0;

        while($sb = $this->model->fetchNextObject()) {

            if($rowCount == 3) {

                $rowCount = 0;
              
                $html .= '<tr class="selectedBirdRow">'. $rowHtml .'</tr>';

                $rowHtml = null;
            }

            $urlname = $Utility->dehumanizeString($sb->name);
 
            $route = bird_drupal_url . "bird-species/".$urlname;

            $imageurl = bird_drupal_url . "sites/default/files/imagecache/image_70X70/category_pictures/sync_" . $urlname . ".jpg";

            $rowHtml .= '<td><h4 class="row_birdName"><a href="'.$route.'">' . $sb->name . '</a></h4><a href="'.$route.'"><img src="'.$imageurl.'" /></a></td>';

            $rowCount++;
        }
        
        $html .= '</div>';

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
