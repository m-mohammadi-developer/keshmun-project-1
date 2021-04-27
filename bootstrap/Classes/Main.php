<?php

namespace Classes;

class Main
{
    protected static $class_name;
    protected static $db_name;
    protected static $auto_inc = 'id';

    // database columns (in database)
    protected static $db_columns;


    /*********************** Methods *************************** */


    public static function countAll()
    {
        global $conn;
        $sql = "SELECT COUNT(*) FROM " . static::$db_name;
        
        $result = $conn->conn->query($sql);
        $count = $result->fetch(\PDO::FETCH_ASSOC);
        return array_shift($count);
    }

    public static function searchForIn($query, $column)
    {
        return static::findAllWhere([[$column, 'LIKE', "%{$query}%"]]);
    }
    /**
     * Find All Rows in Database belongs to this class
     */
    public static function findAll()
    {
        return static::findAllQuery("Select * from ". static::$db_name, [], static::$class_name);
    }

    /**
     * Find Items with Condition
     */
    public static function findAllWhere(array $cond, $limit = null, $order = "desc", $order_column = "id")
    {
        /**
         * {
         *  ['feild', 'action', 'value']
         * }
         */
        $items = [];
        $values = [];
        foreach ($cond as $arr) {
            $items[] = $arr[0] . " " . $arr[1] . " ?";
            $values[] = $arr[2];
        }
        
        $order = strtoupper($order);
        // die("Select * from ". static::$db_name . " where " . implode(', ', $items) . " LIMIT {$limit} ORDER BY " . static::$auto_inc . " " . $order);
        if (!isset($limit)) {
            return static::findAllQuery("Select * from ". static::$db_name . " where " . implode(', ', $items) . " ORDER BY " . $order_column . " $order", $values, static::$class_name);
        } else {
            return static::findAllQuery("Select * from ". static::$db_name . " where " . implode(', ', $items) . " ORDER BY " . $order_column . " $order LIMIT {$limit}", $values, static::$class_name);
        }
    }


    public static function findWhere(array $cond, $limit = null, $order = "desc")
    {
        /**
         * {
         *  ['feild', 'action', 'value']
         * }
         */
        $items = [];
        $values = [];
        foreach ($cond as $arr) {
            $items[] = $arr[0] . " " . $arr[1] . " ?";
            $values[] = $arr[2];
        }
    
        
        // die("Select * from ". static::$db_name . " where " . implode(', ', $items) . " LIMIT {$limit} ORDER BY " . static::$auto_inc . " " . $order);
        if (!isset($limit)) {
            return static::findQuery("Select * from ". static::$db_name . " where " . implode(', ', $items) . " ORDER BY " . static::$auto_inc . " $order", $values, static::$class_name);
        } else {
            return static::findQuery("Select * from ". static::$db_name . " where " . implode(', ', $items) . " ORDER BY " . static::$auto_inc . " $order LIMIT {$limit}", $values, static::$class_name);
        }
    }


    /**
     * Find the row from Database By Id
     */
    public static function findById($id)
    {
        return static::findQuery("Select * from " . static::$db_name . " where ". static::$auto_inc ." = ?", [$id], static::$class_name);
    }

    /**
     * DB Connectors
     */
    protected static function findAllQuery(string $sql, array $values = [], $class)
    {
        global $conn;
        return $conn->selectAll($sql, $values, $class);
    }

    protected static function findQuery(string $sql, array $values = [], $class)
    {
        global $conn;
        return $conn->select($sql, $values, $class);
    }
    /** **** */


    public function create()
    {
        global $conn;
        $properties = static::properties($this);

        $sql = "INSERT INTO ". static::$db_name ." ( ". implode(",", array_keys($properties)) ." )";
        $sql .= " VALUES (". implode(",", array_values($properties)) .")";
        
        return $conn->do($sql, static::propertiesValue($this));
    }


    public function update()
    {
        global $conn;
        $properties = static::properties($this);

        // array of property's Keys and ? ;; like property => ?
        $array = [];
        foreach ($properties as $key => $value) {
            $array[] = $key . " = " . $value;
        }
        $sql = "UPDATE ". static::$db_name ." set " . implode(", ", $array) . " where ". static::$auto_inc ." = ". $this->id;

        
        return $conn->do($sql, static::propertiesValue($this));
    }


    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }


    public function delete()
    {
        global $conn;
        $sql = "DELETE FROM ". static::$db_name . " where ". static::$auto_inc ." = ". $this->id;
        
        return $conn->do($sql);
    }



    /************************************** Helper Methods **************************************/


    /**
     * get class properties
     */
    public static function properties($object)
    {
        $properties = get_object_vars($object);

        $prop_db = [];
        foreach ($properties as $key => $value) {
            if ($key == 'id' || $key == 'created_at') {
                continue;
            }

            if (in_array($key, static::$db_columns)) {
                $prop_db[$key] = "?";
            }
        }
        return $prop_db;
    }
    
    public static function propertiesValue($object)
    {
        $properties = get_object_vars($object);

        $prop_db = [];
        foreach ($properties as $key => $value) {
            if ($key == 'id' || $key == 'created_at') {
                continue;
            }

            if (in_array($key, static::$db_columns)) {
                $prop_db[] = $value;
            }
        }
        return $prop_db;
    }
}
