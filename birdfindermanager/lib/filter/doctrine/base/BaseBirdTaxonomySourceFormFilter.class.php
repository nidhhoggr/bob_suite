<?php

/**
 * BirdTaxonomySource filter form base class.
 *
 * @package    projectname
 * @subpackage filter
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBirdTaxonomySourceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'bird_taxonomy_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BirdTaxonomy'), 'add_empty' => true)),
      'source_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'bird_taxonomy_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('BirdTaxonomy'), 'column' => 'id')),
      'source_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Source'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('bird_taxonomy_source_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BirdTaxonomySource';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'bird_taxonomy_id' => 'ForeignKey',
      'source_id'        => 'ForeignKey',
    );
  }
}
