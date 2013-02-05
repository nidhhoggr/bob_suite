<?php

/**
 * BirdTaxonomySource form base class.
 *
 * @method BirdTaxonomySource getObject() Returns the current form's model object
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBirdTaxonomySourceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'bird_taxonomy_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BirdTaxonomy'), 'add_empty' => false)),
      'source_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Source'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'bird_taxonomy_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BirdTaxonomy'))),
      'source_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Source'))),
    ));

    $this->widgetSchema->setNameFormat('bird_taxonomy_source[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BirdTaxonomySource';
  }

}
