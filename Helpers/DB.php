<?php

class DB
{
    public static function getConnection()
    {

        $conn = new PDO("mysql:host=" . Config::$host . ";dbname=" . Config::$dbName . "", Config::$username, Config::$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public static function execute($query = "", $bindParams = [], $getInsertedId = false)
    {

        $conn = DB::getConnection();
        $stmt = $conn->prepare($query);
        foreach ($bindParams as $key => $param) {
            $stmt->bindParam(":$key", $bindParams["$key"]);
        }

        $result = $stmt->execute();
        if ($getInsertedId) {
            return $conn->lastInsertId();
        }
        return $result;
    }


    public static function delete($tableName, $where = [])
    {

        $deleteWhere = [];
        foreach ($where as $field => $value) {
            $deleteWhere[] = "$field=:$field";
        }
        $deleteWhere = implode("and", $deleteWhere);
        $query = "delete from $tableName where 1 and $deleteWhere";
        return self::execute($query, $where);
    }
    public static function update($tableName, $params = [], $where = [])
    {
        $fields = [];

        foreach ($params as $field => $value) {
            $fields[] = "$field=:$field";
        }
        $fields = implode(",", $fields);

        $updateCondition = [];
        foreach ($where as $field => $value) {
            $updateCondition[] = "$field=:$field";
        }
        $updateCondition = implode("and", $updateCondition);

        $query = "update  $tableName set $fields where 1 and $updateCondition";

        return self::execute($query, array_merge($params, $where));
    }

    public static function insert($tableName, $params = [])
    {
        $fields = [];
        $values = [];
        foreach ($params as $field => $value) {
            $fields[] = $field;
            $values[] = ":$field";
        }
        $fields = implode(",", $fields);
        $values = implode(",", $values);
        $query = "insert into $tableName ($fields) values ($values)";

        return self::execute($query, $params, true);
    }

    public static function select($query = "", $bindParams = [])
    {

        $conn = DB::getConnection();
        $stmt = $conn->prepare($query);
        foreach ($bindParams as $key => $param) {
            $stmt->bindParam(":$key", $bindParams["$key"]);
        }
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public static function isExists($tableName, $params = [], $expect = [])
    {

        $condition = "";
        $bindParams = [];
        foreach ($params as $field => $value) {
            $condition .= " and $field=:$field";
            $bindParams[$field] = $params[$field];
        }

        foreach ($expect as $field => $value) {
            $condition .= " and $field!=:$field";
            $bindParams[$field] = $expect[$field];
        }


        $query = "select * from $tableName where 1 $condition ";

        $result = DB::select($query, $bindParams);
        return count($result);
    }

    public static function getColumns($tableName)
    {
        $query = "SHOW columns FROM  $tableName";

        return DB::select($query);
    }
    public static function createArray($tableName)
    {
        $arr = [];
        $result = self::getColumns($tableName);
        foreach ($result as $key => $column) {
            $arr[$column["Field"]]  = $column["Default"];
        }
        return $arr;
    }
}
//createarray