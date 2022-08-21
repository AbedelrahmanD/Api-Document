<?php

include_once __DIR__ . "./../autoload_register.php";

if (isset($_GET["api_id"])) {
    $fetchedRecord = ApiModel::select(["api_id" => $_GET["api_id"]]);
    if ($fetchedRecord != null) {
        $record = $fetchedRecord[0];
    }
}
?>

<div class="cmForm apiForm">
    <div class="infoContainer fullWidth">
        <label>Title</label>
        <div>
            <?= $record['api_title'] ?>
        </div>


    </div>

    <div class="apiUrlContainer fullWidth">
        <div class="infoContainer ">
            <label>Method</label>
            <div>
                <?= $record['api_method'] ?>
            </div>
        </div>
        &nbsp;
        <div class="infoContainer fullWidth">
            <label>Url</label>
            <div>
                <?= $record['api_url'] ?>
            </div>
            <div class="copy" data-copy="<?= $record['api_url'] ?>">
                <span class="iconify" data-icon="akar-icons:copy"></span>
            </div>
        </div>
    </div>
    <?php if ($record['api_header'] != "") : ?>
        <div class="infoContainer fullWidth">
            <label>Header</label>
            <div>
                <?= $record['api_header'] ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="infoContainer fullWidth">
        <label>Body Type</label>
        <div>
            <?= $record['api_body_type'] ?>
        </div>
    </div>

    <div class="apiBodyResponseContainer fullWidth">
        <div class="infoContainer fullWidth">
            <label>Body</label>
            <div class="pre">
                <?= $record['api_body'] ?>
            </div>

        </div>
        &nbsp;
        <div class="infoContainer fullWidth">
            <label>Response</label>
            <div class="pre">
                <?= $record['api_response'] ?>
            </div>

        </div>

    </div>

</div>


<a class="apiEdit" data-popup data-popup-title="Edit Api " href="Template/update_api.php?api_id=<?= $_GET['api_id'] ?>">
    <span class="iconify" data-icon="fa-solid:pen"></span>
</a>