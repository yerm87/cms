$(document).ready(function(){

    function loadUsersOnline(){
        $.get("functions.php?usersonline=result", function(data){
            $(".user-online").text(data);
        })
    }

    setInterval(function(){
        loadUsersOnline();
    }, 500);
})