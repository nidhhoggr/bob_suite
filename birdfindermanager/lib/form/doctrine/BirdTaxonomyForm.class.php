<?php

/**
 * BirdTaxonomy form.
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BirdTaxonomyForm extends BaseBirdTaxonomyForm
{
  public function configure()
  {

    $this->setWidget('bird_id',new sfWidgetFormDoctrineChoice(
        array(
              'model' => $this->getRelatedModelName('Bird'),
              'order_by'=>array('name','asc'),
              'add_empty' => false)
             )
    );
    
    $this->setWidget('taxonomytype_id',new sfWidgetFormDoctrineChoice(
        array(
              'model' => 'TaxonomyType',
              'order_by'=>array('name','asc'),
              'add_empty' => true)
             )
    );
     
    $this->setWidget('taxonomy_id', new sfWidgetFormDoctrineChoice(
        array(
              'model'=>'Taxonomy',
              'add_empty' => true)
        )
    );
  }

}
