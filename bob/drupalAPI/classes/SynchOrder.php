<?php
class SynchOrder {

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
    $TaxonomyModel->nullifyDrupalInfo($id);
  }

  function saveOrder($order) {
    global $Utility, $TaxonomyModel;

    extract($order);

    $name = $Utility->humanizeString($name);

    $name = str_replace("'", '', $name);

    $drupalinfo = $Utility->dbGetArray($drupalinfo);
 
    $orderinfo = array(
        'nid'=>$drupalinfo['nid'],
        'body'=>null,
        'title'=>$name,
        'taxonomy'=>array(
            'name'=>$name,
            'description'=>$about,
        )
    );

    if(empty($drupalinfo['nid'])) {

        $orderinfo['image'] = array(
            'image'=>array(
                'url'=>$imageurl,
                'name'=>'sync_' . $Utility->dehumanizeString($name) . '.jpg'
            )
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

    $TaxonomyModel->id = $id;
    $TaxonomyModel->drupalinfo = $Utility->dbPutArray(compact('nid','tid')); 
    $TaxonomyModel->save();
  }
}
