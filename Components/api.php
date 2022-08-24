<?php

include_once __DIR__ . "./../autoload_register.php";
if(isset($_GET["api_id"])){
    $api=Utils::api("Api",["api_id"=>$_GET["api_id"]])[0];
}
?>

<div id="jsApi_<?= $api['api_id'] ?>" class="jsApi api" data-api_id='<?= $api['api_id'] ?>'>
    <span class="iconify" data-icon="ic:baseline-api"></span>
    <span class="jsApiTitle"><?= $api['api_title'] ?></span>
</div>