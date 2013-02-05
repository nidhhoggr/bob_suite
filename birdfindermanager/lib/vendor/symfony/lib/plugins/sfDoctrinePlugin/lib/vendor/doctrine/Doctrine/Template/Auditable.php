<?php
class Doctrine_Template_Auditable extends Doctrine_Template
{
    /**
     * Array of userid options
     *
     * @var string
     */
    protected $_options = array(
        'creater' =>  array(
            'name'          => 'creater_id',
            'alias'         => null,
            'type'          => 'int',
            'disabled'      => false,
            'expression'    => false,
            'options'       =>  array('notnull' => true)
        ),
        'updater' =>  array(
            'name'          => 'updater_id',
            'alias'         => null,
            'type'          => 'int',
            'disabled'      => false,
            'expression'    => false,
            'onInsert'      => true,
            'options'       =>  array('notnull' => true)
        ),
        'created' =>  array(
            'name'          =>  'created_at',
            'alias'         =>  null,
            'type'          =>  'timestamp',
            'format'        =>  'Y-m-d H:i:s',
            'disabled'      =>  false,
            'expression'    =>  false,
            'options'       =>  array('notnull' => true)
        ),
        'updated' =>  array(
            'name'          =>  'updated_at',
            'alias'         =>  null,
            'type'          =>  'timestamp',
            'format'        =>  'Y-m-d H:i:s',
            'disabled'      =>  false,
            'expression'    =>  false,
            'onInsert'      =>  true,
            'options'       =>  array('notnull' => true)
        )
    );
 
 
    /**
     * setTableDefinition
     *
     * @return void
     */
    public function setTableDefinition()
    {
        if(!$this->_options['creater']['disabled']) {
            $name = $this->_options['creater']['name'];
            if ($this->_options['creater']['alias']) {
                $name .= ' as ' . $this->_options['creater']['alias'];
            }
            $this->hasColumn(
                $name,
                $this->_options['creater']['type'],
                null,
                $this->_options['creater']['options']
            );
        }
        if(!$this->_options['updater']['disabled']) {
            $name = $this->_options['updater']['name'];
            if ($this->_options['updater']['alias']) {
                $name .= ' as ' . $this->_options['updater']['alias'];
            }
            $this->hasColumn(
                $name,
                $this->_options['updater']['type'],
                null,
                $this->_options['updater']['options']
            );
        }
        if ( ! $this->_options['created']['disabled']) {
            $name = $this->_options['created']['name'];
            if ($this->_options['created']['alias']) {
                $name .= ' as ' . $this->_options['created']['alias'];
            }
            $this->hasColumn(
                $name,
                $this->_options['created']['type'],
                null,
                $this->_options['created']['options']
            );
        }
        if ( ! $this->_options['updated']['disabled']) {
            $name = $this->_options['updated']['name'];
            if ($this->_options['updated']['alias']) {
                $name .= ' as ' . $this->_options['updated']['alias'];
            }
            $this->hasColumn(
                $name,
                $this->_options['updated']['type'],
                null,
                $this->_options['updated']['options']);
        }
 
        $this->addListener(new Doctrine_Template_Listener_Auditable($this->_options));
    }
}
 
