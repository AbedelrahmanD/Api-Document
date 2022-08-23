<?php


if (isset($_GET["project_id"])) {

    include_once __DIR__ . "./../autoload_register.php";
    $project = Utils::api("Project", ["project_id" => $_GET["project_id"]])[0];
}
?>

<div id="jsProject_<?=$project["project_id"]?>" class="jsProjectContainer projectContainer"
title=" <?= $project['project_description'] ?>"
>
    <a class="projectInfo" href="api_list.php?project_id=<?= $project['project_id'] ?>">
        <span class="iconify" data-icon="academicons:ideas-repec"></span>
        <h3 class="jsProjectTitle">
            <?= $project['project_title'] ?>
        </h3>
        <p>
            <?= $project['project_description'] ?>
        </p>
    </a>

    <a class="projectEdit" data-project_id=<?= $project["project_id"] ?> data-popup data-popup-title="Edit <?= $project['project_title'] ?>" href="Template/update_project.php?project_id=<?= $project['project_id'] ?>">
        <span class="iconify" data-icon="fa-solid:pen"></span>
    </a>
</div>