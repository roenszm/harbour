$(document).ready(function () {

    $("form#user-login").submit(function () {

        $.post(
            "/submitLogin",
            $("form#user-login").serialize(),
            function (data) {
                data = $.parseJSON(data);
                alert(data.err_msg);
                if (data.err_code == 0) {
                    window.location.reload();
                }
            }
        )
        return false;
    });
});
