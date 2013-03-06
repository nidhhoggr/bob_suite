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

        $term = array(
            'vid' => $vid, // Voacabulary ID
            'name' => $taxonomy['name'], // Term Name 
            'description' => $taxonomy['description']
        );

        //create the node
        taxonomy_save_term($term);

        //create the image
        taxonomy_image_add_from_url($term['tid'],$image['url'],$image['name']);

        //save the trait information as a node
        $node = new stdClass();
        $node->title = $title;
        $node->body = $body;
        $node->type = "trait";
        $node->status = 1;
        $node->created = time();
        $node->taxonomy = array(taxonomy_get_term($term['tid']));

        if ($node = node_submit($node)) {
            node_save($node);
        }

        return $node;
    }

    public function deleteNodeAndTax($nid) {
        $this->loginAdmin();
        $node = node_load($nid);
        $tid = key($node->taxonomy);
        taxonomy_del_term($tid);
        node_delete($nid);
    }

    public function updateNodeAndTax($nodeinfo) {
        extract($nodeinfo);

        $node = node_load($nid);

        foreach($speciesinfo as $k=>$v) {
            if($k!="nid" && $k!="taxonomy" && !is_array($v))
                $node->$k = $v;
        }

        node_save($node);

        if(is_array($taxonomy)) {

            $tid = key($node->taxonomy);

            $update_tax = array_merge($taxonomy,compact('tid'));

            taxonomy_save_term($update_tax);
        }

        return $node;
    }


}

class DrupalBirdSpecies extends BaseDrupalBird {

    public function createBirdSpecies($speciesinfo) {

        return $this->createNodeAndTax($speciesinfo,BIRD_SPECIES_VOCAB_ID);
    }

    public function deleteBirdSpecies($nid) {

        $this->deleteNodeAndTax($nid);
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

    public function updateBirdOrder($orderinfo) {

        return $this->updateNodeAndTax($orderinfo);
    }
}

