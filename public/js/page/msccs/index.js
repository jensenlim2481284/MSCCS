$(document).ready(function() {


    //Nicescroll
    $("#main-menu").niceScroll({
        cursorwidth: "0px",
        cursorborder: "none",
        cursorborderradius: "0px"
    });


    // to display tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


    //Profile toggle
    $(document).on('click','#topProfileIcon, .profile-overlay',function(){
        $('.topnav-profile').toggleClass('toggle');
        $('.profile-overlay').toggleClass('toggle');
        $('#topProfileIcon').toggleClass('toggle');
    })




});
