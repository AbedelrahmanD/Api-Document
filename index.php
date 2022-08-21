<?php
$showProjectCombo=false;
include_once "Template/nav.php";
?>
<div id="jsProjects">
    <?php include_once "Template/projects.php"; ?>
</div>

<?php
include_once "Template/footer.php";


?>

<script>
    $(function() {
        $("#jsClosePopup").on("mousedown", function(e) {
            e.preventDefault();
            load("#jsProjects", "Template/projects.php");
        });
    });
</script>