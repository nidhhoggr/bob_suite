<?php
class BirdTaxonomyModel extends BaseModel {

    //SET THE TABLE OF THE MODEL AND THE IDENTIFIER
    protected function configure() {
        $this->setTable("bird_taxonomy");
    }

    public function findByTaxTypeAndBird($taxtype_id,$bird_id) {

        $sql="SELECT t.*
              FROM bird_taxonomy bt
              JOIN taxonomy t
              ON t.id = bt.taxonomy_id
              WHERE t.taxonomytype_id = $taxtype_id
              AND bt.bird_id = $bird_id";

        $result = $this->query($sql);

        return $result;
    }

    public function fetchWhereIn($field,$in) {

        $sql="SELECT bt.* 
              FROM bird_taxonomy AS bt
              LEFT JOIN taxonomy AS t ON t.id = bt.taxonomy_id
              WHERE $field IN (". implode(",",$in)  .")";

        $result = $this->query($sql);

        return $result;
    }

    public function fetchTaxTypeByBirdId($bird_id,$taxonomytype_id=null) {

        $sql="SELECT bt.id, bt.taxonomy_id, t.taxonomytype_id
              FROM bird b
              JOIN bird_taxonomy as bt
              ON b.id = bt.bird_id
              JOIN taxonomy t
              ON t.id = bt.taxonomy_id
              JOIN taxonomytype tt
              ON t.taxonomytype_id = tt.id
              WHERE b.id = $bird_id ";

        $sql .= !empty($taxonomytype_id)?" AND t.taxonomytype_id = $taxonomytype_id ":'';

        $sql .= "ORDER BY tt.weight, t.name ASC";

        $result = $this->query($sql);

        return $result;
    }

    public function deleteById($id) {

        $sql="DELETE FROM bird_taxonomy WHERE id = $id";
        $this->execute($sql);
    }
}
