<?php
if (!isset($_GET['project_id'])) {
    header("location: index.php");
}
session_start();
$_SESSION["project_id"] = $_GET['project_id'];
$showProjectCombo = true;
include_once "Template/nav.php";
?>

<div class="apiContainer">

    <div id="jsSidebar">
        <?php include_once "Template/sidebar.php"; ?>
    </div>


    <div id="jsApiInfo" class="apiInfo">

    </div>

</div>

<script>
    function triggerFirstApi() {
        let apis = $(".jsApi");
        if (apis.length > 0) {
            $(apis[0]).trigger("click");
        }
    }
    $(function() {

        triggerFirstApi();
        $("#jsClosePopup").on("mousedown", function(e) {
            e.preventDefault();
            load("#jsSidebar", "Template/sidebar.php?project_id=<?= $project['project_id'] ?>", () => {
                let selectedApiElement = sessionStorage.getItem("selectedApiElement");

                setTimeout(() => {

                    if ($(selectedApiElement).length) {
                        $(selectedApiElement).trigger("click");
                    } else {
                        triggerFirstApi();
                    }

                }, 200);
            });

        });
    });
</script>


<?php
include_once "Template/footer.php";
?>