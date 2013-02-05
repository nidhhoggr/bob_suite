<?php

/**
 * BirdTaxonomy filter form base class.
 *
 * @package    projectname
 * @subpackage filter
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBirdTaxonomyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'bird_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bird'), 'add_empty' => true)),
      'taxonomy_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Taxonomy'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'bird_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bird'), 'column' => 'id')),
      'taxonomy_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Taxonomy'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('bird_taxonomy_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BirdTaxonomy';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'bird_id'     => 'ForeignKey',
      'taxonomy_id' => 'ForeignKey',
    );
  }
}
