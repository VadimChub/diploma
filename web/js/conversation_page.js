$(document).ready(function () {
   $('.conversation').scrollTop($('.conversation').height());

    $("#new_message").on("pjax:end", function() {
        $.pjax.reload({container:"#messages"});//Reload conversation block
    });

    setInterval(function(){ $.pjax.reload({container : '#messages'}); $('.conversation').scrollTop($('.conversation').height()); }, 3000);
});