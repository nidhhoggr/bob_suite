<?php

/**
 * BirdSource filter form base class.
 *
 * @package    projectname
 * @subpackage filter
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBirdSourceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'bird_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bird'), 'add_empty' => true)),
      'source_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => true)),
      'link'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'bird_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Bird'), 'column' => 'id')),
      'source_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Source'), 'column' => 'id')),
      'link'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bird_source_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BirdSource';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'bird_id'   => 'ForeignKey',
      'source_id' => 'ForeignKey',
      'link'      => 'Text',
    );
  }
}
