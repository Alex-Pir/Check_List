$(document).ready(function() {
   $(".show-more").click(function() {
       $(this).parent(".list-top").next(".list-bottom").toggle();
   });

    $(".exit-link").click(function () {
        $.ajax({
            url: 'handler/logouthandler.php',
            type: 'POST',
            data: { action: 'logout' },
            success: function(){
                location.href = '/';
            }
        });
        
    })
});