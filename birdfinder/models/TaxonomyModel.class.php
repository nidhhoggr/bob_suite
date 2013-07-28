<?php
class TaxonomyModel extends SupraModel {

    //SET THE TABLE OF THE MODEL AND THE IDENTIFIER
    public function configure() {
        $this->setTable("taxonomy");
    }

    public function fetchWhereIn($in) {

        $sql = "SELECT t.*, s.name as sName FROM taxonomy as t 
                LEFT JOIN taxonomy_source as ts
                ON ts.taxonomy_id = t.id
                LEFT JOIN source as s
                ON s.id = ts.source_id
                WHERE taxonomytype_id IN (" . implode(",",$in)  . ")
                ORDER BY t.name ASC";

        $result = $this->query($sql);

        return $result;
    }

    public function findByBirdId($bird_id) {

        $sql = "SELECT t.*
                FROM bird AS b
                LEFT JOIN bird_taxonomy AS bt ON bt.bird_id = b.id
                LEFT JOIN taxonomy as t ON t.id =bt.taxonomy_id
                WHERE bt.bird_id = $bird_id 
                GROUP BY t.id";

        $result = $this->query($sql);

        return $result;
    }

    public function findByBirdIdAndTaxonomyTypeId($bird_id,$taxtype_id) {

        $sql = "SELECT t. * 
        FROM bird AS b
        LEFT JOIN bird_taxonomy AS bt ON bt.bird_id = b.id
        LEFT JOIN taxonomy AS t ON t.id = bt.taxonomy_id
        LEFT JOIN taxonomytype AS tt ON tt.id = t.taxonomytype_id
        WHERE bt.bird_id = $bird_id AND tt.id = $taxtype_id
        GROUP BY t.id";

        $result = $this->query($sql);

        return $result;
    }

    public function findByNameAndTypeId($name,$id) {
  
        return $this->findOneBy(array('conditions'=>array(
            "name LIKE '$name'",
            "taxonomytype_id = $id"
        )));
    }

    public function fetchChildSpeciesByOrderId($id) {

    } 

    public function nullifyDrupalInfo($id) {
        $sql = "update taxonomy set drupalinfo = NULL where id = $id";
        $this->execute($sql);
    }
}
