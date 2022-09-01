<?php


class RestApi
{
    public function __construct()
    {
        if (isset($_REQUEST["action"])) {
            $response = [];
            $action = $_REQUEST["action"];
            if ($action == "insert") {
                $response = $this->insert($_POST);
            } else  if ($action == "update") {
                $response = $this->update($_POST);
            } else if ($action == "delete") {
                $response = $this->delete();
            } else if ($action == "select") {
                $response = $this->select($_POST);
            }

            echo json_encode($response);
        }
    }

    public  function select($data = null)
    {
    }
    public  function insert($data)
    {
    }
    public  function update($data)
    {
    }

    public  function delete()
    {
    }
}
