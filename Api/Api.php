<?php
include_once __DIR__ . "./../autoload_register.php";

class Api extends RestApi
{
    public static $dbTable = "api";



    public  function select($api = null)
    {

        $condition = "";
        $params = [];
        if (isset($api["api_id"])) {
            $condition .= " and api.api_id=:api_id ";
            $params["api_id"] = $api["api_id"];
        }
        if (isset($api["project_id"])) {
            $condition .= " and project.project_id=:project_id ";
            $params["project_id"] = $api["project_id"];
        }

        if (isset($api["api_title"])) {
            $condition .= " and api.api_title=:api_title ";
            $params["api_title"] = $api["api_title"];
        }

        if (isset($api["api_id_diff"])) {
            $condition .= " and api.api_id!=:api_id ";
            $params["api_id"] = $api["api_id_diff"];
        }
        $query = "select * from api 
        inner join project on api.project_id=project.project_id where 1 $condition order by api_id desc";


        return  DB::select($query, $params);
    }


    public  function insert($api)
    {
        session_start();
        $response = [
            "status" => "error",
            "message" => "Error, Try Again Later",
            "action" => "insert",
        ];
        $api["project_id"] = $_SESSION["project_id"];


        if (DB::isExists(
            "api",
            [
                "api_title" => $api["api_title"],
                "project_id" => $api["project_id"]
            ]
        )) {
            $response["status"] = "error";
            $response["message"] = "Title Already Exists";
            return $response;
        }

        $result = DB::insert(self::$dbTable, $api);
        if ($result > 0) {
            $response["status"] = "success";
            $response["message"] = "Inserted Successfully";
            $response["id"] = $result;
        }
        return $response;
    }

    public  function update($api)
    {
        session_start();
        $response = [
            "status" => "error",
            "message" => "Error, Try Again Later",
            "action" => "update",
        ];
        $api["project_id"] = $_SESSION["project_id"];


        if (DB::isExists(
            "api",
            [
                "api_title" => $api["api_title"],
                "project_id" => $api["project_id"]
            ],
            [
                "api_id" => $_SESSION["api_id"]
            ]

        )) {
            $response["status"] = "error";
            $response["message"] = "Title Already Exists";
            return $response;
        }
        $where = [
            "api_id" => $_SESSION["api_id"]
        ];

        $result = DB::update(self::$dbTable, $api, $where);
        if ($result >= 0) {
            $response["status"] = "success";
            $response["message"] = "Updated Successfully";
            $response["id"] = $_SESSION["api_id"];
        }
        return $response;
    }

    public  function delete()
    {
        session_start();
        $response = [
            "status" => "error",
            "message" => "Error, Try Again Later",
            "action" => "delete",
        ];

        $where = [
            "api_id" => $_SESSION["api_id"],
        ];
        $result =  DB::delete(self::$dbTable, $where);
        if ($result > 0) {
            $response["status"] = "success";
            $response["message"] = "Deleted Successfullt";
            $response["id"] = $_SESSION["api_id"];
        }
        return $response;
    }
}

new Api();
