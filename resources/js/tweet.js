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
            $('.p').val(returnDate);
            }
        } 
    });
 
    // リセット
    $('#resetButton').click(function(){
        $('#returnDate').text("");
    });
});



$(function(){
    var addInput = $('#addDays')
    var addButton = $('#addText')
    var resetButton = $('#resetText')
    var addTextarea = $('#addTweet')

    addButton.on('click', function(){
        var addText = addInput.val()+'日'+'\n';
        addTextarea.append(addText);
    });

    resetButton.on('click', function(){
        var addBlank = '';
        addTextarea.text(addBlank);
        addTextarea.text('#今日の積み上げ ');
    })
});