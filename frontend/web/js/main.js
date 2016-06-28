 $(document).ready(function () {
     discountCreateError();
     flashMessages();

    $("#fileID").change(function(){
        readURL(this);
    });

    $("#title").blur(function(){
        var title = $("#title").val();
        $("#previewTitle").text(title);
    });

     $("#percent").blur(function(){
         var percent = $("#percent").val();
         $("#previewPercent").text('-' + percent + '%');
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

     $( "body" ).on('click', '.address-modal-link', function() {
        $('#address-modal').show();
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

    $(".edit").on('click', function (event) {
        event.preventDefault();
        $("#companyForm").ajaxForm({
            url: 'index.php?r=company/index',
            success: function (data) {
                return true
            }
        }).submit();
    });

     $('#citySwitch').change(function () {
         var link = $('option:selected', this).val();

         $.ajax({
             type: "POST",
             url: 'index.php?r=site/index',
             data: {city: link, _csrf: $("input[name='_csrf']").val()},
             success: function (data) {
                 var str    = window.location.href;
                 var params = str.split('?')[1];
                 var param  = params.split('&');

                 window.location.href = 'index.php?' + param[0] + '&city=' + data
             }
         });
     });

     //disabled
     $('body').on('click', '.disabled', function(e) {
         e.preventDefault();
         $(this).find('input').attr('disabled', true);
         return false
     });

     //==Navbar

     //open menu
     $('#toggle-menu').on('click', function (e) {
         $('#collapse-menu').slideToggle('fast');
         e.preventDefault();
     });


     //Close menu
     $('#login, #register').on('click', function (e) {
         if( $(document).width() < 768 ){
             $('#collapse-menu').slideUp('fast');
         }
     });


 });

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah, #preview').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

 function flashMessages() {
     if($("#message")) {
         $(".mask, #flash-modal").show();
         // $('body').addClass('modal-open');
     }
 }

 function discountCreateError() {
     if($("#error")) {
         $("#error").on('click', function (event) {
             event.preventDefault();
             $(".mask, #info-modal").show();
             $('body').addClass('modal-open');
         })
     }
 }