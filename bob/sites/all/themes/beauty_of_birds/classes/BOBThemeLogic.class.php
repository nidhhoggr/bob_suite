<?php
class BOBThemeLogic {

    function getNodeTaxonomiesInfo($node) {

        foreach($node->taxonomy as $tax) {

          $term = taxonomy_get_term($tax->tid);

          $vocabulary = taxonomy_vocabulary_load($term->vid);
          
          $taxonomy_path = taxonomy_term_path($term);
          // finally, lookup the path alias using drupal_lookup_path()
          $taxonomy_path_alias = drupal_lookup_path('alias', $taxonomy_path);
        
          $taxonomies[] = array(
              'name'=>$tax->name,
              'vocab'=>$vocabulary->name,
              'link'=>$taxonomy_path_alias,
              'image'=>taxonomy_image_get_url($tax->tid)
          );
    
        } 

        return $taxonomies;
    }
    
}  
