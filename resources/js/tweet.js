$(function() {
    $('.more-btn').on('click', function() {
      if( $(this).children().is('.open') ) {
        $(this).html('<p class="close">閉じる</p>').addClass('close-btn');
        $(this).parent().removeClass('slide-up').addClass('slide-down');
      } else {
        $(this).html('<p class="open">もっと見る</p>').removeClass('close-btn');
        $(this).parent().removeClass('slide-down').addClass('slide-up');
      }
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
                $('#returnDate').val("あなたの継続日数は"+returnDate+"日です。");
                var str1 = $('#returnDate').val();
            }
        } 
    });
 
    // リセット
    $('#resetButton').click(function(){
        $('#returnDate').text("");
    });
});