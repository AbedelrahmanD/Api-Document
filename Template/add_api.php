<?php

include_once __DIR__ . "./../autoload_register.php";
$formAction = "insert";
$readOnly = "";
$methods = ["Post", "Get", "Put", "Delete"];
$record = [
    "api_id" => 0,
    "project_id" => isset($_GET["project_id"]) ? $_GET["project_id"] : 0,
    "api_title" => "",
    "api_method" => "Post",
    "api_url" => "",
    "api_header" => "",
    "api_body_type" => "FormData",
    "api_body" => "",
    "api_response" => "",
];
$fetchedRecord = null;
// $projects = ProjectModel::select();

if (isset($_GET["api_id"])) {

    $fetchedRecord = ApiModel::select(["api_id" => $_GET["api_id"]]);
    if ($fetchedRecord != null) {
        $record = $fetchedRecord[0];
        $formAction = "update";
        session_start();
        $_SESSION["api_id"] = $record["api_id"];
    }
}
if (isset($_GET["isReadOnly"])) {
    $readOnly = "readonly";
}

?>


<form class="cmForm apiForm" id="jsApiForm" action="Api/DocApi.php?action=<?= $formAction ?>" method="post" data-form="resetForm">
    <div data-form-message></div>
    <!-- <div style="display: none;">
        <select name="project_id" class="fullWidth">
            <?php foreach ($projects as $project) : ?>
                <option <?= $project['project_id'] == $record['project_id'] ? 'selected' : '' ?> value="<?= $project['project_id'] ?>"><?= $project['project_title'] ?></option>
            <?php endforeach; ?>
        </select>
    </div> -->

    <div class="cmInputContainer fullWidth">
        <input <?= $readOnly ?> name="api_title" value="<?= $record['api_title'] ?>" data-type="text" data-type-message="Required" autocomplete="off" type="text" class="cmInput" placeholder=" ">
        <label class="cmInputLabel">Title</label>
    </div>

    <div class="apiUrlContainer fullWidth">
        <select <?= $readOnly ?> name="api_method">
            <?php foreach ($methods as $method) : ?>
                <option value="<?= $method ?>" <?= $method == $record['api_method'] ? 'selected' : '' ?>><?= $method ?></option>
            <?php endforeach; ?>
        </select>
        &nbsp;
        <div class="cmInputContainer fullWidth">
            <input <?= $readOnly ?> name="api_url" value="<?= $record['api_url'] ?>" data-type="text" data-type-message="Required" autocomplete="off" type="text" class="cmInput" placeholder=" ">
            <label class="cmInputLabel">Url</label>
        </div>
    </div>

    <div class="cmInputContainer fullWidth">
        <textarea <?= $readOnly ?> class="cmInput" name="api_header" cols="30" rows="2" placeholder=" "><?= $record['api_header'] ?></textarea>
        <label class="cmInputLabel">Header</label>
    </div>



    <div class="bodyTypeContainer fullWidth">
        <label for="body_type">Body Type</label>
        <div class="bodyTypeOptions">
            <input <?= $readOnly ?> type="radio" value="FormData" name="api_body_type" <?= $record['api_body_type'] == "FormData" ? 'checked' : '' ?>>FormData
            <input <?= $readOnly ?> type="radio" value="json" name="api_body_type" <?= $record['api_body_type'] == "json" ? 'checked' : '' ?>>Json
        </div>
    </div>




    <div class="apiBodyResponseContainer fullWidth">
        <div class="cmInputContainer fullWidth">
            <textarea <?= $readOnly ?> class="cmInput" name="api_body" cols="30" rows="10" placeholder=" "><?= $record['api_body'] ?></textarea>
            <label class="cmInputLabel">Body</label>
        </div>
        &nbsp;
        <div class="cmInputContainer fullWidth">
            <textarea <?= $readOnly ?> class="cmInput" name="api_response" cols="30" rows="10" placeholder=" "><?= $record['api_response'] ?></textarea>
            <label class="cmInputLabel">Response</label>
        </div>

    </div>

    <?php if ($fetchedRecord == null) : ?>
        <button class="cmButton fullWidth" type="submit">Submit</button>
    <?php else : ?>
        <div class="buttonsContainer">
            <button class="cmButton" type="submit">Update</button>
            <button class="cmButton cmButtonSecondary" onclick="deleteRecord()" type="button">Delete</button>
        </div>
    <?php endif; ?>
    <center>
        <div data-form-loader class="cmSpinner"></div>
    </center>


</form>


<script>
    function resetForm(response) {
        if (response.status != "success") {
            return;
        }
        if (response.action == "insert") {
            $("#jsApiForm").trigger("reset");
        } else {
            $("#jsClosePopup").trigger("mousedown").trigger("click");
        }
    }

    function deleteRecord() {
        if (!confirm("Confirm Delete")) {
            return;
        }
        $.get("Api/DocApi.php?action=delete",
            function(data, textStatus, jqXHR) {
                resetForm(JSON.parse(data));
            },
        );
    }
</script>