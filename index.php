<?php
	
	require("connection.php");

?>

<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Ajax</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" media="all" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript">

    $(document).ready(function(){

    	$('.date').datepicker({
    		dateFormat: "yy-mm-dd"
    	});

    	$('.date').change(function(){
    		$("#hidden").val('1');
    		$('#test_form').submit();
    	});

    	$('#search_text').keyup(function(){
    		$("#hidden").val('1');
    		$('#test_form').submit();
    	});

    	$('#test_form').submit(function(){
    		$.post(
    			$(this).attr('action'),
    			$(this).serialize(),
    			function(data){
    				$('#results').html(data.pages);
    				$('#results').append(data.html);

    				$("button").click(function(){
						$("#hidden").val($(this).attr('id'));
						// $("button").addClass('active');
						$("#test_form").submit();
					});
    			},
    			"json"
			);
			return false;
    	});

    	$('#test_form').submit();
    
    });
	</script>
</head>
<body>
	<div id="wrapper">
		<form id="test_form" action="process.php" method="post">
			<div class="form-group float_left">
				<input id="hidden" type="hidden" name="action" value="1">
				<label for="name">Name:</label>
				<input type="text" id="search_text" name="name">
			</div>
			<div class="form-group float_left">
				<label for="from_date">From:</label>
				<input class="date" id="from_date" type="text" name="from_date">
			</div>
			<div class="form-group float_left">
				<label for="to_date">To:</label>
				<input class="date" id="to_date" type="text" name="to_date">
			</div>
		</form>
		<div id="results" class="clear">
			
		</div>
	</div>
</body>
</html>