<?php

include_once __DIR__ . "./../autoload_register.php";
$formAction = "insert";
$record = DB::createArray("project");
$fetchedRecord = null;

if (isset($_GET["project_id"])) {
    $fetchedRecord = Utils::api("Project", ["project_id" => $_GET["project_id"]]);

    if ($fetchedRecord != null) {
        $record = $fetchedRecord[0];
        $formAction = "update";
        session_start();
        $_SESSION["project_id"] = $record["project_id"];
    }
}

?>

<form class="cmForm" id="jsProjectForm" action="Api/Project.php?action=<?= $formAction ?>" method="post" data-form="projectFormSubmitDone">

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
    <div class="cmSpinnerContainer" data-form-loader>
        <div class="cmSpinner"></div>
    </div>



</form>


<script>
    function deleteRecord() {
        if (!confirm("Confirm Delete")) {
            return;
        }
        $.get("Api/Project.php?action=delete",
            function(data, textStatus, jqXHR) {
                data = JSON.parse(data);
                $(`#jsProject_${data.id}`).remove();
                $("#jsClosePopup").trigger("click");
            },
        );
    }

    function projectFormSubmitDone(data) {
        if (data.status != "success") {
            return;
        }

        $.get(`Components/project.php?project_id=${data.id}`, function(html) {
            if (data.action == "update") {
                $(`#jsProject_${data.id}`).replaceWith(html);
            } else {
                $("#jsProjectForm").trigger("reset");
                $("#jsProjectGrid").prepend(html);
            }
            setTimeout(() => {
                $("#jsClosePopup").trigger("click");
            }, 500);

        });

    }
</script>