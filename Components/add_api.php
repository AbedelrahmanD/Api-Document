<?php

include_once __DIR__ . "./../autoload_register.php";
$formAction = "insert";
$readOnly = "";
$methods = ["Post", "Get", "Put", "Delete"];
$record =DB::createArray("api");
$fetchedRecord = null;
// $projects = ProjectModel::select();

if (isset($_GET["api_id"])) {

    $fetchedRecord = Utils::api("Api", ["api_id" => $_GET["api_id"]]);
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


<form class="cmForm apiForm" id="jsApiForm" action="Api/Api.php?action=<?= $formAction ?>" method="post" data-form="apiFormSubmitDone">
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
        <textarea <?= $readOnly ?> class="cmInput" name="api_header" cols="30" rows="5" placeholder=" "><?= $record['api_header'] ?></textarea>
        <label class="cmInputLabel">Header</label>
    </div>



    <div class="bodyTypeContainer fullWidth">
        <label for="body_type">Body Type</label>
        <div class="bodyTypeOptions">
            <input <?= $readOnly ?> type="radio" value="FormData" name="api_body_type" <?= $record['api_body_type'] == "FormData" ? 'checked' : '' ?>>FormData
            &nbsp;
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

    <?php

    if (isset($_GET["action"]) && $_GET["action"] == "try") :
    ?>
        <button onclick="tryApi()" class="cmButton" type="button">Try</button>

    <?php elseif ($fetchedRecord == null) : ?>
        <button class="cmButton fullWidth" type="submit">Submit</button>
    <?php else : ?>
        <div class="buttonsContainer">
            <button class="cmButton" type="submit">Update</button>
            <button class="cmButton cmButtonSecondary" onclick="deleteRecord()" type="button">Delete</button>
        </div>
    <?php endif; ?>
    <div class="cmSpinnerContainer" data-form-loader>
        <div class="cmSpinner"></div>
    </div>


</form>

<script>
    function tryApi() {
        let url = $("[name=api_url]").val();
        let method = $("[name=api_method]").val();
        let headers= $("[name=api_header]").val();
        let body = $("[name=api_body]").val();
        let type = $("[name=api_body_type]:checked").val();
        let contentType="application/json";
        if (type == "FormData" && body!="") {
            body = JSON.parse(body);
            contentType=false;
        }
        if(headers!=""){
            headers=JSON.parse(headers);
        }
        $("[data-form-loader]").show();
        $.ajax({
            type: method,
            url: url,
            headers:headers,
            data: body,
            // contentType:contentType,
            // processData:false,
            success: function(response) {
                $("[name=api_response]").val(JSON.stringify(response, null, 2));
                $("[data-form-loader]").hide();

            },
            error: function(request, status, error) {
                alert(request.responseText);
                $("[data-form-loader]").hide();
            }
        });

    }

    function deleteRecord() {
        if (!confirm("Confirm Delete")) {
            return;
        }
        $.get("Api/Api.php?action=delete",
            function(data, textStatus, jqXHR) {
                data = JSON.parse(data);
                $(`#jsApi_${data.id}`).remove();
                $("#jsClosePopup").trigger("click");
                triggerFirstApi();
            },
        );
    }

    function apiFormSubmitDone(data) {
        if (data.status != "success") {
            return;
        }
        $.get(`Components/api.php?api_id=${data.id}`, function(html) {
            if (data.action == "update") {


                $(`#jsApi_${data.id}`).replaceWith(html);
                $(`#jsApi_${data.id}`).trigger("click");
                setTimeout(() => {
                    $("#jsClosePopup").trigger("click");

                }, 500);

            } else {
                $("#jsApiForm").trigger("reset");
                $("#jsApiList").prepend(html);

            }

        });

    }
</script>