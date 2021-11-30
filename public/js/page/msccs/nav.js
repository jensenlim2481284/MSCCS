(function ($) {

	"use strict";

	var fullHeight = function () {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function () {
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
		if(!$("#sidebar").hasClass('active'))
			$('#sidebar').removeClass('expand');
		else 
			$("#sidebar").addClass('expand');
	});


	//On hover menu icon 
	$(document).on('mouseover', '.menu-icon', function () {
        $(this).delay(200).queue(function(){
            var help = $(this).find('.help-icon');
            $(".guideline-img").attr('src',$(help).attr('help-img'));
            $(".guideline-title").html($(help).attr('help-title'));
            $(".guideline-desc").html($(help).attr('help-desc'));
            
            if(help.attr('help-title'))
            {
                setTimeout(function(){
                    $(".guideline-panel").addClass("active"); 
                },200);
            }             
        });

	})
	$(document).on('mouseout', '.menu-icon', function () {
	
        if($(".guideline-panel").hasClass('active'))
            $(".guideline-panel").removeClass("active");
        else 
        {
            $(this).finish();
            setTimeout(function(){
                $(".guideline-panel").removeClass("active");
            },300);
        }
	})

    
})(jQuery);
