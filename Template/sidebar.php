<?php

if (!isset($_GET["project_id"])) {
    header("location: index.php");
}

include_once __DIR__."./../autoload_register.php";
$project = ProjectModel::select(["project_id" => $_GET["project_id"]])[0];
$apis = ApiModel::select(["project_id" => $_GET["project_id"]]);
$_SESSION["project_id"]=$project["project_id"];
?>

<aside class="apiList">


    <div class="searchApi">
        <a data-popup data-popup-title="Add Api For <?= $project['project_title'] ?>" class="projectAdd" href="Template/add_api.php?project_id=<?= $project['project_id'] ?>">
            <span class="iconify" data-icon="carbon:add"></span>
        </a>
        <div class="cmInputContainer">
            <input type="text" id="jsSearchApi" class="cmInput" placeholder=" ">
            <label class="cmInputLabel">Search...</label>
        </div>

    </div>

    <?php
    foreach ($apis as $api) :
    ?>
        <div class="jsApi api" data-api_id='<?= $api['api_id'] ?>'>
            <span class="iconify" data-icon="ic:baseline-api"></span>
            <span class="jsApiTitle"><?= $api['api_title'] ?></span>
        </div>
    <?php
    endforeach;
    ?>

</aside>
<script>

    $(function() {
        $(".jsApi").click(function(e) {
            e.preventDefault();
            let apiId = $(this).attr("data-api_id");
            load("#jsApiInfo", `Template/api_info.php?api_id=${apiId}&isReadOnly=true`);
            $(`.jsApi`).removeClass("apSelected");
            $(`[data-api_id=${apiId}]`).addClass("apSelected");
            sessionStorage.setItem("selectedApiElement",`[data-api_id=${apiId}]`);
        });


        $("#jsSearchApi").on("input", function() {
            let searchValue = $(this).val().trim();
            if (searchValue == "") {
                $(".jsApi").fadeIn();
                return;
            }
            $.each($(".jsApi"), function(index, element) {
                let apiTitle = $(element).find(".jsApiTitle").html().toLowerCase();
                if (apiTitle.includes(searchValue)) {
                    $(element).fadeIn();
                } else {
                    $(element).hide();
                }

            });
        })


    })
</script>