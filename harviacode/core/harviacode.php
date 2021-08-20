<?php

class Harviacode
{
    private $host;
    private $user;
    private $password;
    private $database;
    private $sql;

    public function __construct()
    {
        $this->connection();
    }

    public function connection()
    {
        $subject = file_get_contents('../application/config/database.php');
        //$string = str_replace("defined('BASEPATH') OR exit('No direct script access allowed');", "", $subject);
        
        $con = 'core/connection.php';
        $create = fopen($con, "w") or die("Change your permision folder for application and harviacode folder to 777");
        fwrite($create, $string);
        fclose($create);
        
        require $con;

        $this->host = "localhost";
        $this->user = "root";
        $this->port = 8889;
        $this->password = "root";
        $this->database = "arsip";

        $this->sql = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->sql->connect_error) {
            echo $this->sql->connect_error . ", please check 'application/config/database.php'.";
            die();
        }
        
        unlink($con);
    }

    public function table_list()
    {
        $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=?";
        $stmt = $this->sql->prepare($query) or die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $stmt->bind_param('s', $this->database);
        $stmt->bind_result($table_name);
        $stmt->execute();
        while ($stmt->fetch()) {
            $fields[] = array('table_name' => $table_name);
        }
        return $fields;
        $stmt->close();
        $this->sql->close();
    }

    public function primary_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=? AND COLUMN_KEY = 'PRI'";
        $stmt = $this->sql->prepare($query) or die("Error code :" . $this->sql->errno . " (primary_field)");
        $stmt->bind_param('ss', $this->database, $table);
        $stmt->bind_result($column_name, $column_key);
        $stmt->execute();
        $stmt->fetch();
        return $column_name;
        $stmt->close();
        $this->sql->close();
    }

    public function not_primary_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=? AND COLUMN_KEY <> 'PRI'";
        $stmt = $this->sql->prepare($query) or die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $stmt->bind_param('ss', $this->database, $table);
        $stmt->bind_result($column_name, $column_key, $data_type);
        $stmt->execute();
        while ($stmt->fetch()) {
            $fields[] = array('column_name' => $column_name, 'column_key' => $column_key, 'data_type' => $data_type);
        }
        return $fields;
        $stmt->close();
        $this->sql->close();
    }

    public function all_field($table)
    {
        $query = "SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=?";
        $stmt = $this->sql->prepare($query) or die("Error code :" . $this->sql->errno . " (not_primary_field)");
        $stmt->bind_param('ss', $this->database, $table);
        $stmt->bind_result($column_name, $column_key, $data_type);
        $stmt->execute();
        while ($stmt->fetch()) {
            $fields[] = array('column_name' => $column_name, 'column_key' => $column_key, 'data_type' => $data_type);
        }
        return $fields;
        $stmt->close();
        $this->sql->close();
    }
}

$hc = new Harviacode();