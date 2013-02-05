<?php

/**
 * TaxonomytypeSource form base class.
 *
 * @method TaxonomytypeSource getObject() Returns the current form's model object
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTaxonomytypeSourceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'taxonomytype_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Taxonomytype'), 'add_empty' => false)),
      'source_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'taxonomytype_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Taxonomytype'))),
      'source_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Source'))),
    ));

    $this->widgetSchema->setNameFormat('taxonomytype_source[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TaxonomytypeSource';
  }

}
