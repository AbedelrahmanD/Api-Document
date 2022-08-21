<?php
if(!isset($_GET["api_id"])){
header("location: add_api.php");
}
include_once "add_api.php";