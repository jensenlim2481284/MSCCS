

<script>

// Global variable
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var toastCheck = false;

$(document).ready(function(){

    // Set Equal Height
    setEqualHeight();

    // Backend  notification 
    @if(isset($errors))
        @if($errors->any())
            swal('', "{{$errors->all()[0]}}", 'warning')
        @elseif(Session::has('err'))
            swal('', "{{Session::get('err')}}", 'warning');
        @elseif(Session::has('info'))
            swal('', "{{Session::get('info')}}", 'info');
        @elseif($errors->has('email') || $errors->has('password'))
            swal('', "Incorrect username or password", 'warning');
        @endif
    @endif
    @if(Session::has('success'))
        swal('', "{{Session::get('success')}}", 'success');
    @endif


    // Under development message handling 
    $(document).on('click',".under-development", function() {
        underDevelopment($(this).data('title'), $(this).data('desc'));
    });


    // Toast List 
    var toastList = [];      
    @if(Session::has('message') || isset($message))        
        @if(Session::has('message'))     
            @php($message = Session::get('message'))  
        @endif
        var avatar = "{{(isset($message['avatar']))?$message['avatar']:null}}";
        var title = "{{(isset($message['title']))?$message['title']:null}}";
        var description = "{{(isset($message['description']))?$message['description']:null}}";       
        toastList.push([title, description, avatar]);    
    @endif

});


// Custom toast message popup
function toast(title = null, description = null, avatar =null, displayTime=500, displayDuration = 3000, type = null, currentValue = null, targetValue = null)
{
    toastCheck=true;
    var uid = new Date().valueOf()  + Math.floor(Math.random() * 10000); ;      
    var text = '<div>';
    if(title) text+=` <span class='title'>${title}</span>`;
    if(type=='progress') text+=`<div class='custom-progressbar' id='toastProgress'></div>`;
    if(type=='point') text+=`<div class='custom-point-count'><span class='counting' id='counting${uid}' data-current='${currentValue}'>${targetValue}</span> <img src='/img/icon/pt.png'/> </div>`;
    if(description) text+=description;
    if(!avatar) avatar = "/img/icon/info.png";
    text+='</div>'; 

    var myToast = Toastify({
        text:  text,     
        duration: displayDuration,
        avatar: avatar,
        position: 'right',      
    })
    setTimeout(() => {
        myToast.showToast();    
       
        if(type == 'point')
        {                          
            $("#counting"+uid).prop('Counter',$("#counting"+uid).data('current')).animate({
                Counter: $("#counting"+uid).text()
            }, {
                duration: displayDuration - 1000,                
                step: function (now) {
                    $("#counting"+uid).text(Math.ceil(now));
                }
            });            
        }      
        if(type == 'progress')
        {                          
            progressbar = new ProgressBar.Line(toastProgress,{
                strokeWidth: 4,
                easing: 'easeInOut',
                duration:  displayDuration - 1000,
                color: '#7678ed',
                trailColor: '#eee',
                trailWidth: 4,
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
            
            progressbar.animate(parseFloat(currentValue/targetValue));               
        }      
        
    }, displayTime);    
    
    setTimeout(function(){
        toastCheck
    }, displayDuration);
}


// Function to set equal height 
function setEqualHeight(){
    if($('.equal-height').length){
        $.each($('.equal-height'), function(i,obj){
            $(obj).css('height',$(obj).width() + "px");
        })
    }
}
 

 // Function for under development modal notice
 function underDevelopment(title, description){
     $("#comingTitle").html(title);
     $("#comingDesc").html(description);
     $("#whatNextModal").modal('show');
 }




</script>