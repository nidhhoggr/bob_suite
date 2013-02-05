<?php
class TaxonomyTypeModel extends BaseModel {

    //SET THE TABLE OF THE MODEL AND THE IDENTIFIER
    protected function configure() {
        $this->setTable("taxonomytype");
    }

    public function findByBirdId($bird_id) {

        $sql = "SELECT tt . *
                FROM bird AS b
                LEFT JOIN bird_taxonomy AS bt ON bt.bird_id = b.id
                LEFT JOIN taxonomy AS t ON t.id = bt.taxonomy_id
                LEFT JOIN taxonomytype AS tt ON tt.id = t.taxonomytype_id
                WHERE bt.bird_id = $bird_id
                GROUP BY tt.id";

        $result = $this->query($sql);

        return $result;
    }

}
