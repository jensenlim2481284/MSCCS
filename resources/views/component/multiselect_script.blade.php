<script>




    // Initial multiselect
    function initMultiselect(key = "{{isset($key)?$key:null}}", non_selected_header= "{{isset($nonSelectedHeader)?$nonSelectedHeader:null}}" , selected_header = "{{isset($selectedHeader)?$selectedHeader:null}}") {

        $("#"+key+ "MultiselectSection").html('');
        var select = $("#" + key + "SelectTemplate").clone();
        $(select).attr('name',$(select).data('name'));
        $(select).attr('id',key);
        $("#"+ key + "MultiselectSection").append(select);

        multi(document.getElementById(key), {
            non_selected_header: non_selected_header,
            selected_header: selected_header,
            search_placeholder: "Search ..."
        });
    }

    // Function to insert multiselect data 
    function insertMultiselect(data, key = "{{isset($key)?$key:null}}", non_selected_header= "{{isset($nonSelectedHeader)?$nonSelectedHeader:null}}" , selected_header = "{{isset($selectedHeader)?$selectedHeader:null}}") {
        cleanMultiselect(false);
        $.each(data, function(index, value) {
            $("select[data-name='"+key+"[]'] option[value='" + value + "']").attr('selected', 'selected');
        })
        initMultiselect(key, non_selected_header, selected_header);
    }

    //Function to clear multiselect data 
    function cleanMultiselect(init = true, key = "{{isset($key)?$key:null}}", non_selected_header= "{{isset($nonSelectedHeader)?$nonSelectedHeader:null}}" , selected_header = "{{isset($selectedHeader)?$selectedHeader:null}}" ) {
        $("select[data-name='"+ key +"[]'] option").removeAttr('selected');
        if(init) initMultiselect(key, non_selected_header, selected_header);    
    }

</script>