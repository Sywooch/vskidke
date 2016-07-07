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
            $(this).fadeOut(150);
            //$('body').removeClass('modal-open');
        }
    });

    $( "body" ).on('click', '.close', function() {
        $(this).parents('.modal-layout-wrapp').fadeOut(150);
        //$('body').removeClass('modal-open');

    });

     $( "body" ).on('click', '.address-modal-link', function() {
         $("#address-modal").fadeIn(300);
         popupAlign($('#address-modal .modal-layout'));
    });

    $("#register").on('click', function () {
        $.get('/site/kiev/signup', function (data) {
            $(".modal-container").html(data);
            $(".mask, #registration-modal").fadeIn(300);
            popupAlign($('body').find('#registration-modal .modal-layout'));
        })
    });

    $("#login").on('click', function () {
        $.get('/site/kiev/login', function (data) {
            $(".modal-container").html(data);
            $(".mask, #login-modal").fadeIn(300);
            popupAlign($('body').find('#login-modal .modal-layout'));
        })
    });

    $(".edit").on('click', function (event) {
        event.preventDefault();
        $("#companyForm").ajaxForm({
            url: '/company/kiev/index',
            success: function (data) {
                return true
            }
        }).submit(); 
    });

     $("body").on('click', "#forgot-password", function (event) {
         event.preventDefault();
         $("#request-password-reset-form").ajaxForm({
             url: '/site/kiev/password-reset-request',
             success: function (data) {
                 return true
             }
         }).submit();
     });

     $("body").on('click', "#loginSubmit", function (event) {
         event.preventDefault();
         $("#login-form").ajaxForm({
             url: '/site/kiev/login',
             success: function (data) {
                 return true
             }
         }).submit();
     });

     $('#citySwitch').change(function () {
         var link = $('option:selected', this).val();

         $.ajax({
             type: "POST",
             url: '/site/kiev/index',
             data: {city: link, _csrf: $("input[name='_csrf']").val()},
             success: function (data) {
                 window.location.href = '/' + link;
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
         $('#collapse-menu').toggleClass('menu-open').animate({width:'toggle'},350);
         e.preventDefault();
     });

     $('#toggle-header-dropdown').on('click', function (e) {
         $('#header-dropdown-menu').slideToggle(350);
         e.preventDefault();
     });


     //Close menu
     $('#login, #register').on('click', function (e) {
         if( $(document).width() < 768 ){
             $('#collapse-menu').slideUp('fast');
         }
     });

     //Search modal
     $( ".search-modal-link" ).click(function() {
         $(" .mask ,  #search-modal").fadeIn(300);
         popupAlign($('#search-modal .modal-layout'));

     });
    //Forgot pass
     $( ".forgot-modal-link" ).click(function() {
         $(" .mask ,  #search-modal").fadeIn(300);
         popupAlign($('#forgot-modal .modal-layout'));
     });

     $(".modal-container").on('click', '#register', function () {
         $.get('/site/kiev/signup', function (data) {
             $(".modal-container").html(data);
             $("#login-modal").fadeOut(150);
             $("#registration-modal").fadeIn(150);
         })
     });

     $(".modal-container").on('click', '#password', function () {
         $.get('/site/kiev/password-reset-request', function (data) {
             $(".modal-container").html(data);
             $("#login-modal").fadeOut(150);
             $("#forgot-modal").fadeIn(150);
         })
     });

     $('#limit-page').on('change', function () {
         var url = $(this).val(); // get selected value
         if (url) { // require a URL
             window.location = url; // redirect
         }
         return false;
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
             $(".mask, #info-modal").fadeIn(300);
             popupAlign($('#info-modal .modal-layout'));
         })
     }
 }

 function popupAlign(param) {
     var $popup = param,
         popupWidth = $popup.outerWidth(),
         popupHeight = $popup.outerHeight();
     console.log(popupHeight);
     $popup.css({
         'margin-top': -1*popupHeight/2,
         'margin-left': -1*popupWidth/2
     })
 }