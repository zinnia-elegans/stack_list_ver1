$(function() {

    $('#addstack').click(function(){
        var name = $('#stackday').data();
        $('#stack').val("#今日の積み上げ 継続"+JSON.stringify(name)+"日");
        var str1 = $('#stack').val();
    });

});