function registerUser()
{
    var name = $("#name").val();

    $('#register-info').html("").hide();

    if (!name.length)
    {
        $('#register-info').html("Palun sisestage oma nimi!").show();
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "register.php",
            data: {name: name},
            success: function (response)
            {
                if (response === "0")
                {
                    $('#register-info').html("Registreerimine ebaõnnestus!").show();
                }
                else
                {
                    $('#s-register-info').html(response).show();
                    $('#login-form').show();
                    $('#registration-form').hide();
                    $('#username').val("");
                }
            }
        });
    }
}

function loginUser()
{
    var username = $("#username").val();

    if (!username.length)
    {
        $('#login-info').html("Palun sisestage oma kasutajanimi!").show();
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "login.php",
            data: {username: username},
            success: function (response)
            {
                if (response === "0")
                {
                    $('#login-info').html("Sisselogimine ei õnnestu! Kasutajanimi ei ole leitav").show();
                }
                else
                {
                    $('#success-info').html(response).show();
                    $('#login-form').hide();
                    $('#username').val("");
                }
            }
        });
    }
}
