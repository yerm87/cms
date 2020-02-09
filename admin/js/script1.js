$(document).ready(function(){
    $("#selectAllBoxes").click(function(){
        if(this.checked){
            $(".checkBoxes").each(function(){
                this.checked = true;
            })
        } else {
            $(".checkBoxes").each(function(){
                this.checked = false;
            })
        }
    })
    var element = '<div id="load-screen"><div id="loading"></div></div>'
    $("body").prepend(element);
    
    $("#load-screen").delay(700).fadeOut(500, function(){
        $(this).remove()
    })

    $.get("functions.php?usersonline=result", function(data){
        console.log(data);
    })
})