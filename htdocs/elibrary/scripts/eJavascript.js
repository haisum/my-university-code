var base_url = "";
$(document).ready(function(){
    $("#loading").css('z-index', '4000').bind('ajaxStart',
                       function (){
                           $(this).fadeIn();
                       } );
    $("#loading").bind('ajaxComplete',
                       function (){
                           $(this).fadeOut(2000);
                       } );
    $("#searchBox").focus();
    $("#About").colorbox();
    $("#upload").colorbox({
        width:"450px",
        height:"490px",
        iframe : true
    });
	$("#register").colorbox({
        });
        $("#login").colorbox({
            'height':'270px'
        });
    $(".linkAd a").colorbox();
});
function goHome(){
    $("#homeLink").removeClass('links').addClass('active');
    $("#books").css('display', 'none');
    $("#categories , #publishers").fadeIn();
}
function search(query)
{
    query = trim(query," ");
    if(query == "")
        {
            return;
        }

    $("#categories , #publishers").css('display', 'none');
    $("#homeLink").removeClass('active').addClass('links');
    $.ajax(
            {
                'url': base_url + '/index.php/results/search',
                'type': 'POST',
                'data' : {'query' : query},
                'dataType': 'html',
                'success': function (data) {
                    $("#books").html(data);
                    //
                    if($("table#quicksearch tr td").size() >1) {
                    $("table#quicksearch").dataTable( {
					"sPaginationType": "full_numbers"
				} );
                    }
                    $("table#quicksearch thead th").removeAttr('style');
                    $("#quicksearch_filter input").attr('placeholder' , 'Filter Results');
                    $("table#quicksearch thead th").css({'vertical-align': 'middle', 'text-align' : 'left'});
                    $("#books").fadeIn();
                    $("#quicksearch_filter input").focus();
                    $("table#quicksearch tbody tr td a").css({'text-decoration' : 'none' });
                    
                    $(".bookURL").colorbox();
                },

                'error' : function ()
                {
                    $("#books").html("An error occured in retrieving data...").fadeIn();
                },
                'beforeSend' : function()
                {
                    $("#books").css('display', 'none');
                }

            }
            );
}
function category(id, name)
{
    $("#categories , #publishers").css('display', 'none');
    $("#homeLink").removeClass('active').addClass('links');
    $.ajax(
            {
                'url': base_url + '/index.php/results/category',
                'type': 'POST',
                'data' : {'category_id' : id, 'category_name' : name},
                'dataType': 'html',
                'success': function (data) {
                 $("#books").html(data);
                 if($("table#quicksearch tr td").size() >1) {
                    $("table#quicksearch").dataTable( {
					"sPaginationType": "full_numbers"
				} );
                    }
                 $("table#quicksearch thead th").removeAttr('style');
                    $("#quicksearch_filter input").attr('placeholder' , 'Filter');
                    $("table#quicksearch thead th").css('vertical-align', 'middle');
                    $("#books").fadeIn();
                    $("#quicksearch_filter input").focus();
                    $("table#quicksearch tbody tr td a").css({'text-decoration' : 'none' });
                 $(".bookURL").colorbox();
                },

                'error' : function ()
                {
                    $("#books").html("An error occured in retrieving data...").fadeIn();
                },
                'beforeSend' : function()
                {
                    $("#books").css('display', 'none');
                }

            }
            );
}
function publisher(id, name)
{
    $("#categories , #publishers").css('display', 'none');
    $("#homeLink").removeClass('active').addClass('links');
    $.ajax(
            {
                'url': base_url + '/index.php/results/publisher',
                'type': 'POST',
                'data' : {'publisher_id' : id, 'publisher_name' : name},
                'dataType': 'html',
                'success': function (data) {
                    $("#books").html(data);
                    if($("table#quicksearch tr td").size() >1) {
                    $("table#quicksearch").dataTable( {
					"sPaginationType": "full_numbers"
				} );
                    }
                    $("table#quicksearch thead th").removeAttr('style');
                    $("#quicksearch_filter input").attr('placeholder' , 'Filter');
                    $("table#quicksearch thead th").css('vertical-align', 'middle');
                    $("#books").fadeIn();
                    $("#quicksearch_filter input").focus();
                    $("table#quicksearch tbody tr td a").css({'text-decoration' : 'none'});
                    $(".bookURL").colorbox();
                },

                'error' : function ()
                {
                    $("#books").html("An error occured in retrieving data...").fadeIn();
                },
                'beforeSend' : function()
                {
                    $("#books").css('display', 'none');
                }

            }
            );
}
function set_base_url(url)
{
    base_url = url;
}
function register(){
    if(trim($("#user_name").val(), " ") == ""){
       $("#user_name").css('background-color', '#FFCFCF');
    }
    else if(trim($("#user_roll_no").val(), " ")== "")
        {
            $("#user_roll_no").css('background-color', '#FFCFCF');
        }
    else if($("#user_password").val() == "")
        {
            $("#user_password").css('background-color', '#FFCFCF');
        }
    else
    {
        $.ajax({
            'url' : base_url + '/index.php/register/insertdata',
            'type' : 'POST',
            'data' : {'user_name' : $("#user_name").val() , 'user_roll_no' : $("#user_roll_no").val(), 'user_password' : $("#user_password").val(), 'user_department_id' : $("#user_department option:selected").val()},
            'dataType' : 'html',
            'success' : function(data)
            {
                $(".formInput").html(data);
                window.setTimeout(function() {
                    $.colorbox.close();
                 }, 2000);
               
            },
            'error' : function(data)
            {
                $(".formInput").html("Oops an error occured." + data);
            }
        })
    }
}

function login(){
    if(trim($("#login_user_password").val(), " " ) == ""){
       $("#login_user_password").css('background-color', '#FFCFCF');
    }
    else if(trim($("#login_user_roll_no").val(), " " )== "")
    {
            $("#login_user_roll_no").css('background-color', '#FFCFCF');
    }
    else
        {
            
            $.ajax(


            {
               'url' : base_url + "/index.php/login/dologin",
               'dataType' : 'HTML',
               'type' : 'POST',
               'data' : {'user_roll_no' : $("#login_user_roll_no").val() , 'user_password' : $("#login_user_password").val()},
               'success' : function(data){
                   var message = data.substr(0, 7);
                   var name = data.substr(8, data.length);
                   if(message=="success")
                       {
                           $("#user_name").html(name);
                           $("#loginDiv").html("Login successfull you can now upload files");
                           $("#logout").css("display", 'inline');
                           $("#login").css("display", 'none');
                           $("#register").css("display", 'none');
                           $("#upload").css("display", 'inline');

                            $.colorbox.close();
                       }
                  else if(data == "error")
                      {
                          $("#loginError").html("Username password combination is not correct or account has not been approved yet");
                      }
                    else
                      {
                          $("#loginError").html(data);
                      }
               },
               'error': function(){
                   $("#loginError").html("Oops an error occured!");
               }
            });
        }
}
function logout(){
    $.ajax({
        'url' : base_url + '/index.php/logout',
        'type' : 'POST',
        'dataType' : 'html',
        'success' : function(data){
            if(data == 'success'){
                           $("#user_roll_no").html('');
                           $("#user_name").html('');
                           $("#logout").css("display", 'none');
                           $(".loginName span").each(function(){
                               $(this).css("display", 'none');
                           });
                           $("#login").css("display", 'inline');
                           $("#register").css("display", 'inline');
                           $("#upload").css("display", 'none');
            }
        },
       'error': function(){
           alert("Oops an error occured!");
       }
    })
}
function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}

function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}

function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}