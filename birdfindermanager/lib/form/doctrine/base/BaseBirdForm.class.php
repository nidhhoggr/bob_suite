<?php

/**
 * Bird form base class.
 *
 * @method Bird getObject() Returns the current form's model object
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBirdForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'propername'  => new sfWidgetFormInputText(),
      'imageurl'    => new sfWidgetFormTextarea(),
      'wikipedia'   => new sfWidgetFormInputText(),
      'about'       => new sfWidgetFormInputText(),
      'paraphrased' => new sfWidgetFormInputCheckbox(),
      'drupalinfo'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 72, 'required' => false)),
      'propername'  => new sfValidatorString(array('max_length' => 72, 'required' => false)),
      'imageurl'    => new sfValidatorString(array('max_length' => 256, 'required' => false)),
      'wikipedia'   => new sfValidatorPass(array('required' => false)),
      'about'       => new sfValidatorPass(array('required' => false)),
      'paraphrased' => new sfValidatorBoolean(array('required' => false)),
      'drupalinfo'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bird[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bird';
  }

}
