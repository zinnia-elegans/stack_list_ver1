$(function() {

    $('#addstack').click(function(){
        var name = $('h4').attr('id');
        $('#stack').val("#今日の積み上げ 継続"+name+"日");
        var str1 = $('#stack').val();
    });

});