<?php

class DrupalURLAliases { 

    public function __construct(DrupalModel $model) {
        $this->model = $model;
        $this->model->setTable('bob_url_alias');
        $this->url_aliases = $this->getAliases();
    }

    public function getAliases() {

        $aliases['order'] = $this->_getOrderAliases();
        $aliases['species'] = $this->_getSpeciesAliases();

        return $aliases;
    }


    public function flushAliases() {
        
        $aliases = array_merge(
            $this->url_aliases['order'], 
            $this->url_aliases['species']
        );
        
        $this->model->setTable('bob_url_alias');
        
        foreach($aliases as $alias) {
           
            $condition = "src = '".trim($alias['src'])."' OR src = '".trim($alias['node'])."'";
 
            $this->model->cleanUrlAliases($condition);
        }
    }

    public function generateAliases() {

        $aliases = array_merge(
            $this->url_aliases['order'], 
            $this->url_aliases['species']
        );

        $this->model->setTable('bob_url_alias');

        foreach($aliases as $alias) {
   
            extract($alias);

            $this->model->src = trim($src);
            $this->model->dst = trim($dst);
            $this->model->save();
 
            $this->model->src = trim($node);
            $this->model->dst = trim($node);
            $this->model->save();
        }
    }

    private function _getOrderAliases() {
        global $Utility, $TaxonomyModel;

        mysql_select_db(DBNAME);

        $orders = $TaxonomyModel->findBy(array(
            'conditions'=>array(
                'taxonomytype_id = 36'
            ),
            'fetchArray'=>true
        ));

        mysql_select_db(DBNAME_DRUPAL);

        foreach($orders as $order) {
            $ordername = $Utility->dehumanizeString($order['name']) . "\n";
            $drupalinfo = $Utility->dbGetArray($order['drupalinfo']);

            $alias[] = array(
                'src'=>'taxonomy/term/'.$drupalinfo['tid'],
                'dst'=>'bird-order/'.$ordername,
                'node'=>'node/'.$drupalinfo['nid']
            );
        }

        return $alias;
    }

    private function _getSpeciesAliases() {
        global $Utility, $BirdModel;

        mysql_select_db(DBNAME);

        $birds = $BirdModel->findBy(array(
            'conditions'=>array(
                'paraphrased'=>1
            ),
            'fetchArray'=>true
        ));

        mysql_select_db(DBNAME_DRUPAL);

        foreach($birds as $bird) {
            $birdname = $Utility->dehumanizeString($bird['name']) . "\n";
            $drupalinfo = $Utility->dbGetArray($bird['drupalinfo']);

            $alias[] = array(
                'src'=>'taxonomy/term/'.$drupalinfo['tid'],
                'dst'=>'bird-species/'.$birdname,
                'node'=>'node/'.$drupalinfo['nid']
            );
        }

        return $alias;
    }

}
