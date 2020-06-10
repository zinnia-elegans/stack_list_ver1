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

$.fn.clickToggle = function (a, b) {
  return this.each(function () {
    var clicked = false;
    $(this).on('click', function () {
      clicked = !clicked;
      if (clicked) {
        return a.apply(this, arguments);
      }
      return b.apply(this, arguments);
    });
  });
};



$(function(){

    $('#addText').clickToggle(function() {
        var addText = $('#addDays').val()+'日'+'\n';
        $('#addTweet').text('#今日の積み上げ '+addText);
    }, function() {
        var addText = $('#addDays').val()+'日'+'\n';
        $('#addTweet').text('#今日の積み上げ '+addText);
    })

    $('#resetText').on('click', function(){
    var resetBlank = '';
        $('#addTweet').text(resetBlank);
        $('#addTweet').text('#今日の積み上げ ');
    })
});