$( document ).ready(function(){

	$(window).scroll(function() {

		if($(this).scrollTop() >= 400) {

			$('#toTop').fadeIn();

		} else {

			$('#toTop').fadeOut();

		}
	});

	$('#toTop').click(function() {

		$('body,html').animate({scrollTop:0},200);

	});

});

$(function() {
	$(".contentPost").delay(0.1).fadeIn(100);
});

$(document).ready(function() {
	$('[data-countchar]').countChar({
		text: ''
	});
});





function open_gift_block()
{
	$(".present_gift_overlay").show();
	$("#present_gift_friend_open").show();
}
function open_present_gift()
{
	$("#present_gift_friend_open").hide();
	$(".present_gift_friend").show();
	$(".present_gift_overlay").show();
}
function close_gift_block()
{
	$(".present_gift_friend").hide();
	$(".present_gift_overlay").hide();
	$("#present_gift_friend_open").hide();
}
function overlay_close_gift()
{
	$(".present_gift_friend").hide();
	$(".present_gift_overlay").hide();
	$("#present_gift_friend_open").hide();
}

function open_modal()
{	
	$("body").addClass("modal-open");
}
function close_modal() {
	$("body").remoweClass("modal-open");
}



function open_notification_block()
{
	$(".notification_block").show();
	$("#notif_icon_close").show();
	$(".square").show();
	$(".square_shadow").show();
	$("#notif_icon_close").css("color", "#A805C1");
	$("#notif_icon").hide();
}
function close_notification_block()
{
	$(".square").hide();
	$(".square_shadow").hide();
	$(".notification_block").hide();
	$("#notif_icon_close").hide();
	$("#notif_icon").show();
}