<?php
include __DIR__ . "./../autoload_register.php";
class ProjectApi
{
    public function __construct()
    {
        if (isset($_GET["action"])) {
            $response = [];
            $action = $_GET["action"];
            if ($action == "insert") {
                $response = ProjectModel::insert($_POST);
            } else  if ($action == "update") {
                $response = ProjectModel::update($_POST);
            } else if ($action == "delete") {
                $response = ProjectModel::delete();
            } else if ($action == "select") {
                $response = ProjectModel::select(isset($_POST["project_id"]) ? $_POST["project_id"] : null);
            }

            echo json_encode($response);
        }
    }
}

new ProjectApi();
