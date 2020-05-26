  //プロフィール編集
  $('.profile_save').on('click',function(e){
    e.stopPropagation();
    var name_data = $('.profile .edit_name').val() || $('.slide_prof .edit_name').val() || '',
        comment_data = $('.profile .edit_comment').val() || $('.slide_prof .edit_comment').val() || '',
        icon_data = $('.profile_icon > img').attr('src'),
        user_id = $(this).data('user_id');

    $.ajax({
      type: 'POST',
      url: 'guest/guestuser.php',
      dataType: 'json',
      data: {name_data: name_data,
             comment_data: comment_data,
             icon_data: icon_data,
             user_id: user_id}
    })
    .done(function(data){
      // エラーメッセージがあれば表示
      if(data['flash_message']){
        show_slide_message(data['flash_type'],data['flash_message']);
      }else{
        location.reload();
      }
    }).fail(function(){
      location.reload();
    });
  });