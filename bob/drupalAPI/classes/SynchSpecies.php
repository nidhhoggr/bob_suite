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

    $BirdModel->nullifyDrupalInfo($id);
  }

  public function saveBird($bird) {
    global $Utility, $BirdModel;

    extract($bird);

    $name = str_replace("'", '', $name);

    $drupalinfo = $Utility->dbGetArray($drupalinfo);
 
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

    $BirdModel->id = $id;
    $BirdModel->drupalinfo = $Utility->dbPutArray(compact('nid','tid')); 
    $BirdModel->save();
  }

  public function getBirdTagContent($bird) {
    global $BirdController;

    return $BirdController->displayAssociatedTags($bird['id']);
  }

  public function getSpeciesParent($bird_id) {
    global $BirdTaxonomyModel, $Utility;

    $BirdTaxonomyModel->findByTaxTypeAndBird(36,$bird_id);

    while($order = $BirdTaxonomyModel->fetchNextObject()){ 
        $drupalinfo = $Utility->dbGetArray($order->drupalinfo);      
    }
    
    return $drupalinfo['tid'];
  }
}
