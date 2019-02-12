function send_like()
	{
		var like_recipient=$("#like_recipient").val();
		$.ajax({
			type: "POST",
			url: "js_files/like_users_insert.php",
			data:"like_recipient="+like_recipient,
			success: function(html)
			{
				like_users();
				$("#like_recipient").val('');
			}
		});
	}
	function like_users()
	{
		$.ajax({
			type: "POST",
			url:  "js_files/like_users_select.php",
			data: "req=ok",
			success: function(html)
			{
				$("#like_users").empty();
				$("#like_users").append(html);
			}
		});
	}

	function send_subscription()
	{
		var subscription_recipient=$("#subscription_recipient").val();
		$.ajax({
			type: "POST",
			url: "js_files/subscription_users_insert.php",
			data:"subscription_recipient="+subscription_recipient,
			success: function(html)
			{
				subscription_users();
				$("#subscription_recipient").val('');
			}
		});
	}
	function subscription_users()
	{
		$.ajax({
			type: "POST",
			url:  "js_files/subscription_users_select.php",
			data: "req=ok",
			success: function(html)
			{
				$(".search_subscribe").empty();
				$(".search_subscribe").append(html);
			}
		});
	}