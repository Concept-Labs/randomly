window.onload = function(){
  var hdiv = document.getElementById('message_block_ul').scrollHeight;
  document.getElementById('message_block_ul').scrollTop = hdiv;
}

$(function (){
 var h_ul_scroll = document.getElementById('message_block_ul').scrollHeight;
 var h_right_block = document.getElementById('right_block_message').scrollHeight;

 if (h_ul_scroll > h_right_block) {
   $(".message_block_ul").scroll(function() {
    var scrollBottom = $(this).scrollTop() + $(".message_block_ul").height();
    var h = document.getElementById('message_block_ul').scrollHeight;

    if(scrollBottom.toFixed() == h || h < h_right_block) {

      $('#scroll_down').fadeOut();
    } else {
      $('#scroll_down').fadeIn();
    }
  });
 } 



 $("#scroll_down").click(function(){$(".message_block_ul").animate({scrollTop:document.getElementById('message_block_ul').scrollHeight},"slow")})
});

function dell_dialog(button_deldialog)
{
 var dialog_mess=$(button_deldialog).data('deldialog');
 $.ajax({
  type: "POST",
  url: "js_files/message_dialog_delete.php",
  data:"dialog_mess="+dialog_mess,
  success: function(html)
  {
   load_message_users();
 }
});
}

function confirmation_dell_dialog(button_del_dialog)
{
  var iddialog = $(button_del_dialog).data('iddialog');
  $("#confirmation_dell_dialog_"+iddialog).show();
}

function cancel_dell_dialog(button_cancel_del_dialog)
{
  var iddialogcancel = $(button_cancel_del_dialog).data('iddialogcancel');
  $("#confirmation_dell_dialog_"+iddialogcancel).hide();
}

function confirmation_dell_dialog_mess(button_del_dialog_mess)
{
  $("#confirmation_dell_dialog").show();
}

function cancel_dell_dialog_mess(button_cancel_del_dialog_mess)
{
  $("#confirmation_dell_dialog").hide();
}

function dell_dialog_mess(button_delldialog)
{
 var dialog_mess=$(button_delldialog).data('deldialog');
 var urlmess=$(button_delldialog).data('urlmess');
 $.ajax({
  type: "POST",
  url: "js_files/message_dialog_delete.php",
  data:"dialog_mess="+dialog_mess,
  success: function(html)
  {
   document.location.href = urlmess;
 }
});
}
  //Функция загрузки сообщений
  function load_message_users()
  {
  	$.ajax({
  		type: "POST",
  		url:  "js_files/last_message_users_select.php",
  		data: "req=ok",
                // Выводим то что вернул PHP
                success: function(html)
                {
          //Очищаем форму ввода
          $("#message_dialog_users").empty();
          //Выводим что вернул нам php
          $("#message_dialog_users").append(html);
        }
      });
  }

  $(document).ready(function(){
   $(".smile").click(function(){
     var smile = $(this).attr('alt');
     var text = $.trim($("#mess_to_send").text());
     var textSmile = text + ' ' + smile + ' ';
     var symbol = ['B)',
     'oP'];
     var graph = ['<img style="width: 19px; height: auto;" src="../img/smilies/smiley_PNG192.png">',
     '<img style="width: 19px; height: auto;" src="../img/smilies/smiley_PNG194.png">'];
     textSmiles = smile.replace('😋', '<img class="smile" style="width: 19px; height: auto;" src="../img/smilies/smiley_PNG194.png" alt="😋">');
     $("#mess_to_send").focus().append(window.emoji.replace(smile));
   });
 });
  $(document).ready(function () {
   alert(textSmile);
 });


  function send()
  {

    var mess=$("#mess_to_send").text();
    $.ajax({
      type: "POST",
      url: "js_files/message_users_insert.php",
      data:"mess="+mess,
      success: function(html)
      {
        load_messes();
        $("#mess_to_send").text('');
      }
    });
  }

  function send_del(button_delmess)
  {
    var id_mess=$(button_delmess).data('delmess');
    var dialog=$(button_delmess).data('deldialog');
    $.ajax({
      type: "POST",
      url: "js_files/message_users_delete.php",
      data:"id_mess="+id_mess+"&dialog="+dialog,
      success: function(html)
      {
        load_messes();
      }
    });
  }

  function load_messes()
  {
    $.ajax({
      type: "POST",
      url:  "js_files/message_users_select.php",
      data: "req=ok",
      success: function(html)
      {
        $("#message_users").empty();
        $("#message_users").append(html);
        $("#message_users").animate({scrollTop: $('#message_users').prop("scrollHeight")}, 500);
      }
    });
  }



  function load_search_messes()
  {
    var search_mess=$("#search_mess").val();
    $.ajax({
      type: "POST",
      url:  "js_files/search_message_users_select.php",
      data: "search_mess="+search_mess,
      success: function(html)
      {
        $("#search_message_users").empty();
        $("#search_message_users").append(html);
      }
    });
  }

  function open_search()
  {
   $("#message_users").hide();
   $("#search_message_users").show();
 }
 function close_search()
 {
   $("#message_users").show();
   $("#search_message_users").hide();
 }

 function change_visibility (block_4_close, block_4_open) {
  $(document).ready(function(){
    $('#'+block_4_close).css('display','none');
    $('#'+block_4_open).css('display','');
    return false;
  });
}






$('#mess_to_send').keypress(function(e) {
  if(e.which == 13) {
    jQuery(this).blur();
    jQuery('#submit').focus().click();
  }
});

ctrlEnter = function(e){
  if (((e.keyCode == 13) || (e.keyCode == 10)) && (e.ctrlKey == false)){
    //субмитим форму
  }
  if (((e.keyCode == 13) || (e.keyCode == 10)) && (e.ctrlKey == true)){
    func('\r\n');
  }
}
func = function(val){
  document.getElementById('form').elements['bla_post[message]'].focus();
  if(document.selection){
    document.getElementById('form').document.selection.createRange().text = document.getElementById('form').document.selection.createRange().text+val;
  }
  else if(document.getElementById('form').elements['bla_post[message]'].selectionStart != undefined){
    var element = document.getElementById('form').elements['bla_post[message]']; 
    var str     = element.value; 
    var start   = element.selectionStart; 
    var length  = element.selectionEnd - element.selectionStart; 
    element.value = str.substr(0, start) + str.substr(start, length) + val + str.substr(start + length);
  }
  else{
    document.getElementById('form').elements['bla_post[message]'].value += val; 
  }

}