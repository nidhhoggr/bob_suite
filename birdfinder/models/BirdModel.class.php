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
                GROUP BY b.id
                ORDER BY b.name ASC";

        return $this->query($SQL);
    }

    public function findAllByTaxonomyIds($ids) {

        $birds_exclusive = array();

        foreach($ids as $id) {

            $SQL = "SELECT b.id
                    FROM bird AS b
                    INNER JOIN bird_taxonomy AS bt ON bt.bird_id = b.id
                    INNER JOIN taxonomy AS t ON t.id = bt.taxonomy_id
                    WHERE t.id = $id
                    GROUP BY b.id
                    ORDER BY b.name
                    ";

            $resource = $this->query($SQL);
         
            $birds = array();
 
            while($bird = $this->fetchNextObject()) {
                    $birds[$bird->id] = 1;
            }

 
            if(count($birds_exclusive))
                $birds_exclusive = array_intersect_key($birds_exclusive,$birds);
            else
                $birds_exclusive = $birds;
        }
      

        $SQL = "SELECT b.*
                FROM bird AS b
                WHERE b.id
                IN ( ".implode(',',array_keys($birds_exclusive))." )
                GROUP BY b.id";
 
        return $this->query($SQL);
    }

    public function findAllByTaxonomyIdsInclusive($ids) {

        $SQL = "SELECT b.*
                FROM bird AS b
                INNER JOIN bird_taxonomy AS bt ON bt.bird_id = b.id
                INNER JOIN taxonomy AS t ON t.id = bt.taxonomy_id
                WHERE t.id
                IN ( ".implode(',',$ids)." )
                GROUP BY b.id
                ORDER BY b.name ASC
                ";

        return $this->query($SQL);
    }

    public function nullifyDrupalInfo($id) {
        $sql = "update bird set drupalinfo = NULL where id = $id";
        $this->execute($sql);
    }
}
