$(function() {

    $('#addstack').click(function(){
        var name = $('h4').attr('id');
        $('#stack').val("#今日の積み上げ 継続"+name+"日");
        var str1 = $('#stack').val();
    });

});

$(function() {
    $('#calcButton').click(function(e) {
        e.preventDefault();        

        var today = new Date();    
        var y = $('#year').val();
        var m = $('#month').val();
        var d = $('#date').val();
        if (y !== "" && m !== "" && d !== "") {
            var from = Date.parse(y+"/"+m+"/"+d);
        }
 
        if (from !== '' && today !== '') {
            var ans = (today - from)/1000/60/60/24;                
            returnDate = Math.floor(ans);                                    
 
            if (isNaN(returnDate) || returnDate == 0) {        
                var returnDate = 0;
            } else {
            $('#returnDate').text(returnDate);
            }
        } 
    });
 
    // リセット
    $('#resetButton').click(function(){
        $('#returnDate').text("");
    });
});