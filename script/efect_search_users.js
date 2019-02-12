$(document).ready(function() {
			$("div.search_users_block").css("display", "none");

			$("div.search_users_block").fadeIn(1000);

			$("").click(function(event){
				event.preventDefault();
				linkLocation = this.href;
				$("div.search_users_block").fadeOut(10000, redirectPage);
			});

			function redirectPage() {
				window.location = linkLocation;
			}
		});