function page_users()
{
	$.ajax({
		type: "POST",
		url:  "js_files/page_users_select.php",
		data: "req=ok",
		success: function(html)
		{
			$(".user_page").empty();
			$(".user_page").append(html);
		}
	});
}

function comment_news_window()
{
	$.ajax({
		type: "POST",
		url:  "js_files/page_comment_news_window_select.php",
		data: "req=ok",
		success: function(html)
		{
			$(".comment_user_block").empty();
			$(".comment_user_block").append(html);
		}
	});
}

function comment_news_tape()
{
	$.ajax({
		type: "POST",
		url:  "js_files/page_comment_news_tape_select.php",
		data: "req=ok",
		success: function(html)
		{
			$("#comments_news_tape").empty();
			$("#comments_news_tape").append(html);
		}
	});
}

function post_comment_news_window(btn_comment)
{
	var comment_news=$("#comment_window").val();
	var kodcomment = $(btn_comment).data('kodcomment');
	var emailnews = $(btn_comment).data('emailnews');
	var data = "comment_news="+comment_news+"&kodcomment="+kodcomment+"&emailnews="+emailnews;
	$.ajax({
		type: "POST",
		url:  "js_files/news_post_comment_insert.php",
		data: data,
		success: function(html)
		{
			comment_news_window();
			$("#comment_window").val('');
		}
	});

}

function open_user_post(btn_open_post)
{	
	var iduser=$(btn_open_post).data('iduser');
	var emailuser=$(btn_open_post).data('emailuser');
	var kodnews=$(btn_open_post).data('kodnews');
	$.ajax({
		type: "POST",
		url:  "js_files/open_post_news.php",
		data: "iduser="+iduser+"&emailuser="+emailuser+"&kodnews="+kodnews,
		success: function(html)
		{
			comment_news_window();
			$("#open_user_post").empty();
			$("#open_user_post").append(html);
		}
	});
	$("#open_user_post").show();
}
function close_user_post()
{
	
	$("#open_user_post").hide().empty();
}

function open_table()
{
	$(".post_user_block").show();
	$(".open_table").css('color', '#A805C1');
	$(".open_tape").css('color', '#bababa');
	$(".people_post").hide();
}
$(document).ready(function() {    
	$(".open_table").css('color', '#A805C1');
	$(".open_tape").css('color', '#bababa');
});

function open_tape(btn_open_tape)
{
	var iduser=$(btn_open_tape).data('iduser');
	var emailuser=$(btn_open_tape).data('emailuser');
	$.ajax({
		type: "POST",
		url:  "js_files/page_tape_news_user_select.php",
		data: "iduser="+iduser+"&emailuser="+emailuser,
		success: function(html)
		{	
			comment_news_tape();
			$("#news_user_tape").empty();
			$("#news_user_tape").append(html);
		}
	});
	$(".post_user_block").hide();
	$(".open_tape").css('color', '#A805C1');
	$(".open_table").css('color', '#bababa');
	$(".people_post").show();
}

function open_more_information_users()
{
	$("#more_information_users").show();
	$(".close_more_information_users").show();
	$(".open_more_information_users").hide();
}
function close_more_information_users()
{
	$(".close_more_information_users").hide();
	$("#more_information_users").hide();
	$(".open_more_information_users").show();
}

function long_news(button_long_news)
{
  var idnews = $(button_long_news).data('idnews');
  $("#short_news_"+idnews).hide();
  $("#long_news_"+idnews).show();
}