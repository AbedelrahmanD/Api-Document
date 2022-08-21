<?php

include_once __DIR__ . "./../autoload_register.php";
$formAction = "insert";
$record = [
    "project_id" => 0,
    "project_title" => "",
    "project_description" => "",
];
$fetchedRecord = null;

if (isset($_GET["project_id"])) {
    $fetchedRecord = ProjectModel::select(["project_id" => $_GET["project_id"]]);
    if ($fetchedRecord != null) {
        $record = $fetchedRecord[0];
        $formAction = "update";
        session_start();
        $_SESSION["project_id"] = $record["project_id"];
    }
}

?>

<form class="cmForm" id="jsProjectForm" action="Api/ProjectApi.php?action=<?= $formAction ?>" method="post" data-form="resetForm">

    <div data-form-message></div>
    <div class="cmInputContainer">
        <input data-type="text" data-type-message="Required" autocomplete="off" type="text" class="cmInput" placeholder=" " name="project_title" value="<?= $record['project_title'] ?>">
        <label class="cmInputLabel">Title</label>
    </div>



    <div class="cmInputContainer">
        <textarea class="cmInput" placeholder=" " name="project_description" cols="30" rows="10"><?= $record['project_description'] ?></textarea>
        <label class="cmInputLabel">Description</label>
    </div>




    <?php if ($fetchedRecord == null) : ?>
        <button class="cmButton" type="submit">Submit</button>

    <?php else : ?>
        <div class="buttonsContainer">
            <button class="cmButton " type="submit">Update</button>
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
            $("#jsProjectForm").trigger("reset");
        } else {

            $("#jsClosePopup").trigger("mousedown").trigger("click");
        }
    }

    function deleteRecord() {
        if (!confirm("Confirm Delete")) {
            return;
        }
        $.get("Api/ProjectApi.php?action=delete",
            function(data, textStatus, jqXHR) {
                resetForm(JSON.parse(data));
            },
        );
    }
</script>