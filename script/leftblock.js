$(window).load(function() {
			setTimeout(function() {
				$("#contentPost").show('fadeIn', {}, 500)
			}, 2000);
		});

function like_user()
  {
  	$.ajax({
  		type: "POST",
  		url:  "js_files/like_user_select.php",
  		data: "req=ok",
                // Выводим то что вернул PHP
                success: function(html)
                {
          //Очищаем форму ввода
          $("#likes_update").empty();
          //Выводим что вернул нам php
          $("#likes_update").append(html);
      }
  });
  }

  function number_become_acquainted()
  {
    $.ajax({
      type: "POST",
      url:  "js_files/number_become_acquainted_select.php",
      data: "req=ok",
                // Выводим то что вернул PHP
                success: function(html)
                {
          //Очищаем форму ввода
          $("#number_become_acquainted").empty();
          //Выводим что вернул нам php
          $("#number_become_acquainted").append(html);
      }
  });
  }

  function number_stroll()
  {
    $.ajax({
      type: "POST",
      url:  "js_files/number_stroll_select.php",
      data: "req=ok",
                // Выводим то что вернул PHP
                success: function(html)
                {
          //Очищаем форму ввода
          $("#number_stroll").empty();
          //Выводим что вернул нам php
          $("#number_stroll").append(html);
      }
  });
  }

  function number_sleep()
  {
    $.ajax({
      type: "POST",
      url:  "js_files/number_sleep_select.php",
      data: "req=ok",
                // Выводим то что вернул PHP
                success: function(html)
                {
          //Очищаем форму ввода
          $("#number_sleep").empty();
          //Выводим что вернул нам php
          $("#number_sleep").append(html);
      }
  });
  }

  function number_all_offers()
  {
    $.ajax({
      type: "POST",
      url:  "js_files/number_all_offers_select.php",
      data: "req=ok",
                // Выводим то что вернул PHP
                success: function(html)
                {
          //Очищаем форму ввода
          $("#number_all_offers").empty();
          //Выводим что вернул нам php
          $("#number_all_offers").append(html);
      }
  });
  }