<?php
class BirdTaxonomyModel extends BaseModel {

    //SET THE TABLE OF THE MODEL AND THE IDENTIFIER
    protected function configure() {
        $this->setTable("bird_taxonomy");
    }

    public function fetchWhereIn($field,$in) {

        $sql="SELECT bt.* 
              FROM bird_taxonomy AS bt
              LEFT JOIN taxonomy AS t ON t.id = bt.taxonomy_id
              WHERE $field IN (". implode(",",$in)  .")";

        $result = $this->query($sql);

        return $result;
    }


}
