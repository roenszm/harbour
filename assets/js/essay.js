$(document).ready(function () {
    $(".essay-publish-btn").click(function () {
        save_essay(1);
        return false;
    });
    $(".essay-draft-btn").click(function () {
        save_essay(2);
        return false;
    });
});

function save_essay(active) {
    var title = $.trim($("input[name=essay_title]").val());
    var content = $.trim($("textarea[name=essay_content]").val());
    if (title == "" || content == "") {
        alert("【标题】或【正文】不能为空或纯空格！");
        return false;
    }
    var category = $("select[name=essay_category]").val();
    if (category == "") {
        alert("请选择文章分类！");
        return false;
    }
    var sub_title = $.trim($("input[name=essay_sub_title]").val());
    var etype = $("input[name=essay_type]").val();

    $.post(
        "/essay/save",
        {
            title: title,
            content: content,
            sub_title: sub_title,
            active: active,
            category: category,
            type: etype
        },
        function (data) {
            data = $.parseJSON(data);
            alert(data.err_msg);
            if (data.err_code == 0) {
                location.href = "/essay";
            }
        }
    )
}