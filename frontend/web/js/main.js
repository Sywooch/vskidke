$(document).ready(function () {
    $("#fileID").change(function(){
        readURL(this);
    });

    $("#title").blur(function(){
        var title = $("#title").val();
        $("#previewTitle").text(title);
    });

    $("#register").click(function () {
        $.get('index.php?r=/site/signup', function (data) {
            $(".modal-container").html(data);
            $("#registration-modal").modal('show');
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