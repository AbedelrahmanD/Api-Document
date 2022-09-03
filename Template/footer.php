<div id="jsPopup" class="popup popupHide">
    <div id="jsPopupHeader" class="popupHeader">
        <div id="jsClosePopup" class="closePopup">
            <span class="iconify" data-icon="eva:arrow-back-outline"></span>
        </div>
        <div id="jsPopupTitle" class="popupTitle">

        </div>
    </div>
    <div id="jsPopupBody" class="popupBody"></div>
</div>


<script>
    function initLibraries() {
        initDataForm();
        $('select').select2();
        $(".projectSelect").css("display", "flex");
    }

    function load(target, url, callBack = null) {
         $(target).html("");
        $(target).load(url, function () {
            initLibraries();
            if (callBack != null) {
                callBack();
            }
        });

    }
    $(function () {
        initLibraries();
        $(document).on('click', "[data-copy]", function (event) {
            let input = document.createElement("input");
            input.value = $(this).attr("data-copy");
            input.id = "jsCopy";
            $("body").append(input);
            var copyText = document.getElementById("jsCopy");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand('copy');
//            navigator.clipboard.writeText(copyText.value);
            $("#jsCopy").remove();
        });

        $(document).on('keydown', function (event) {
            if (event.key == "Escape") {
                $("#jsClosePopup").trigger("mousedown").trigger("click");
            }
        });
        $("#jsClosePopup").click(function (e) {
            e.preventDefault();
            $("#jsPopup").addClass("popupHide");

        });
        $(document).on("click", "[data-popup]", function (e) {
            e.preventDefault();
            let link = $(this).attr("href");
            let title = $(this).attr("data-popup-title");
            $("#jsPopup").removeClass("popupHide");
            $("#jsPopupTitle").text(title);

            load("#jsPopupBody", link);

        });
    });
</script>
</body>

</html>