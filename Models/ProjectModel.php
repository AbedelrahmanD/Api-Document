<?php

include_once __DIR__ . "../../Helpers/DB.php";
class ProjectModel
{
    public static $dbTable = "project";

    public static function select($project = [])
    {
        $condition = "";
        $params = [];
        if (isset($project['project_id']) != null) {
            $condition = " and project.project_id=:project_id ";
            $params["project_id"] = $project['project_id'];
        }

        if (isset($project["project_title"])) {
            $condition .= " and project.project_title=:project_title ";
            $params["project_title"] = $project["project_title"];
        }

        if (isset($project["project_id_diff"])) {
            $condition .= " and project.project_id!=:project_id ";
            $params["project_id"] = $project["project_id_diff"];
        }
        $query = "select * from project where 1 $condition order by project_id desc ";

        return  DB::select($query, $params);
    }

    public static function isTitleExists($project)
    {
        return count(self::select($project));
    }
    public static function insert($project)
    {
        $response = [
            "status" => "error",
            "message" => "Error, Try Again Later",
            "action" => "insert",
        ];

        if (self::isTitleExists(["project_title" => $project["project_title"]])) {
            $response["status"] = "error";
            $response["message"] = "Title Already Exists";
            return $response;
        }
        $result = DB::insert(self::$dbTable, $project);
        if ($result > 0) {
            $response["status"] = "success";
            $response["message"] = "Inserted Successfully";
        }
        return $response;
    }

    public static function update($project)
    {
        session_start();

        $response = [
            "status" => "error",
            "message" => "Error, Try Again Later",
            "action" => "update",
        ];
        if (self::isTitleExists([
            "project_title" => $project["project_title"],
            "project_id_diff" => $_SESSION["project_id"],
        ])) {
            $response["status"] = "error";
            $response["message"] = "Title Already Exists";
            return $response;
        }
        $where = [
            "project_id" => $_SESSION["project_id"]
        ];
        $result =  DB::update(self::$dbTable, $project, $where);
        if ($result >= 0) {
            $response["status"] = "success";
            $response["message"] = "Updated Successfully";
        }
        return $response;
    }

    public static function delete()
    {
        session_start();
        $response = [
            "status" => "error",
            "message" => "Error, Try Again Later",
            "action" => "delete",
        ];

        $where = [
            "project_id" => $_SESSION["project_id"],
        ];
        $result =   DB::delete(self::$dbTable, $where);
        if ($result > 0) {
            $response["status"] = "success";
            $response["message"] = "Deleted Successfullt";
        }
        return $response;
    }
}
