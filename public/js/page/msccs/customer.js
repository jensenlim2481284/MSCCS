

$(document).ready(function(){


    // On click add customer
    $(document).on('click','.add-customer', function(){
        $("#addModal .modal-title").html('Add Customer');
        $("#addModal .submit-btn").html('Create');
        $("input[name='uid']").val('');
    })

    // On click bind call record
    $(document).on('click','.bind-btn', function(){
        cleanMultiselect();
        $("input[name='uid']").val($(this).data('uid'));
    })

    // On click edit customer
    $(document).on('click','.edit-customer', function(){
        $("#addModal .modal-title").html('Edit Customer');
        $("#addModal .submit-btn").html('Edit');
        $.each($(this).data('value'), function(i,v){
            $("#addModal input[name='"+i+"']").val(v);
        })
    })


})

