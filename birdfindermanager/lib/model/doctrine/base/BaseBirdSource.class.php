<?php

/**
 * BaseBirdSource
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $bird_id
 * @property integer $source_id
 * @property string $link
 * @property Bird $Bird
 * @property Source $Source
 * 
 * @method integer    getId()        Returns the current record's "id" value
 * @method integer    getBirdId()    Returns the current record's "bird_id" value
 * @method integer    getSourceId()  Returns the current record's "source_id" value
 * @method string     getLink()      Returns the current record's "link" value
 * @method Bird       getBird()      Returns the current record's "Bird" value
 * @method Source     getSource()    Returns the current record's "Source" value
 * @method BirdSource setId()        Sets the current record's "id" value
 * @method BirdSource setBirdId()    Sets the current record's "bird_id" value
 * @method BirdSource setSourceId()  Sets the current record's "source_id" value
 * @method BirdSource setLink()      Sets the current record's "link" value
 * @method BirdSource setBird()      Sets the current record's "Bird" value
 * @method BirdSource setSource()    Sets the current record's "Source" value
 * 
 * @package    projectname
 * @subpackage model
 * @author     Joseph Persie
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseBirdSource extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bird_source');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('bird_id', 'integer', 8, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('source_id', 'integer', 8, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('link', 'string', 256, array(
             'type' => 'string',
             'length' => 256,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Bird', array(
             'local' => 'bird_id',
             'foreign' => 'id'));

        $this->hasOne('Source', array(
             'local' => 'source_id',
             'foreign' => 'id'));
    }
}