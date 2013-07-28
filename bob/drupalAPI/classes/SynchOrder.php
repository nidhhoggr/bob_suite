<?php
class SynchOrder {

  public $saveRelationsToggled = false;

  public function __construct() {

      $this->dpo = new DrupalBirdOrder();
  }

  public function displayOrder($orders) {
      global $Utility;
      extract($t);
      echo $name . "\r\n";
      $drupalinfo = $Utility->dbGetArray($drupalinfo);
      extract($drupalinfo);
      echo "\tnid:$nid \r\n";
      echo "\ttid:$tid \r\n";
  }

  public function deleteOrder($order) {
    global $Utility, $TaxonomyModel;

    extract($order);
    $drupalinfo = $Utility->dbGetArray($drupalinfo);
    echo "deleting " . $order['name'] . ": " . $drupalinfo['nid'] . "\r\n";
    $this->dpo->deleteBirdOrder($drupalinfo['nid']);
    $this->dpo->deleteBirdOrderUrlAlias($drupalinfo);

    mysql_select_db(DBNAME);
    $TaxonomyModel->nullifyDrupalInfo($id);
    mysql_select_db(DBNAME_DRUPAL);
  }

  public function detailOrder($order) {

      var_dump($order);
      
  }

  function saveOrder($order) {
    global $Utility, $TaxonomyModel;

    extract($order);

    $name = $Utility->humanizeString($name);

    $name = str_replace("'", '', $name);

    $drupalinfo = $Utility->dbGetArray($drupalinfo);
 
    $childSpecies = $this->getChildSpecies($order);

    $orderinfo = array(
        'nid'=>$drupalinfo['nid'],
        'body'=>$childSpecies,
        'title'=>$name,
        'taxonomy'=>array(
            'name'=>$name,
            'description'=>$about,
        )
    );

    if($this->saveRelationsToggled)
        $orderinfo['taxonomy']['relations'] = $this->childids;

    if(empty($drupalinfo['nid'])) {

        $orderinfo['image'] = array(
            'url'=>$imageurl,
            'name'=>'sync_' . $Utility->dehumanizeString($name) . '.jpg'
        );

        $node = $this->dpo->createBirdOrder($orderinfo);
        echo "creating $name \r\n";
    }
    else {
        $node = $this->dpo->updateBirdOrder($orderinfo);
        echo "updating $name \r\n";
    }
    
    $nid = $node->nid;
    $tid = key($node->taxonomy);

    mysql_select_db(DBNAME);
    $TaxonomyModel->id = $id;
    $TaxonomyModel->drupalinfo = $Utility->dbPutArray(compact('nid','tid')); 
    $TaxonomyModel->save();
    mysql_select_db(DBNAME_DRUPAL);
  }

  private function getChildSpecies($order) {

      global $BirdModel, $Utility;
      
      $links = null;

      mysql_select_db(DBNAME);

      $BirdModel->findAllByTaxonomyIdsInclusive(array($order['id']));

      $this->childids = array();

      while($bird = $BirdModel->fetchNextObject()) { 

          $urlname = $Utility->dehumanizeString($bird->name);

          $route = bird_drupal_url . "bird-species/".$urlname;
     
          $link = '<a href="'.$route.'">'.$bird->name.'</a>';
 
          $links .= '<li>'.$link.'</li>';


          if($this->saveRelationsToggled) { 
              $di = $Utility->dbGetArray($bird->drupalinfo);
              $this->childids[] = $di['tid'];
          }
      }

      mysql_select_db(DBNAME_DRUPAL);

      return '<div class="child-species"><h3>Child Species</h3><ul>'.$links.'</ul></div>';
  }
}
