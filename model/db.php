<?php
/**
 * Created by PhpStorm.
 * User: STALKER
 * Date: 10.09.2018
 * Time: 13:12
 */

define("SERVER_NAME", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "");
define("DB_NAME", "task7");

class db
{
   
    /**
     * @param string|null $querySQL
     * @return bool
     */
    public function execSQL($querySQL = null)
    {
        if($querySQL == null) return false;
        
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
        $conn->set_charset("utf8");
        
        if ($conn->connect_error) {
            echo ("Ошибка подключения: " . $conn->connect_error);
            return false;
        }
        
        if (!$conn->query($querySQL) === TRUE) {
            $conn->close();
            return false;
        }
        
        $conn->close();
        
        return true;
    }
    
    /**
     * @param string|null $tableName
     * @param array $columns
     * @return bool
     */
    public function insert($tableName = null, $columns = [])
    {
        if($tableName != null && count($columns) > 0) {
            
            $keys = '';
            $values = '';
            
            foreach ($columns as $key => $value) {
                
                if(empty($keys)) $keys .= $key;
                else $keys .= ', ' . $key;
                
                if(empty($values)) $values .= "'" . $value . "'";
                else $values .= ", '" . $value . "'";
                
            }
            
            $sql = "
                INSERT INTO $tableName ($keys) VALUES ($values);
            ";
            
            return $this->execSQL($sql);
        }
        
        return false;
    }
    
    /**
     *
     */
    public function select($querySQL = null) {

        if($querySQL == null) return null;
    
        $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
        $conn->set_charset("utf8");

        if ($conn->connect_error) {
            echo ("Ошибка подключения: " . $conn->connect_error);
            return false;
        }

        $result = $conn->query($querySQL);

        if ($result->num_rows > 0) {
            $conn->close();
            return $result;
        }
        else {
    
            $conn->close();
            return null;
        
        }
    }
    
}