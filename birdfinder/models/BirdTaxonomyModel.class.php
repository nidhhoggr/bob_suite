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

    public function fetchTaxTypeByBirdId($bird_id) {

        $sql="SELECT b.id, bt.taxonomy_id, t.taxonomytype_id
              FROM bird b
              JOIN bird_taxonomy as bt
              ON b.id = bt.bird_id
              JOIN taxonomy t
              ON t.id = bt.taxonomy_id
              WHERE b.id = $bird_id";

        $result = $this->query($sql);

        return $result;
    }
}
