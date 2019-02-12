function send_hide_pyramid()
{
	$.ajax({
		type: "POST",
		url: "js_files/hide_pyramid_insert.php",
		data:"req=ok",
		success: function(html)
		{
			hide_pyramid();
		}
	});
}

function hide_pyramid()
{
	$.ajax({
		type: "POST",
		url:  "js_files/hide_pyramid_select.php",
		data: "req=ok",
		success: function(html)
		{
			$("#hide_pyramid").empty();
			$("#hide_pyramid").append(html);
		}
	});
}

function change_visibility (block_4_close, block_4_open) {
	document.getElementById(block_4_close).style.display='none';
	document.getElementById(block_4_open).style.display='';
}

function change_visibility (block_4_close, block_4_open) {
	$(document).ready(function(){
		$('#'+block_4_close).css('display','none');
		$('#'+block_4_open).css('display','');
		return false;
	});
}