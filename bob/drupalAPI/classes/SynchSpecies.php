<?php
class SynchSpecies {

  private $debugMode = false;

  public function __construct() {

      $this->dps = new DrupalBirdSpecies();
  }

  public function setDebugMode($mode) {

      $this->debugMode = $mode;
  }

  public function deleteBird($bird) {
    global $Utility, $BirdModel;

    extract($bird);

    $drupalinfo = $Utility->dbGetArray($drupalinfo);

    echo "deleting " . $bird['name'] . ": " . $drupalinfo['nid'] . "\r\n";
 
    $this->dps->deleteBirdSpecies($drupalinfo['nid']);

    mysql_select_db(DBNAME);
    $BirdModel->nullifyDrupalInfo($id);
    mysql_select_db(DBNAME_DRUPAL);
  }

  public function createBird($bird) {
      return $this->saveBird($bird,true);
  }

  public function saveBird($bird,$createOnly=false) {
    global $Utility, $BirdModel;

    extract($bird);

    $name = str_replace("'", '', $name);

    $drupalinfo = $Utility->dbGetArray($drupalinfo);

    if(!empty($drupalinfo['nid']) && $createOnly) return;

    $tagContent = $this->getBirdTagContent($bird);

    $speciesinfo = array(
        'nid'=>$drupalinfo['nid'],
        'body'=>$tagContent,
        'title'=>$name,
        'taxonomy'=>array(
            'name'=>str_replace("'", '', $name),
            'description'=>$about,
            'parent'=>$this->getSpeciesParent($id)
        )
    );
  
    if($this->debugMode) { 
        print_r($speciesinfo);
        die();
    }

    if(empty($drupalinfo['nid'])) {

        $speciesinfo['image'] = array(
            'url'=>$imageurl,
            'name'=>'sync_' . $Utility->dehumanizeString($name) . '.jpg'
        );
 
        $node = $this->dps->createBirdSpecies($speciesinfo);
        echo "creating $name \r\n";
    }
    else {

        $node = $this->dps->updateBirdSpecies($speciesinfo);
        echo "updating $name \r\n";
    }
    
    $nid = $node->nid;
    $tid = key($node->taxonomy);

    mysql_select_db(DBNAME);

    $BirdModel->id = $id;
    $BirdModel->drupalinfo = $Utility->dbPutArray(compact('nid','tid')); 
    $BirdModel->save();
    mysql_select_db(DBNAME_DRUPAL);
  }

  public function getBirdTagContent($bird) {
    global $BirdController;

    mysql_select_db(DBNAME);
    $tags = $BirdController->displayAssociatedTags($bird['id']);
    mysql_select_db(DBNAME_DRUPAL);
    return $tags;
  }

  public function getSpeciesParent($bird_id) {
    global $BirdTaxonomyModel, $Utility;

    mysql_select_db(DBNAME);
    $BirdTaxonomyModel->findByTaxTypeAndBird(36,$bird_id);

    while($order = $BirdTaxonomyModel->fetchNextObject()){ 
        $drupalinfo = $Utility->dbGetArray($order->drupalinfo);      
    }
    
    return $drupalinfo['tid'];
    mysql_select_db(DBNAME_DRUPAL);
  }
}
