<?php

/**
 * Taxonomy form base class.
 *
 * @method Taxonomy getObject() Returns the current form's model object
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTaxonomyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'taxonomytype_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Taxonomytype'), 'add_empty' => false)),
      'name'            => new sfWidgetFormInputText(),
      'imageurl'        => new sfWidgetFormTextarea(),
      'about'           => new sfWidgetFormInputText(),
      'drupalinfo'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'taxonomytype_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Taxonomytype'))),
      'name'            => new sfValidatorString(array('max_length' => 72, 'required' => false)),
      'imageurl'        => new sfValidatorString(array('max_length' => 256, 'required' => false)),
      'about'           => new sfValidatorPass(array('required' => false)),
      'drupalinfo'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('taxonomy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Taxonomy';
  }

}
