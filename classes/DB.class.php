<?php

include("$_SERVER[DOCUMENT_ROOT]/classes/class_db_pdo.inc.php");

class DB {
    /*     * **************************************************************************
     * ATTRIBUTES                                                                *
     * ************************************************************************** */

    var $host;
    var $db2;
    var $user;
    var $password;
    var $connection;
    var $connected;
    var $querystring;


    function DB() {
        $this->db2 = new connDB();
    }

    function select_db($db2) {
        return true;
    }
	
	
    function execresultset($querystring) {
        $result = $this->db2->exec($querystring);
        $rows = $this->db2->resultset();
        return $rows;
    }

    function execonly($querystring) {
        $this->db2->exec($querystring);
        return 1;
    }
	
	public function fetch_array($result)
    {
        $row = mysql_fetch_array($result);

        return $row;
    }
	
    function query_first($querystring) {
        $this->db2->exec($querystring);
        $row = $this->db2->single();
        return $row;
    }
    public function transaction()
    {
      return $this->db2->transaction();
    }
    public function commit()
    {
      return $this->db2->commit();
    }
    public function rollback()
    {
      return $this->db2->rollback();
    }

}

?>
