
//Function to show loader
function showLoader() {
    $(".page-loader").fadeIn(300);
}

//Function to hide Loader
function hideLoader() {
    $(".page-loader").fadeOut();
}

//Page loader
window.onload=function() { hideLoader(); }

$(document).ready(function() {

    // Set CSRF Token variation
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

    // Hide loader 
    hideLoader();
    setTimeout(function() {
        hideLoader();
    }, 1000);

    //Onsubmit form - auto show loader - UX
    $("form").submit(function() {
        if (!$(this).hasClass("hide-form")) showLoader();
    });

    //If hide-form class is added will not show loader onsumbit
    $(".hide-form").submit(function() {
        hideLoader();
    });


    //loader button
    $(document).on("click", "a", function() {
        if (
            $(this).attr("href") != null &&
            !$(this).attr("href").includes("#") 
        ) {
            showLoader();
            if($(this).attr('target') !== "_blank")
                window.location.href = $(this).attr("href");
        }
    });
    $(document).on("click", '.no-loader, a[target="_blank"]', function() {
        setTimeout(function() {
            hideLoader();
        }, 200);
    });


    //Action button  : Global action modal
    $(document).on("click", ".action-btn", function() {
        var target = $(this).attr("target-id").split("||");
        var targetVal = $(this).attr("value").split("||");
        $("#actionForm").attr('action',$(this).attr('data-route'));
        $.each(target, function(index, value) {
            $("#" + value).val(targetVal[index]);
        });
    });


});
