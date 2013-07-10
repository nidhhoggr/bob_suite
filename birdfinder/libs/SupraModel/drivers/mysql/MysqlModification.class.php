<?php

class MysqlModification implements Modification {

    public function __construct(MysqlModel $model) {

        $this->model = $model; 
    }

    public function save() {

        $identifier = $this->model->getTableIdentifier();
        $attributes = $this->_getAttributes();
        $conditions = null;

        if(!empty($attributes[$identifier]))
            $conditions = $identifier . ' = "' . $attributes[$identifier] . '"';

        //the record already exists by the specified identifier
        if($this->model->selectionHandler->findOneBy(array($conditions)) && !empty($conditions)) {
            $this->_update();

            //return the modified id
            return $attributes[$identifier];
        }
        //the record doesnt exist yet create a new one
        else {
            $this->_insert();

            //return the last insertion id
            return $this->model->lastInsertedId();
        }

    }

    private function _getAttributes() {

        $attributes = array();

        $columns = $this->model->getColumnsByTable($this->model->getTable());


        foreach($columns as $col) {
            if(!empty($this->model->$col))
                $attributes[$col] = $this->model->$col;
        }

        return $attributes;
    }

    private function _insertAttributes() {

        $attributes = $this->_getAttributes();

        $attr['columns'] = '`' . implode('`,`',array_keys($attributes)) . '`';       
        $attr['values'] = '"' . implode('","',array_values($attributes)) . '"';

        return $attr;
    }

    private function _updateAttributes() {
        $identifier = $this->model->getTableIdentifier();

        $attributes = $this->_getAttributes();

        foreach($attributes as $k=>$v) {
            if($k != $identifier)
                $statements[] = '' . $k . ' = "'. $v . '"';
        }

        return ' SET ' . implode(',',$statements) . ' WHERE ' . $identifier .' = '. $attributes[$identifier];
    }

    private function _insert() {

        $attributes = $this->_insertAttributes();

        extract($attributes);

        $sql = 'INSERT INTO ' . $this->model->getTable() . '('.$columns.') VALUES('.$values.')';

        $this->model->execute($sql);
    }

    private function _update() {
        $attributes = $this->_updateAttributes();

        $sql = 'UPDATE ' . $this->model->getTable() . ' ' . $attributes;
 
        $this->model->execute($sql);
    }


}
