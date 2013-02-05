<?php
class Doctrine_Template_Listener_Auditable extends Doctrine_Record_Listener
{
    /**
     * Array of userid options
     *
     * @var string
     */
    protected $_options = array();
 
    /**
     * __construct
     *
     * @param string $options.
     * @return void
     */
    public function __construct(array $options)
    {
        $this->_options = $options;
    }
 
    /**
     * preInsert
     *
     * @param Doctrine_Event $event.
     * @return void
     */
    public function preInsert(Doctrine_Event $event)
    {
        if(!$this->_options['creater']['disabled']) {
            $createrName = $this->_options['creater']['name'];
            $event->getInvoker()->$createrName = $this->getUserId($event);
        }
 
        if(!$this->_options['updater']['disabled'] && $this->_options['updater']['onInsert']) {
            $updaterName = $this->_options['updater']['name'];
            $event->getInvoker()->$updaterName = $this->getUserId($event);
        }
 
        if ( ! $this->_options['created']['disabled']) {
            $createdName = $event->getInvoker()->getTable()->getFieldName($this->_options['created']['name']);
            $modified = $event->getInvoker()->getModified();
            if ( ! isset($modified[$createdName])) {
                $event->getInvoker()->$createdName = $this->getTimestamp('created', $event->getInvoker()->getTable()->getConnection());
            }
        }
 
        if ( ! $this->_options['updated']['disabled'] && $this->_options['updated']['onInsert']) {
            $updatedName = $event->getInvoker()->getTable()->getFieldName($this->_options['updated']['name']);
            $modified = $event->getInvoker()->getModified();
            if ( ! isset($modified[$updatedName])) {
                $event->getInvoker()->$updatedName = $this->getTimestamp('updated', $event->getInvoker()->getTable()->getConnection());
            }
        }
    }
 
    /**
     * preUpdate
     *
     * @param Doctrine_Event $event.
     * @return void
     */
    public function preUpdate(Doctrine_Event $event)
    {
        if( ! $this->_options['updater']['disabled']) {
            $updaterName = $this->_options['updater']['name'];
            $event->getInvoker()->$updaterName = $this->getUserId($event);
        }
 
        if ( ! $this->_options['updated']['disabled']) {
            $updatedName = $event->getInvoker()->getTable()->getFieldName($this->_options['updated']['name']);
            $modified = $event->getInvoker()->getModified();
            if ( ! isset($modified[$updatedName])) {
                $event->getInvoker()->$updatedName = $this->getTimestamp('updated', $event->getInvoker()->getTable()->getConnection());
            }
        }
    }
 
    /**
     * getUserId
     *
     * Gets the userid
     *
     * @param Doctrine_Event $event.
     * @return int
     */
    public function getUserId(Doctrine_Event $event)
    {
      if (!$event->getInvoker()->getSystemUser())
      {
        throw new LogicException('The user must be set before saving');
      }
      return $event->getInvoker()->getSystemUser();
    }
 
    /**
     * Set the updated field for dql update queries
     *
     * @param Doctrine_Event $event
     * @return void
     */
    public function preDqlUpdate(Doctrine_Event $event)
    {
        if ( ! $this->_options['updated']['disabled']) {
            $params = $event->getParams();
            $updatedName = $event->getInvoker()->getTable()->getFieldName($this->_options['updated']['name']);
            $field = $params['alias'] . '.' . $updatedName;
            $query = $event->getQuery();
 
            if ( ! $query->contains($field)) {
                $query->set($field, '?', $this->getTimestamp('updated', $event->getInvoker()->getTable()->getConnection()));
            }
        }
    }
 
    /**
     * Gets the timestamp in the correct format based on the way the behavior is configured
     *
     * @param string $type
     * @return void
     */
    public function getTimestamp($type, $conn = null)
    {
        $options = $this->_options[$type];
 
        if ($options['expression'] !== false && is_string($options['expression'])) {
            return new Doctrine_Expression($options['expression'], $conn);
        } else {
            if ($options['type'] == 'date') {
                return date($options['format'], time());
            } else if ($options['type'] == 'timestamp') {
                return date($options['format'], time());
            } else {
                return time();
            }
        }
    }
}
