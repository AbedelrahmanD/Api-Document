<?php

include_once "header.php";
include_once __DIR__ . "./../autoload_register.php";




?>
<div class="nav">
    <a class="navLogo" href="index.php">
        <span>API</span>
        <span>Document</span>
    </a>
    <?php if ($showProjectCombo) {
        $projects = Utils::api("Project");
    ?>
        <div class="projectSelect">
            <select id="jsProjectId">
                <?php foreach ($projects as $project) : ?>
                    <option <?= $project['project_id'] == $_GET['project_id'] ? 'selected' : '' ?> value="<?= $project['project_id'] ?>"><?= $project['project_title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php } ?>
</div>

<script>
    $(function() {
        $("#jsProjectId").change(function(e) {
            e.preventDefault();
            let selectedProjectId = $(this).val();
            let url = new URL(window.location.href);
            url.searchParams.set("project_id", selectedProjectId);
            window.location.href = url;

        });
    });
</script>