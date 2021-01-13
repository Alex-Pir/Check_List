$(document).ready(function() {
    $('input[type="checkbox"]').click(function(){
        var name= $(this).attr('name');
        $.ajax({
            type: "POST",
            url: "handler/checkboxhandler.php",
            data: {tehnCheck: $('form').serialize()},
            error: function()
            {
                alert('Ошибка при сохранении!');
            }
        });
    });
});