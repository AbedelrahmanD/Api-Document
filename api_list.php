<?php
$showProjectCombo = true;
include_once "Components/nav.php";
if (!isset($_GET['project_id'])) {
    header("location: index.php");
}
session_start();
$project = Utils::api("Project", ["project_id" => $_GET["project_id"]])[0];
$apis = Utils::api("Api", ["project_id" => $_GET["project_id"]]);
$_SESSION["project_id"] = $project["project_id"];

?>

<div class="apiContainer contentcontainer">
        <div class="apiList">
            <div class="searchApi">
                <a data-popup data-popup-title="Add Api For <?= $project['project_title'] ?>" class="projectAdd" href="Components/add_api.php?project_id=<?= $project['project_id'] ?>">
                    <span class="iconify" data-icon="carbon:add"></span>
                </a>
                <div class="cmInputContainer">
                    <input type="text" id="jsSearchApi" class="cmInput" placeholder=" ">
                    <label class="cmInputLabel">Search...</label>
                </div>

            </div>

            <div id="jsApiList">
                <?php
                foreach ($apis as $api) {
                    include "Components/api.php";
                }
                ?>
            </div>
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

        $(document).on("click", ".jsApi", function(e) {
            e.preventDefault();
            let apiId = $(this).attr("data-api_id");
            $("#jsApiInfo").load(`Components/api_info.php?api_id=${apiId}&isReadOnly=true`, function(response, status, request) {

            });

            $(`.jsApi`).removeClass("apSelected");
            $(`[data-api_id=${apiId}]`).addClass("apSelected");


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




        triggerFirstApi();

    });
</script>


<?php
include_once "Components/footer.php";
?>