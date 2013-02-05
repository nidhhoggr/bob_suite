<?php

require_once dirname(__FILE__).'/../lib/bird_taxonomyGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/bird_taxonomyGeneratorHelper.class.php';

/**
 * bird_taxonomy actions.
 *
 * @package    projectname
 * @subpackage bird_taxonomy
 * @author     Joseph Persie
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bird_taxonomyActions extends autoBird_taxonomyActions
{

    public function executeAjaxSelectTaxonomyType(sfWebRequest $request) {

        $tt_id = $request->getParameter('taxonomytype_id');

        $taxonomies = Doctrine_Core::getTable('Taxonomy')
            ->createQuery('t') 
            ->where("taxonomytype_id = $tt_id")
            ->orderBy('name ASC')
            ->execute()
            ->toArray();

        echo json_encode($taxonomies);
 
        die();
    }
}
