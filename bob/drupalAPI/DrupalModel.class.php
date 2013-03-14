<?php

require_once(dirname(__FILE__) . '/../../birdfinder/libs/SupraModel/SupraModel.class.php');

$dbuser = 'zmijevik';
$dbpassword  = 'a1genda666';
$dbname = 'zmijevik_bob';
$dbhost = 'localhost';
$driver = 'mysql';

$connection_args = compact('dbuser','dbname','dbpassword','dbhost','driver');

class DrupalModel extends SupraModel {

    public function configure() {
        $this->setTable('bob_term_data');
    }

    public function cleanTaxAndNode($condition) {
        $sql = "
        DELETE
        td.*, th.*, ti.*, tn.*, n.*, ncs.*, nc.*, nr.*
        FROM bob_term_data td
        LEFT JOIN bob_term_hierarchy th ON td.tid = th.tid
        LEFT JOIN bob_term_image ti ON td.tid = ti.tid
        LEFT JOIN bob_term_node tn ON td.tid = tn.tid
        LEFT JOIN bob_node n ON tn.nid = n.nid
        LEFT JOIN bob_node_comment_statistics ncs ON tn.nid = ncs.nid
        LEFT JOIN bob_node_counter nc ON tn.nid = nc.nid
        LEFT JOIN bob_node_revisions nr ON tn.nid = nr.nid
        WHERE td.tid $condition
        ";

        $this->execute($sql);
    }

    public function cleanNode($condition) {
        $sql = "
        DELETE n.*, ncs.*, nc.*, nr.*
        FROM bob_node n
        LEFT JOIN bob_node_comment_statistics ncs ON n.nid = ncs.nid
        LEFT JOIN bob_node_counter nc ON n.nid = nc.nid
        LEFT JOIN bob_node_revisions nr ON n.nid = nr.nid
        WHERE n.nid $condition";

        $this->execute($sql);
    }

    public function cleanTax($condition) {
        $sql = "
        DELETE
        td.*, th.*, ti.*, tn.*
        FROM bob_term_data td
        LEFT JOIN bob_term_hierarchy th ON td.tid = th.tid
        LEFT JOIN bob_term_image ti ON td.tid = ti.tid
        LEFT JOIN bob_term_node tn ON td.tid = tn.tid
        WHERE td.tid $condition
        ";

        $this->execute($sql);
    }
}

$DrupalModel = new DrupalModel($connection_args);

//$DrupalModel->cleanTaxAndNode(" > 105");
$DrupalModel->cleanNode(" > 226");
$DrupalModel->cleanTax(" > 0");
