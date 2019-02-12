function news_users()
{
 $.ajax({
  type: "POST",
  url:  "js_files/news_users_select.php",
  data: "req=ok",
                // Выводим то что вернул PHP
                success: function(html)
                {
          //Очищаем форму ввода
          $("#news_users").empty();
          //Выводим что вернул нам php
          $("#news_users").append(html);
        }
      });
}

function long_news(button_long_news)
{
  var idnews = $(button_long_news).data('idnews');
  $("#short_news_"+idnews).hide();
  $("#long_news_"+idnews).show();
}

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
      news_users();
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
  var idcommentnewsconfirmation=$(button_confirmation_del_commentnews).data('idcommentnewsconfirmation');
  var kodcommentnews=$(button_confirmation_del_commentnews).data('kodcommentnews');
  $.ajax({
    type: "POST",
    url: "js_files/newscomment_users_delete.php",
    data:"idcommentnewsconfirmation="+idcommentnewsconfirmation+"&kodcommentnews="+kodcommentnews,
    success: function(html)
    { 
      news_users();
      comment_news_tape();
    }
  });
}