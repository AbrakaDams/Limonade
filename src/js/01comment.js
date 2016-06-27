$(document).ready(function(){
    $('#comment').click(function(){
      var comment_text = $('#comment_text').val();
      // trim() is used to remover spaces
      if($.trim(comment_text) != '')
      {
        $.ajax({
          url: ,
          method: "POST",
          data:{comment: comment_text},
          dataType: "text",
          success:function(data)
          {
            $('#comment_text').val();
          }
        })
      }
  });
  setInterval(function(){
    $('#load_comment').load().fadeIn("slow")
  }, 1000)
});
