

// Function to copy to clipboard
function copyClip(id) {
    var copyText = document.getElementById(id);
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
    swal("" , "Embed code copied " ,"success");
}
