<?php

include_once __DIR__."./../autoload_register.php";


$projects = ProjectModel::select();
?>

<div class="searchProject">
    <a data-popup data-popup-title="Add Project" class="projectAdd" href="Template/add_project.php">
        <span class="iconify" data-icon="carbon:add"></span>
    </a>
    <div class="cmInputContainer">
        <input type="text" id="jsSearchProject" class="cmInput" placeholder=" ">
        <label class="cmInputLabel">Search...</label>
    </div>

</div>


<div class="projectGrid">
    <?php foreach ($projects as $project) : ?>
        <div class="jsProjectContainer projectContainer">
            <a class="projectInfo" href="api_list.php?project_id=<?= $project['project_id'] ?>">
                <span class="iconify" data-icon="academicons:ideas-repec"></span>
                <h3 class="jsProjectTitle">
                    <?= $project['project_title'] ?>
                </h3>
                <p>
                    <?= $project['project_description'] ?>
                </p>
            </a>

            <a class="projectEdit" data-popup data-popup-title="Edit <?=$project['project_title']?>" href="Template/update_project.php?project_id=<?= $project['project_id'] ?>">
                <span class="iconify" data-icon="fa-solid:pen"></span>
            </a>
        </div>

    <?php endforeach; ?>
</div>



<script>
    $(function() {



        $("#jsSearchProject").on("input", function() {
            let searchValue = $(this).val().trim();
            if (searchValue == "") {
                $(".jsProjectContainer").fadeIn();
                return;
            }
            $.each($(".jsProjectContainer"), function(index, element) {
                let apiTitle = $(element).find(".jsProjectTitle").html().toLowerCase();
                if (apiTitle.includes(searchValue)) {
                    $(element).fadeIn();
                } else {
                    $(element).hide();
                }

            });
        })
    });
</script>