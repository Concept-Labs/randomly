function mynews_users()
{
 $.ajax({
  type: "POST",
  url:  "js_files/mynews_users_select.php",
  data: "req=ok",
                // Выводим то что вернул PHP
                success: function(html)
                {
          //Очищаем форму ввода
          $("#mynews").empty();
          //Выводим что вернул нам php
          $("#mynews").append(html);
        }
      });
}

function confirmation_del_news(button_del_news)
{
  var idnews = $(button_del_news).data('idnews');
  $("#del_news_"+idnews).hide();
  $("#confirmation_del_news_"+idnews).show();
}

function cancel_del_news(button_cancel_del_news)
{
  var idnewscancel = $(button_cancel_del_news).data('idnewscancel');
  $("#del_news_"+idnewscancel).show();
  $("#confirmation_del_news_"+idnewscancel).hide();
}

function send_del_news(button_confirmation_del_news)
{
  var idnewsconfirmation=$(button_confirmation_del_news).data('idnewsconfirmation');
  $.ajax({
    type: "POST",
    url: "js_files/news_users_delete.php",
    data:"idnewsconfirmation="+idnewsconfirmation,
    success: function(html)
    { 
      mynews_users()
    }
  });
}

/*function post_new()
{
        // делаем отмену действия браузера и формируем ajax
        var text_news=$(".write").text();
        // данные с формы завернем в переменную для ajax

        $.ajax({
          type: "POST",
          url:  "js_files/mynews_insert.php",
          data: "text_news="+text_news,
          success: function(html)
          {
            mynews_users();
            $(".write").text('');
          }
        });

      }*/

      $(document).ready(function () {

        function readImage ( input ) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#preview').attr('src', e.target.result);
              $("#preview").show();
            }

            reader.readAsDataURL(input.files[0]);
          }
        }

        function printMessage(destination, msg) {
          if (msg) { 
            $(destination).empty();
            setTimeout(function(){$('.error_upload_news').fadeOut('fast')},2500);  
            $(destination).append("<div class=\"error_upload_news\">" + msg + "</div>" );
          }

        }

        $('#image').change(function(){
          readImage(this);
        });

        $('#upload-image').on('submit',(function(e) {
          e.preventDefault();
          var text_news=$(".write").text();
          var formData = new FormData(this);
          formData.append('text_news', text_news);

          $.ajax({
      type:'POST', // Тип запроса
      url: 'js_files/mynews_insert.php', // Скрипт обработчика
      data: formData, // Данные которые мы передаем
      cache:false, // В запросах POST отключено по умолчанию, но перестрахуемся
      contentType: false, // Тип кодирования данных мы задали в форме, это отключим
      processData: false, // Отключаем, так как передаем файл
      success:function(data){
        printMessage('#result', data);        
        $("#image").val("");
        $("#preview").hide();
        mynews_users();
        $(".write").text('');
      },
      error:function(data){
        console.log(data);
      }

    });
        }));
      });

      function post_comment_news(btn_comment)
      {
        var idcomment = $(btn_comment).data('idcomment');
        var comment_news=$("#comment_"+idcomment).text();
        var kodcomment = $(btn_comment).data('kodcomment');
        var emailnews = $(btn_comment).data('emailnews');
        var data = "comment_news="+comment_news+"&kodcomment="+kodcomment+"&emailnews="+emailnews;
        $.ajax({
          type: "POST",
          url:  "js_files/news_post_comment_insert.php",
          data: data,
          success: function(html)
          {
            mynews_users();
            $("#comment_"+idcomment).text('');
          }
        });

      }

      function confirmation_del_commentnews(button_del_commentnews)
      {
        var iddelcommentnews = $(button_del_commentnews).data('iddelcommentnews');
        $("#del_commentnews_"+iddelcommentnews).hide();
        $("#confirmation_del_commentnews_"+iddelcommentnews).show();
      }

      function cancel_del_commentnews(button_cancel_del_commentnews)
      {
        var idcommentnewscancel = $(button_cancel_del_commentnews).data('idcommentnewscancel');
        $("#del_commentnews_"+idcommentnewscancel).show();
        $("#confirmation_del_commentnews_"+idcommentnewscancel).hide();
      }

      function send_del_commentnews(button_confirmation_del_commentnews)
      {
        var idcommentmynewsconfirmation=$(button_confirmation_del_commentnews).data('idcommentnewsconfirmation');
        var kodcommentmynews=$(button_confirmation_del_commentnews).data('kodcommentnews');
        $.ajax({
          type: "POST",
          url: "js_files/newscomment_users_delete.php",
          data:"idcommentmynewsconfirmation="+idcommentmynewsconfirmation+"&kodcommentmynews="+kodcommentmynews,
          success: function(html)
          { 
            mynews_users()
          }
        });
      }

      