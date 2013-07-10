<?php 

require_once(dirname(__FILE__) . '/DB.class.php');

class DBAL extends DB {

    private 
        $debugMode = false,
        $querySql,
        $sqlFields,
        $sqlConditions;

    public function setDebugMode($mode) {

        $this->debugMode = $mode;
    }

    public function getQuerySql() {

        return $this->querySql;
    } 

    private function _sqlizeFields($fields) {

        $this->sqlFields = (is_array($fields)) ? implode(', ',$fields) : $fields;
    }

    private function _sqlizeConditions($conditions=null) {

        if(!empty($conditions)) {

            if(is_array($conditions))
                $conditions = implode(" AND ", $conditions);

            $this->sqlConditions = " WHERE $conditions";
        }
    }

    public function find($table, $fields="*", $order = null, $fetchArray = true) {

        return $this->findBy($table, $fields, null, $order, $fetchArray);
    }

    public function findBy($table, $fields = "*", $conditions = null, $order = null, $fetchArray = true) {

        $this->_sqlizeFields($fields);
        
        $this->_sqlizeConditions($conditions);        

        $this->querySql = "SELECT ". $this->sqlFields . " FROM $table " . $this->sqlConditions . " $order";

        if($fetchArray) return $this->_fetchArrayFromQuery();
    }

    public function findOneBy($table, $fields, $conditions=null, $order = null) {
                     
        $this->findBy($table, $fields, $conditions, $order, false);

        return $this->queryUniqueValue($this->querySql, $this->debugMode);
    }

    private function _getResultFromQuery() {

        return $this->query($this->querySql, $this->debugMode);
    }

    private function _fetchArrayFromQuery() {

       $result = $this->_getResultFromQuery();

       $all = array();

       $fields = $this->sqlFields;

        while($row = mysql_fetch_assoc($result)) {
            $values = null;

            if($fields == "*") {
                $all[] = $row;
            }
            else if(is_array($fields)) {
                foreach($fields as $field) {
                    $values[$field] = $row[$field];
                }

                $all[] = $values;
            }
            else {
                $all[] = $row[$fields];
            }
        }

        return $all;
    }
}
