<?php

require_once(dirname(__FILE__) . '/../config/bootstrap.php');

function mergeBirds($birds) {
    global $BirdModel, $BirdSourceModel, $BirdTaxonomyModel;

    foreach($birds as $bird=>$ids) {

        //create the merged bird
        $BirdModel->name = $bird;
        $BirdModel->propername = $BirdModel->getPropername(mysql_escape_string($bird));
        $newbirdid = $BirdModel->save();        

        //create the merged source
        $BirdSourceModel->bird_id = $newbirdid;
        $BirdSourceModel->source_id = 5;
        $BirdSourceModel->save();

        $result = $BirdTaxonomyModel->fetchWhereIn('bt.bird_id',$ids);

        while($row = mysql_fetch_object($result)) {

            //update the bird taxonomy reference
            $BirdTaxonomyModel->id = $row->id;
            $BirdTaxonomyModel->bird_id = $newbirdid;
            $birdtaxid = $BirdTaxonomyModel->save();

            echo "Updated $birdtaxid\n";
        }
    }

    foreach($birds as $bird=>$ids) {

            $SQL = "SET FOREIGN_KEY_CHECKS = 0;";
            $BirdModel->execute($SQL);

            $SQL = "DELETE FROM bird_source WHERE bird_id IN(".implode(",",$ids).")";
            $BirdModel->execute($SQL);

            $SQL = "DELETE FROM bird WHERE id IN(".implode(",",$ids).")";
            $BirdModel->execute($SQL);
    }
}

function mergeTaxonomies($mergings) {
    global $TaxonomyModel, $TaxonomySourceModel, $BirdTaxonomyModel;

    foreach($mergings as $tt_id=>$taxonomies) {
  
        foreach($taxonomies as $taxname=>$taxids) {

                //create the new merged taxonomy
                $TaxonomyModel->taxonomytype_id = $tt_id;
                $TaxonomyModel->name = $taxname;
                $newtaxid = $TaxonomyModel->save();

                //save the taxsource reference as merged 
                $TaxonomySourceModel->taxonomy_id = $newtaxid;
                $TaxonomySourceModel->source_id = 5;
                $TaxonomySourceModel->save();

                $result = $BirdTaxonomyModel->fetchWhereIn('t.id',$taxids);

                while($row = mysql_fetch_object($result)) {

                    $BirdTaxonomyModel->id = $row->id;
                    $BirdTaxonomyModel->taxonomy_id = $newtaxid;
                    $birdtaxid = $BirdTaxonomyModel->save();

                    echo "Updated $birdtaxid\n";
                }
   
        }

    }

    //delete all of the mereged taxonomies
    foreach($mergings as $taxonomies) {

        foreach($taxonomies as $taxname=>$taxids) {

            $SQL = "DELETE FROM taxonomy_source WHERE taxonomy_id IN(".implode(",",$taxids).")";
            $TaxonomyModel->execute($SQL);

            $SQL = "DELETE FROM taxonomy WHERE id IN(".implode(",",$taxids).")";
            $TaxonomyModel->execute($SQL);
        }
    }

}
