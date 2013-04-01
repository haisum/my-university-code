$(document).ready(function(){
    var pageName = $('#pageName').val();
    $('#'+pageName).addClass('active_'+pageName);
    $(".main-menu li a").bind("mouseover", function(){
        $(this).parent().addClass("hover_" + $(this).attr("id"));
    }).bind("mouseout", function(){
        $(this).parent().removeClass("hover_" + $(this).attr("id"));
    });
    $(".expand a").bind("click", function(){
        switch($(this).children("img.state-word").attr("alt")){
            case "more":
                $(this).children("img.state-word").attr("alt", "less").attr("src", "images/less.gif");
                $(this).children("img.state-sign").attr("alt", "collapse").attr("src", "images/minus.gif");
                $("#moreLikes").slideDown("slow", function(){
                    $(window.opera?'html':'html, body').animate({
                        scrollTop: $('.footer').offset().top
                    }, 2000);
                });
				
                break;
            case "less":
                $(this).children("img.state-word").attr("alt", "more").attr("src", "images/more.gif");
                $(this).children("img.state-sign").attr("alt", "expand").attr("src", "images/plus.gif");
                $("#moreLikes").slideUp("slow");
                break;
        }
    });
    $(".info>a").bind('click', function(){
        $(this).parent().next('.info-box').slideToggle('10000');
    });
     $("#submit").click(function(){
        $(".error").hide();
        var hasError = false;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var phoneVal = $("#phone").val();
        var nameVal = $("#name").val();
        if(nameVal == '') {
            $("#name").after('<span class="error">Name can\'t be empty.</span>');
            hasError = true;
        }
        else if(nameVal.length < 3) {
            $("#name").after('<span class="error">Name can\'t contain less than 3 charachters.</span>');
            hasError = true;
        }
        var emailVal = $("#email").val();
        if(emailVal == '') {
            $("#email").after('<span class="error">Email can\'t be empty.</span>');
            hasError = true;
        } else if(!emailReg.test(emailVal)) {
            $("#email").after('<span class="error">Invalid email address.</span>');
            hasError = true;
        }

        var mesVal = $("#mes").val();
        if(mesVal == '') {
            $("#mes").after('<span class="error">Did you forget to put message?</span>');
            hasError = true;
        }


        if(hasError == false) {
            $(this).hide();
            $("#submit").after('<img src="images/loading.gif" alt="Loading" id="loading" />');
            $.post("sendemail.php",
                { name: nameVal, email: emailVal, phone: phoneVal, message: mesVal },
                    function(data){
                        $("#sendEmail").slideUp("20000", function() {
                            $("#sendEmail").before('<h3>Thank you</h3><br />' + data );
                            $("#loading").remove();
                        });
                    }
                 );
        }

        return false;
    });
});
