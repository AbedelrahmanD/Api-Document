<?php
if(!isset($_GET["project_id"])){
header("location: add_project.php");
}
include_once "add_project.php";