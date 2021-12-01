$(document).ready(function(){

    
    // On click edit call
    $(document).on('click','.edit-call', function(){
        $.each($(this).data('value'), function(i,v){
            $("#editModal input[name='"+i+"']").val(v);
        })
    })


})