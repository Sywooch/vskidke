$(document).ready(function () {
    $("#fileID").change(function(){
        readURL(this);
    });

    $("#title").blur(function(){
        var title = $("#title").val();
        $("#previewTitle").text(title);
    });

    $( "body" ).on('click', '.modal-layout-wrapp', function(e) {
        if (e.target === this) {
            $(this).hide();
            $('body').removeClass('modal-open');
        }
    });

    $( "body" ).on('click', '.close', function() {
        $(this).parents('.modal-layout-wrapp').hide();
        $('body').removeClass('modal-open');

    });

    $("#register").on('click', function () {
        $.get('index.php?r=/site/signup', function (data) {
            $(".modal-container").html(data);
            $(".mask, #registration-modal").show();
            $('body').addClass('modal-open');
        })
    });

    $("#login").on('click', function () {
        $.get('index.php?r=/site/login', function (data) {
            $(".modal-container").html(data);
            $(".mask, #login-modal").show();
            $('body').addClass('modal-open');
        })
    });
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah, #preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}