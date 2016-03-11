<?php


class database {
 
    protected $db_name = 'Internship';
    protected $db_user = 'root';
    protected $db_pass = '';
    protected $db_host = 'localhost';
 
   
    public function connect() {
        $connection = mysql_connect($this->db_host, $this->db_user, $this->db_pass);


       
        if (!$connection) {
            die("Connection failed: " . $connection->connect_error);
            return false;
        } else {
            mysql_select_db($this->db_name) or die("can't select");

            return true;
        }
    }
    

    public function process($rowSet)
    {
       
        $resultArray = array();
        while($row = mysql_fetch_assoc($rowSet))
        {
            array_push($resultArray, $row);
        }
 
        return $resultArray; //return array of array
    }
 
    
    public function select($table, $where) {
        $sql = "SELECT * FROM $table WHERE $where";
        echo $sql;
        $result = mysql_query($sql)or die(mysql_error());
        if(mysql_num_rows($result) == 1){
            return $this->process($result);
        }
        return $this->process($result);
    }
 
    
    public function update($data, $table, $where) {
        foreach ($data as $column => $value) {
            $sql = "UPDATE $table SET $column = $value WHERE $where";
            mysql_query($sql) or die(mysql_error());
        }
        return true;
    }
 
    
    public function insert($data, $table) {
 
        $columns = "";
        $values = "";
 
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= $column;
            $values .= ($values == "") ? "" : ", ";
            $values .= $value;
        }
 
        $sql = "insert into $table ($columns) values ($values)";
  echo $sql;
        mysql_query($sql) or die(mysql_error());
 
        //return the ID of the user in the database.
        return mysql_insert_id();
 
    }
 
}


 ?>

 
