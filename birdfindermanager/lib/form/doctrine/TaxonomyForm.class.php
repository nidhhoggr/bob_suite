<?php

/**
 * Taxonomy form.
 *
 * @package    projectname
 * @subpackage form
 * @author     Joseph Persie
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TaxonomyForm extends BaseTaxonomyForm
{
  public function configure()
  {
      $this->widgetSchema['drupalinfo'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['imageurl'] = new sfWidgetFormTextarea(array(), array('class' => 'no-editor'));
      $this->widgetSchema['about'] = new sfWidgetFormTextarea(array(), array());
  }
}
