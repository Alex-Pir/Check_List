$(document).ready(function() {
    $('input[type="checkbox"]').click(function(){
        var name= $(this).attr('name');
        $.ajax({
            type: "POST",
            url: "/handler/",
            data: {START_CHECK: $('form').serialize()},
            error: function()
            {
                alert('Ошибка при сохранении!');
            }
        });
    });
});