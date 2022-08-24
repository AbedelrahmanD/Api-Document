<?php
$showProjectCombo = false;
include_once "Components/nav.php";
$projects = Utils::api("Project");
?>
<div id="jsProjects" class="contentcontainer">
    <div class="searchProject">
        <a data-popup data-popup-title="Add Project" class="projectAdd" href="Components/add_project.php">
            <span class="iconify" data-icon="carbon:add"></span>
        </a>
        <div class="cmInputContainer">
            <input type="text" id="jsSearchProject" class="cmInput" placeholder=" ">
            <label class="cmInputLabel">Search...</label>
        </div>

    </div>

    


    <div id="jsProjectGrid" class="projectGrid">
        <?php
        foreach ($projects as $project) {
            include "Components/project.php";
        }

        ?>
    </div>



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
<?php
include_once "Components/footer.php";
?>