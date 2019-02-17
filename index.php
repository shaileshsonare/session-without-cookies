<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	
	<body>
	<?php

		ini_set("session.use_cookies", 0);
		ini_set("session.use_only_cookies", 0);
		ini_set("session.use_trans_sid", 1);
		ini_set("session.cache_limiter", "");
		session_start();

		echo "Session ID:" . session_id();
		echo "<br/>Counter: " . $_SESSION['count']++;

	?>

		<button onclick="callAjax()">Call Ajax</button>
		<button onclick="callAjax2()">Call Ajax</button>

		<div class="start"></div>
		<div class="send"></div>
	</body>
	
	<script>
		var session_id = '<?php echo session_id();?>';
		function callAjax() {
			$.ajax({
			  method: "POST",
			  url: "ajax.php",
			  //data: {PHPSESSID:session_id}
			}).done(function( msg ) {
				console.log("Counter: " + msg );
			});
		}

		function callAjax2() {
			$.ajax({
			  method: "POST",
			  url: "ajax.php",
			  //data: {PHPSESSID:session_id}
			}).done(function( msg ) {
				console.log("Counter: " + msg );
			});
		}

		$(document).ajaxSend((event, xhr, params)=>{
			params.url = params.url + "?PHPSESSID="+session_id;
			$( ".send" ).text( "Triggered ajaxSend handler." );
		});

		$( document ).ajaxStart(function() {
		  $( ".start" ).text( "Triggered ajaxStart handler." );
		});
	</script>
</html>




