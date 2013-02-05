<?php

/**
 * BirdTaxonomy form base class.
 *
 * @method BirdTaxonomy getObject() Returns the current form's model object
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBirdTaxonomyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'bird_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Bird'), 'add_empty' => false)),
      'taxonomy_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Taxonomy'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'bird_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Bird'))),
      'taxonomy_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Taxonomy'))),
    ));

    $this->widgetSchema->setNameFormat('bird_taxonomy[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BirdTaxonomy';
  }

}
