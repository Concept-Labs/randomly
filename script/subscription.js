function send_subscription(button_readers_subscription)
{
	var emailreaders = $(button_readers_subscription).data('emailreaders');
	var idreaders = $(button_readers_subscription).data('idreaders');
	$.ajax({
		type: "POST",
		url: "js_files/subscription_users_insert.php",
		data:"readers_subscription_recipient="+emailreaders,
		success: function(html)
		{
			readers_subscription_user(emailreaders, idreaders);
		}
	});
}
function readers_subscription_user(email_readers_subscription, id_readers_subscription)
{

	$.ajax({
		type: "POST",
		url:  "js_files/readers_subscriptions_select.php",
		data: "email_readers_subscription="+email_readers_subscription+"&id_readers_subscription="+id_readers_subscription,
		success: function(html)
		{
			$("#readers_subscription_"+id_readers_subscription).empty();
			$("#readers_subscription_"+id_readers_subscription).append(html);
		}
	});
}
function send_locked_subscription(button_locked_subscription)
{
	var emaillocked = $(button_locked_subscription).data('emaillocked');
	var idlocked = $(button_locked_subscription).data('idlocked');
	$.ajax({
		type: "POST",
		url: "js_files/locked_subscription_insert.php",
		data:"locked_subscription_recipient="+emaillocked,
		success: function(html)
		{
			locked_readers_subscription_user(emaillocked, idlocked);
		}
	});
}
function locked_readers_subscription_user(email_locked_subscription, id_locked_subscription)
{
	$.ajax({
		type: "POST",
		url:  "js_files/locked_subscription_select.php",
		data: "email_locked_subscription="+email_locked_subscription+"&id_locked_subscription="+id_locked_subscription,
		success: function(html)
		{
			$("#locked_subscription_"+id_locked_subscription).empty();
			$("#locked_subscription_"+id_locked_subscription).append(html);
		}
	});
}


function send_myreaders_subscription(button_myreaders_subscription)
{
	var emailmyreaders = $(button_myreaders_subscription).data('emailmyreaders');
	var idmyreaders = $(button_myreaders_subscription).data('idmyreaders');
	$.ajax({
		type: "POST",
		url: "js_files/subscription_users_insert.php",
		data:"emailmyreaders="+emailmyreaders,
		success: function(html)
		{
			my_readers_subscription_user(emailmyreaders, idmyreaders);
		}
	});
}
function my_readers_subscription_user(email_myreaders_subscription, id_myreaders_subscription)
{
	$.ajax({
		type: "POST",
		url:  "js_files/my_readers_subscription_select.php",
		data: "email_myreaders_subscription="+email_myreaders_subscription+"&id_myreaders_subscription="+id_myreaders_subscription,
		success: function(html)
		{
			$("#my_readers_subscription_"+id_myreaders_subscription).empty();
			$("#my_readers_subscription_"+id_myreaders_subscription).append(html);
		}
	});
}