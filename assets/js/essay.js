$(document).ready(function () {
    $(".essay-publish-btn").click(function () {
        var title = $.trim($("input[name=essay_title]").val());
        var content = $.trim($("textarea[name=essay_content]").val());
        if (title == "" || content == "") {
            alert("标题或文章正文不能为空或纯空格！");
            return false;
        }
        var sub_title = $.trim($("input[name=essay_sub_title]").val());
        var essay_id = $("input[name=esay_id]").val();
        $.post(
            "/essay/save",
            {
                title: title,
                content: content,
                sub_title: sub_title,
                essay_id: essay_id,
                active: 1
            },
            function (data) {
                data = $.parseJSON(data);
                alert(data.err_msg);
                if (data.err_code == 0) {
                    location.href = "/essay";
                }
            }
        )
    });
});