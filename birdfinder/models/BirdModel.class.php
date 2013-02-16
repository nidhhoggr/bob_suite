<?php
//EXTEND THE BASE MODEL
class BirdModel extends SupraModel {

    //SET THE TABLE OF THE MODEL AND THE IDENTIFIER
    public function configure() {
        $this->setTable("bird");
    }

    public function fetchById($id) {

        $SQL = "SELECT * FROM bird WHERE id = $id ORDER BY name ASC";

        return $this->query($SQL);
    }

    public function findAll($sortBy="name") {

        $SQL = "SELECT * FROM bird ORDER BY $sortBy ASC";

        return $this->query($SQL);
    }

    public function getPropername($string) {
        
        $sql = "SELECT `propername` 
                FROM bird
                WHERE `name` = '$string'
                AND propername !=  ''";

        return $this->queryUniqueValue($sql);        
    }

    public function findByTaxonomyId($taxId) {
    
        $SQL = "SELECT b.*
                FROM bird as b
                LEFT JOIN bird_taxonomy as bt
                ON bt.bird_id = b.id
                WHERE bt.taxonomy_id = $taxId
                ORDER BY b.name ASC";

        return $this->query($SQL);
    }

    public function findAllByTaxonomyIds($ids) {

        $SQL = "SELECT b.*
                FROM bird AS b
                INNER JOIN bird_taxonomy AS bt ON bt.bird_id = b.id
                INNER JOIN taxonomy AS t ON t.id = bt.taxonomy_id
                WHERE t.id
                IN ( ".implode(',',$ids)." )
                GROUP BY b.id";

        return $this->query($SQL);
    }
}
