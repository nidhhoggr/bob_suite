<?php

/**
 * TaxonomytypeSource filter form base class.
 *
 * @package    projectname
 * @subpackage filter
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTaxonomytypeSourceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'taxonomytype_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Taxonomytype'), 'add_empty' => true)),
      'source_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'taxonomytype_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Taxonomytype'), 'column' => 'id')),
      'source_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Source'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('taxonomytype_source_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TaxonomytypeSource';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'taxonomytype_id' => 'ForeignKey',
      'source_id'       => 'ForeignKey',
    );
  }
}
