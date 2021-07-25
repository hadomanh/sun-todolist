<?php
class Database {
    var $sql_string = '';
    var $error_no = 0;
    var $error_msg = '';
    private $result = null;
    private $conn;
    public $last_query;
    private $real_escape_string_exists;

    function __construct() {
        $this->open_connection();
        $this->real_escape_string_exists = function_exists("mysqli_escape_string");
    }

    public function open_connection() {
        $server = server;
        $user = user;
        $pass = pass;
        $db = database_name;
        $this->conn = mysqli_connect(server,user,pass, database_name);
        if (!$this->conn) {
            echo "Problem in database connection! Contact administrator!";
            exit();
        }
    }

    function setQuery($sql = '') {
        $this->sql_string = $sql;
    }

    function executeQuery() {
        $result = mysqli_query($this->conn, $this->sql_string);
        error_log($this->sql_string);
        $this->result = $this->confirm_query($result);
        error_log(json_encode($this->result));
        return $result;
    }

    private function confirm_query($result) {
        if (!$result) {
            $this->error_no = mysqli_errno($this->conn);
            $this->error_msg = mysqli_error($this->conn);
            return false;
        }
        return $result;
    }

    function loadResultList($key = '') {
        $cur = $this->executeQuery();

        $array = array();
        while ($row = mysqli_fetch_object($cur)) 
            if ($key) 
                $array[$row->$key] = $row;
            else 
                $array[] = $row;
        mysqli_free_result($cur);
        return $array;
    }

    function loadSingleResult() {
        $cur = $this->executeQuery();

        while ($row = mysqli_fetch_object($cur)) 
            return $row;
        mysqli_free_result($cur);
        //return $data;
    }

    function loadSingleRow() {
        $cur = $this->executeQuery();

        while ($row = mysqli_fetch_row($cur)) 
            return $row;
        mysqli_free_result($cur);
    }

    function getFieldsOnOneTable($tbl_name) {

        $this->setQuery("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = '" . $tbl_name . "'");
        $rows = $this->loadResultList();
        $f = array();
        for ($x = 0; $x < count($rows); $x++) {
            $f[] = $rows[$x]->column_name;
        }

        return $f;
    }

    public function fetch_array($result) {
        return mysqli_fetch_array($result);
    }
    //gets the number or rows
    public function num_rows($result_set) {
        return mysqli_num_rows($result_set);
    }

    public function insert_id() {
        // get the last id inserted over the current db connection
        return mysqli_insert_id($this->result);
    }

    public function affected_rows() {
        return mysqli_affected_rows($this->conn);
    }

    public function escape_value($value) {
        if ($this->real_escape_string_exists)  // PHP v4.3.0 or higher
            $value = mysqli_escape_string($this->conn, $value);
        return $value;
    }

    public function close_connection() {
        if (isset($this->conn)) {
            mysqli_close($this->conn);
            unset($this->conn);
        }
    }
}
$mydb = new Database();
