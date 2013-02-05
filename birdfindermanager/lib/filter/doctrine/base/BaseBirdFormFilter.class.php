<?php

/**
 * Bird filter form base class.
 *
 * @package    projectname
 * @subpackage filter
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBirdFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(),
      'propername'  => new sfWidgetFormFilterInput(),
      'imageurl'    => new sfWidgetFormFilterInput(),
      'wikipedia'   => new sfWidgetFormFilterInput(),
      'about'       => new sfWidgetFormFilterInput(),
      'paraphrased' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'propername'  => new sfValidatorPass(array('required' => false)),
      'imageurl'    => new sfValidatorPass(array('required' => false)),
      'wikipedia'   => new sfValidatorPass(array('required' => false)),
      'about'       => new sfValidatorPass(array('required' => false)),
      'paraphrased' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('bird_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bird';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'propername'  => 'Text',
      'imageurl'    => 'Text',
      'wikipedia'   => 'Text',
      'about'       => 'Text',
      'paraphrased' => 'Boolean',
    );
  }
}
