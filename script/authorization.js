function errors_registration()
  {
    var error_email=$("#error_email").val();
    var error_password=$("#error_password").val();
    var error_years=$("#error_years").val();
    var error_agreement=$("#error_agreement").val();
    
    alert(error_agreement);
    $.ajax({
      type: "POST",
      url: "js_files/message_users_insert.php",
      data:"mess="+mess,
      success: function(html)
      {
        load_messes();
        $("#mess_to_send").val('');
      }
    });
  }