<?php

namespace App\Core;
use PDO;

class DataBase
{
    protected function get_connection()
    {     
        return new PDO('mysql:host='.HOST.';dbname='.DB.';charset=UTF8', USERNAME, PASSWORD);    
    }

    public function insert (string $table, array $data) 
    {       
        $columns = implode(", ", array_keys($data));
        $values = array_values($data);
        $v_placeholders = [];
        while (count($v_placeholders) < count($values)) {
            $v_placeholders[] = '? ';
        }
        $placeholders = implode(',', $v_placeholders);
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        return $this->get_connection()->prepare($query)->execute($values);    
    }

    public function update (string $table, array $column, array $condition) 
    {
        $col_name = implode('', array_keys($column));
        $cond_name = implode('', array_keys($condition));
        $values = [
            array_values($column),
            array_values($condition)
        ];
        $query = "UPDATE $table SET $col_name = ? WHERE $cond_name = ?";

        return $this->get_connection()->prepare($query)->execute($values);        
    }

    public function update_field (string $query, array $value) 
    {
        $stmt = $this->get_connection()->prepare($query);
        return $stmt->execute($value);
    }

    public function get_data (string $table)
    {
        $query = "SELECT * FROM $table";        
        $stmt = $this->get_connection()->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }  
        if ($result) {
            return $result;
        }
        return false;        
    }    

    public function get_data_row (string $table, string $column, $value)
    {
        $query = "SELECT * FROM $table WHERE $column = ?";        
        $stmt = $this->get_connection()->prepare($query);
        $stmt->execute([$value]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?? false;         
    } 

    public function get_data_rows (string $table, string $column, $value)
    {
        $query = "SELECT * FROM $table WHERE $column = ?";        
        $stmt = $this->get_connection()->prepare($query);
        $stmt->execute([$value]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        } 
        return $result ?? false;         
    } 
    
    public function get_data_column (string $table, string $column)
    {
        $query = "SELECT $column FROM $table ";        
        $stmt = $this->get_connection()->prepare($query);
        $stmt->execute();        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }  
        return $result ?? false;        
    } 

    public function get_data_fields (string $query, $value) 
    {
        $stmt = $this->get_connection()->prepare($query);
        $stmt->execute([$value]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }  
        return $result ?? false;
    }

    public function get_data_field (string $query, array $value) 
    {
        $stmt = $this->get_connection()->prepare($query);
        $stmt->execute($value);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?? false;
    }

    public function get_field (string $query, array $values) 
    {
        $stmt = $this->get_connection()->prepare($query);
        $stmt->execute($values);
        return $stmt->fetch(PDO::FETCH_COLUMN) ?? false;
    }

    public function delete (string $query, array $values)
    {
        $stmt = $this->get_connection()->prepare($query);
        return $stmt->execute($values);
    }
}
