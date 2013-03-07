<?php
class TaxonomyController extends BaseController
{
    public function __construct() {

        parent::__construct(__CLASS__);
    }

    public function cleanDuplicateAssociations() {
        global $BirdModel, $BirdTaxonomyModel;

        $birds = $BirdModel->find();   

        foreach($birds as $bird) {

            $taxs = array();

            $BirdTaxonomyModel->findByTaxTypeAndBird(36,$bird['id']);

            echo $bird['name'] . "\r\n";

            while($bt = $BirdTaxonomyModel->fetchNextObject()) {

                if(!in_array($bt->name,$taxs)) {
                    $taxs[] = $bt->name;
                    echo "\t$bt->name" . "\r\n";
                }
                else {
                    $tax_remove[] = $bt->id;
                    echo "\t duplicate $bt->name" . "\r\n";
                    $BirdTaxonomyModel->deleteById($bt->id);
                }
            }
        }
    }

    public function resizeTaxList($result)
    {
        global $Utility;
        $row_count = $this->model->numRows();
        if ($row_count > 10) {
            $columnsOf = round($row_count / 2);
            $recordCount = 0;
            echo '<div id="column1">';
            while ($obj = $this->model->fetchNextObject($result)) {
                if ($recordCount == $columnsOf) echo '</div><div id="column2">';
                $dname = $Utility->dehumanizeString($obj->name);
                echo '<div id="checkbox">' . $obj->name . '<input type="checkbox" name="' . $dname . '" data-literal="' . $obj->name . '" value="' . $obj->id . '" /></div>';
                $recordCount++;
            }
            echo '</div>';
            echo '<div id="cleaner"></div>';
        } else {
            while ($obj = $this->model->fetchNextObject($result)) {
                $dname = $Utility->dehumanizeString($obj->name);
                echo '<div id="checkbox">' . $obj->name . '<input type="checkbox" name="' . $dname . '" data-literal="' . $obj->name . '" value="' . $obj->id . '" /></div>';
            }
        }
    }
}

