<?php

/**
 * BirdSource form base class.
 *
 * @method BirdSource getObject() Returns the current form's model object
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBirdSourceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'bird_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bird'), 'add_empty' => false)),
      'source_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => false)),
      'link'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'bird_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bird'))),
      'source_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Source'))),
      'link'      => new sfValidatorString(array('max_length' => 256, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bird_source[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BirdSource';
  }

}
