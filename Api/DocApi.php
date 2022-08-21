<?php
include __DIR__ . "./../autoload_register.php";
class DocApi
{
    public function __construct()
    {
        if (isset($_GET["action"])) {
            $response = [];
            $action = $_GET["action"];
            if ($action == "insert") {
                $response = ApiModel::insert($_POST);
            } else  if ($action == "update") {

                $response = ApiModel::update($_POST);
            } else if ($action == "delete") {

                $response = ApiModel::delete();
            } else if ($action == "select") {
                $response = ApiModel::select(isset($_POST));
            }

            echo json_encode($response);
        }
    }
}

new DocApi();
