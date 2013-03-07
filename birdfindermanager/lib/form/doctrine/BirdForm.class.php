<?php

/**
 * Bird form.
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BirdForm extends BaseBirdForm
{
  public function configure()
  {
      $this->widgetSchema['wikipedia'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['drupalinfo'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['imageurl'] = new sfWidgetFormTextarea(array(), array('class' => 'no-editor'));
      $this->widgetSchema['about'] = new sfWidgetFormTextarea(array(), array());
      $this->widgetSchema['paraphrased'] = new sfWidgetFormInputCheckbox(array('label'=>"Check this box when done paraphrasing"));
  }
}
