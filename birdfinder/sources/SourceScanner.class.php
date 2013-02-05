<?php
require_once(BF_LIB_DIR.'HTML-DOM-Parser/simple_html_dom.php');

class SourceScanner  {

    private $ids = array();

    private $tables = array('bird','bird_source','bird_taxonomy','source','taxonomy','taxonomytype','taxonomytype_source','taxonomy_source');

    private $isVerbose = false; 
    private $doSave = false;

    public function __construct($args) {

        extract($args);

        if(isset($s))
            $this->doSave = true;

        if(isset($v))
            $this->isVerbose = true;

        if(isset($t))
            $this->_truncateTables();

        //declare the dom parser
        $this->hdp = new simple_html_dom();

        if(isset($s) || isset($v)) {

            $this->getSources();
   
            $this->_getUniqueIds();
        }
    }   

    private function _truncateTables() {
        global $SourceModel;

        foreach($this->tables as $table) { 
            $SourceModel->truncateTable($table);
        }
    }


    /**
        return a boolean value indicating the address is a file or directory
    */
    private function _dirIsValid($dir) {
        return ($dir != ".." && $dir != ".");
    }

    /**
        loop trhough the root of sources and get each source

    */
    public function getSources() {

        foreach(scandir(BF_SOURCE_DIR) as $sd) {
       
            $this->current_source =  $sd;

            //first check if its a valid direcotry and if its not in the list of exceptions
            if($this->_dirIsValid($sd) && $this->_getExceptions()!="*") {

                if($this->isVerbose)
                    echo "Source: $sd\n";

                if($this->doSave) $this->_saveSource();

                $this->getTaxonomyTypes();
            }
        }
    }

 
        /**
            save the source and set the source id instance variable
        */
        private function _saveSource() {
            global $SourceModel;

            $SourceModel->name = $this->current_source;
            $this->source_id = $SourceModel->save();
        }

    public function getTaxonomyTypes() {

        if($this->isVerbose)
            echo "Taxonomy Types: \n";

        foreach(scandir(BF_SOURCE_DIR.$this->current_source) as $tt) {
 
            $this->current_taxonomytype = $tt;
              
            $exceptions = $this->_getExceptions();

            if($this->_dirIsValid($tt) && !in_array($tt,$exceptions['taxonomytypes'])) {
 
                if($this->isVerbose)
                    echo "\t* $tt\n";          

                if($this->doSave) 
                    $this->_saveTaxonomyType();
     
                $this->getTaxonomies();
            }
        }
    }

        private function _saveTaxonomyType() {

            global $TaxonomyTypeModel, $TaxonomyTypeSourceModel;

            //save the taxonomy type
            $TaxonomyTypeModel->name = $this->current_taxonomytype;
            $this->taxonomytype_id = $TaxonomyTypeModel->save(); //set the taxtypeid 

            //save the taxonomytype to its source m2m reference
            $TaxonomyTypeSourceModel->taxonomytype_id = $this->taxonomytype_id;
            $TaxonomyTypeSourceModel->source_id = $this->source_id;
            $TaxonomyTypeSourceModel->save();
        }

    public function getTaxonomies() {

        if($this->isVerbose)
            echo "\tTaxonomies: \n";

        $tax_dir = BF_SOURCE_DIR . $this->current_source . '/' . 
                   $this->current_taxonomytype;

        foreach(scandir($tax_dir) as $tax) {

            $this->current_taxonomy = $tax;

            if($this->_dirIsValid($tax)) {

                if($this->isVerbose)
                    echo "\t\t * $tax\n";

                if($this->doSave) $this->_saveTaxonomy();

                $this->getBirds();
            }
        }
    }

        private function _saveTaxonomy() { 
            global $TaxonomyModel, $TaxonomySourceModel;
   
            //save the taxonomy    
            $TaxonomyModel->name = $this->current_taxonomy;
            $TaxonomyModel->taxonomytype_id = $this->taxonomytype_id;
            $this->taxonomy_id = $TaxonomyModel->save();

            //save the taxonomy to its source m2m reference
            $TaxonomySourceModel->taxonomy_id = $this->taxonomy_id;
            $TaxonomySourceModel->source_id = $this->source_id;
            $TaxonomySourceModel->save();
        }

    //This bottom level of the hierarchy begins to get propietary to the source

    public function getBirds() {

        $bird_file = BF_SOURCE_DIR . $this->current_source . '/' .
                   $this->current_taxonomytype . '/' . $this->current_taxonomy
                   . '/index.html';
 
        //load the bird file into the html dom parser
        $this->hdp->load_file($bird_file);

        //get the dom selectors by the current source
        extract($this->_getDomSelectorBySource());
 
        if($this->isVerbose)
            var_dump(count($this->hdp->find($row)));

        foreach($this->hdp->find($row) as $bird_row) {

            $bird = array();

            if(isset($name)) {
                //get the birds name
                $birdname = $bird_row->find($name);
                $birdname = $birdname[0]->innertext;
            }
            else {
                $birdname =  $bird_row->innertext;
            }

            //get the birds proper name
            if(isset($proper_name)) {
                $bird_propername = $bird_row->find($proper_name); 
                if(!empty($bird_propername))
                    $bird_propername = $bird_propername[0]->innertext;
            }

            if(isset($link)) {
                //get the birds link
                $bird_link = $bird_row->find($link);
                $bird_link = $bird_link[0]->href;
            }
            else {
                $bird_link = $bird_row->href;
            }

            //get the birds id
            preg_match_all('/([\d]+)/', $bird_link, $bird_ids);           

            if(!empty($bird_ids[0][0])) {
                $bird_id = $bird_ids[0][0];           
             
                //store the birds id per source
                $this->ids[$this->current_source][] = $bird_id;

                switch($this->current_source) {
                    case "whatbird":
                        $bird_id += 300;
                    break;
                    case "rtr":
                        $bird_id += 1500;
                    break;
                }
            }
            else {
                
                $this->ids[$this->current_source][] = $birdname;
                $bird_id = null;
            }
            
            $bird = compact('birdname','bird_propername','bird_link','bird_id');

            if($this->isVerbose)  
                $this->_displayBirdInfo($bird);

            if($this->doSave) 
                $this->_saveBirdInfo($bird);

        }
    }

    private function _displayBirdInfo($bird) {

        $bird_propername = null;
        extract($bird);

        //echo "\t\t\tBird: $birdname\n";
        //echo "\t\t\t\tProper Name: $bird_propername\n"; 
        //echo "\t\t\t\tLink: $bird_link\n"; 
        echo "\t\t\tBird: $birdname($bird_propername) id:".$bird_id."\n";
        
    }

    private function _saveBirdInfo($bird) { 
        global $BirdModel, $BirdSourceModel, $BirdTaxonomyModel;

        extract($bird);

        if(!empty($bird_id)) {

            //only save the bird and m2m source reference if it doesnt exist yet
            if(!$BirdModel->findOne("id=$bird_id")) {

                //save the bird info
                $BirdModel->id = $bird_id;
                $BirdModel->name = $birdname;
            
                if(isset($bird_propername))
                    $BirdModel->propername = $bird_propername;
        
                $BirdModel->save();
 
                //save the bird to the source
                $BirdSourceModel->bird_id = $bird_id;
                $BirdSourceModel->source_id = $this->source_id;
                $BirdSourceModel->link = $bird_link;
        
                $BirdSourceModel->save();

            }
        }
        else {

            $BirdModel->name = $birdname;

            if(isset($bird_propername))
                $BirdModel->propername = $bird_propername;

            $bird_id = $BirdModel->save();

            //save the bird to the source
            $BirdSourceModel->bird_id = $bird_id;
            $BirdSourceModel->source_id = $this->source_id;
            $BirdSourceModel->link = $bird_link;

            $BirdSourceModel->save();
        }

        //save the bird to the taxonomy
        $BirdTaxonomyModel->bird_id = $bird_id;
        $BirdTaxonomyModel->taxonomy_id = $this->taxonomy_id;
        $birdtaxid = $BirdTaxonomyModel->save(); //get the birdtaxid
    }

    /**
        assign dom selectors for each source for scraping bird detials
    */
    private function _getDomSelectorBySource() {

        $dom_selectors = array();

	$dom_selectors['asu.edu'] = array(
            'row' => '.bird-search-result',
            'name' => 'h2 a', //innnertext
            'proper_name' =>'p.proper-name', //innertext
            'link' => 'h2 a' //href
        );

        $dom_selectors['whatbird'] = array(
            'row'=>'table#Table1',
            'name'=>'a.ObjectLink',
            'link'=>'a.ObjectLink'
        );

        $dom_selectors['allaboutbirds'] = array(
            'row'=>'.species_item',
            'name'=>'h2 a',
            'proper_name' =>'em', //innertext
            'link'=>'h2 a'
        );

        $dom_selectors['rtr'] = array(
            'row'=>'body a[href*=realtimerendering]'
        );

        return $dom_selectors[$this->current_source];
    }

    private function _getExceptions() {

        $exceptions = array(
            'asu.edu'=>'*',
            'whatbird'=>'*',
            'rtr'=>array('taxonomytypes'=>array()),
            'allaboutbirds'=>array('taxonomytypes'=>array())
        );

        return $exceptions[$this->current_source];
    }

    /**
  
        debug the list of unique ids for each source
    */
    private function _getUniqueIds() {
        foreach($this->ids as $source=>$ids) {
            var_dump($source,count(array_unique($ids)));
        }
    }

}
