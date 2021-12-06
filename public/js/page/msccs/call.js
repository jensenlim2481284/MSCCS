$(document).ready(function(){

    
    // On click edit call
    $(document).on('click','.edit-call', function(){
        $.each($(this).data('value'), function(i,v){
            $("#editModal input[name='"+i+"']").val(v);
        })
    })


    // Check if got progress bar
    if($('.custom-progressbar').length) {
        
        // Progress bar animation  
        $('.custom-progressbar').each(function(i, obj) {
            var id = $(obj).attr('id');

            // Progress bar - Init
            if (id) {
                window[id + "ProgressBar"] = new ProgressBar.Line("#" + id, {
                    strokeWidth: 8,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#7678ed',
                    trailColor: '#eee',
                    trailWidth: 8,
                    svgStyle: {
                        width: '100%',
                        height: '100%',
                    },
                    from: {
                        color: '#FFEA82'
                    },
                    to: {
                        color: '#ED6A5A'
                    }
                });

                window[id + "ProgressBar"].animate(parseFloat($(obj).data('current') / $(obj).data('target')));
            }

        });

        // Real time retrieve ticket status 
        setInterval(() => {
            $.ajax({
                url: '/call/status/get',
                type: 'GET',
                data: {_token: CSRF_TOKEN},
                dataType: 'JSON',
                success: function (data) { 
                    $.each(data, function(i,e){
                        $('.stage-name', "#"+e.uid).html(e.stage);
                        $('.stage-percent', "#"+e.uid).html(e.percent + "%");
                        var id = $('.custom-progressbar', "#"+e.uid).attr('id');
                        window[id + "ProgressBar"].animate(parseFloat( e.percent / 100));

                        if(e.percent == 100){
                            $('.badge', "#"+e.uid).attr('class', 'badge badge-2').html('Completed');
                            $('.call-title', "#"+e.uid).html(e.title);
                            $('.call-desc', "#"+e.uid).html(e.description);
                            $('.call-location',  "#"+e.uid).html(e.location);
                        }
                    })
                }
            }); 
        }, 4000); 
    }



})