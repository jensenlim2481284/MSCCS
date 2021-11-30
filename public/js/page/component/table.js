$(document).ready(function () {


    // Table datapicker plugin intiialization 
    if ($(".datepicker").length) {

        $('.datepicker').each(function(i, obj) {
            if(!$(obj).attr('readonly')){
                var setting = {};
                if($(obj).hasClass('minToday')) setting.minDate = "today";
                $(obj).flatpickr(setting);
            }
        });

    }

    // Table tooltip menu initialization 
    if ($(".menu-tooltip").length) {
        //Dropdown tooltip animation
        $(".menu-tooltip").tooltipster({
            animation: "fade",
            delay: 0,
            trigger: "click",
            contentCloning: true,
            arrow: true,
            side: 'left',
            interactive: true
        });
        $(document).on('click','.tooltip_menus button',function(e){
            $(".menu-tooltip").tooltipster('hide');
        });
        $(document).on('click','.tooltipstered, .menu-tooltip',function(e){
            e.stopPropagation();        
        });
    }


    // Toggle filter 
    $(document).on('click','.table-icon-item.filter-box',function(){
        $(this).toggleClass('active');
        $(".filter-form").slideToggle();
    })


    // Toggle list & box view 
   $(document).on('click','.table-icon-item.table-toggle',function(){
        $('.table-toggle').hide();
        var view = ($(this).data('view')=='grid')?'list':'grid';
        $(`div[data-view="${view}"]`).show().css('display', 'flex');
        toggleView($(this).data('view'));
    })

});


// Function to check and toggle table view - list or grid 
function toggleView(view){
    $('.table-responsive').slideUp(function(){
        $('.toggle-table-view').hide();
        $('.' + view + '-view-toggle').show();
        $('.table-responsive').slideDown();
    })
}
