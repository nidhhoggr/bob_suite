<?php

/**
 * BirdTaxonomy filter form.
 *
 * @package    projectname
 * @subpackage filter
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BirdTaxonomyFormFilter extends BaseBirdTaxonomyFormFilter
{
  public function configure()
  {

    $this->setWidget(
      'bird_id',new sfWidgetFormDoctrineChoice(
          array(
              'model' => $this->getRelatedModelName('Bird'), 
              'order_by'=>array('name','asc'),
              'add_empty' => true
          )
      )
    );

    $this->setWidget(
      'taxonomytype_id', new sfWidgetFormDoctrineChoice(
          array(
              'model' => 'Taxonomytype',
              'order_by'=>array('name','asc'),
              'add_empty' => true
          )
      )
    );

    $this->setWidget(
      'taxonomy_id', new sfWidgetFormDoctrineChoice(
          array(
              'model' => $this->getRelatedModelName('Taxonomy'), 
              'order_by'=>array('name','asc'),
              'add_empty' => true
          )
      )
    );

  }

  public function addTaxonomytypeIdColumnQuery($query,$field,$value) {


      $rootAlias = $query->getRootAlias();

      $query->innerjoin($rootAlias . '.Taxonomy t, t.Taxonomytype tt')
           ->andWhere('tt.id = ?',$value);
  
      return $query; 
  }
}
