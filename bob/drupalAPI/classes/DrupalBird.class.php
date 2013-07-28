<?php

class BaseDrupalBird {

    //load the administrator session
    public function loginAdmin() {
        global $user;
        $user = user_load(1);
    }

    public function createNodeAndTax($nodeinfo,$vid) {

        $this->loginAdmin();

        extract($nodeinfo);

    
        //build data for the taxonomy term
        $term = array(
            'vid' => $vid, // Voacabulary ID
            'name' => $taxonomy['name'], // Term Name 
            'description' => $taxonomy['description'],
            'relations'=>$taxonomy['relations']
        );

        //save the taxonomy term
        taxonomy_save_term($term);

        //create the image for the taxonomy term
        taxonomy_image_add_from_url($term['tid'],$image['url'],$image['name']);

        //build the object for the trait node
        $node = new stdClass();
        $node->title = $title;
        $node->body = $body;
        $node->type = "trait";
        $node->status = 1;
        $node->created = time();
        $node->taxonomy = array(taxonomy_get_term($term['tid']));

        //save the node
        if ($node = node_submit($node)) {
            node_save($node);
        }

        return $node;
    }

    public function updateNodeAndTax($nodeinfo) {

        $this->loginAdmin();

        extract($nodeinfo);

        $node = node_load($nid);

        foreach($nodeinfo as $k=>$v) {
            if($k!="nid" && $k!="taxonomy" && !is_array($v))
                $node->$k = $v;
        }

        node_save($node);

        if(is_array($taxonomy)) {

            $tid = key($node->taxonomy);

            $update_tax = array_merge($taxonomy,compact('tid'));

            if(count($image)) { 
                //update the image
                taxonomy_image_add_from_url($tid,$image['url'],$image['name']);
            }  
 
            taxonomy_save_term($update_tax);
        }

        return $node;
    }

    public function deleteNodeAndTax($nid) {
 
        $this->loginAdmin();
        $node = node_load($nid);

        if($node) {
            $tid = key($node->taxonomy);

            if($tid) {
                $this->cleanTaxAndNode(" = $tid");
            }
            else {
                $this->cleanNode(" = $nid");
            }
        }
    }

    public function cleanTaxAndNode($condition) {
        global $BirdModel;
        
        mysql_select_db(DBNAME_DRUPAL);

        $sql = "
        DELETE td.*, th.*, ti.*, tn.*, n.*, ncs.*, nc.*, nr.*
        FROM bob_term_data td
        LEFT JOIN bob_term_hierarchy th ON td.tid = th.tid
        LEFT JOIN bob_term_image ti ON td.tid = ti.tid
        LEFT JOIN bob_term_node tn ON td.tid = tn.tid
        LEFT JOIN bob_node n ON tn.nid = n.nid
        LEFT JOIN bob_node_comment_statistics ncs ON tn.nid = ncs.nid
        LEFT JOIN bob_node_counter nc ON tn.nid = nc.nid
        LEFT JOIN bob_node_revisions nr ON tn.nid = nr.nid
        WHERE td.tid $condition";

        $BirdModel->execute($sql);

        mysql_select_db(DBNAME);
    }

    public function cleanNode($condition) {
        global $BirdModel;

        mysql_select_db(DBNAME_DRUPAL);

        $sql = "
        DELETE n.*, ncs.*, nc.*, nr.*
        FROM bob_node n
        LEFT JOIN bob_node_comment_statistics ncs ON n.nid = ncs.nid
        LEFT JOIN bob_node_counter nc ON n.nid = nc.nid
        LEFT JOIN bob_node_revisions nr ON n.nid = nr.nid
        WHERE n.nid $condition";

        $BirdModel->execute($sql);

        mysql_select_db(DBNAME);
    }

    public function cleanTax($condition) {
        global $BirdModel;


        mysql_select_db(DBNAME_DRUPAL);

        $sql = "
        DELETE
        td.*, th.*, ti.*, tn.*
        FROM bob_term_data td
        LEFT JOIN bob_term_hierarchy th ON td.tid = th.tid
        LEFT JOIN bob_term_image ti ON td.tid = ti.tid
        LEFT JOIN bob_term_node tn ON td.tid = tn.tid
        WHERE td.tid $condition
        ";

        $BirdModel->execute($sql);
        mysql_select_db(DBNAME);
    }

    public function cleanUrlAliases($condition) {
        global $BirdModel;

        mysql_select_db(DBNAME_DRUPAL);

        $sql = "DELETE FROM bob_url_alias WHERE $condition";

        $BirdModel->execute($sql);
        mysql_select_db(DBNAME);
    }
}

class DrupalBirdSpecies extends BaseDrupalBird {

    public function createBirdSpecies($speciesinfo) {

        return $this->createNodeAndTax($speciesinfo,BIRD_SPECIES_VOCAB_ID);
    }

    public function deleteBirdSpecies($nid) {

        $this->deleteNodeAndTax($nid);
    }

    public function deleteBirdSpeciesUrlAlias($drupalinfo) {
        extract($drupalinfo);
        $this->cleanUrlAliases("src = 'taxonomy/term/".$tid."' OR src = 'node/".$nid."'");
    } 

    public function updateBirdSpecies($speciesinfo) {  

        return $this->updateNodeAndTax($speciesinfo);
    }
}

class DrupalBirdOrder extends BaseDrupalBird {

    public function createBirdOrder($orderinfo) {

        return $this->createNodeAndTax($orderinfo,BIRD_ORDER_VOCAB_ID);
    }

    public function deleteBirdOrder($nid) {

        $this->deleteNodeAndTax($nid);
    }

    public function deleteBirdOrderUrlAlias($drupalinfo) {
        extract($drupalinfo);
        $this->cleanUrlAliases("src = 'taxonomy/term/".$tid."' OR src = 'node/".$nid."'");
    } 


    public function updateBirdOrder($orderinfo) {

        return $this->updateNodeAndTax($orderinfo);
    }
}

