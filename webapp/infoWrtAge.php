<!DOCTYPE html>

<html>
	<head>
		<?php include "./navigation.php" ?>

		<script type='text/javascript'>

			function get_result()
			{
				var age;//Age interval
				var q;//Question
        var t;//specifying whether the question is in the last year or month
        q = document.getElementById("select_question").value;
				age = document.getElementById("select_age").value;
        t = document.getElementById("select_time").value;

				const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					document.getElementById("Output").innerHTML = this.responseText;
				}

				xhttp.open("GET", "getInfoWrtAge.php?age="+age+"&q="+q+"&t="+t);
				xhttp.send();
			}

		</script>

	</head>

	<body onload= "get_result()">
		<form>
			<label for="Select age">Select age interval</label>
			<select id = "select_age" name = "Age" onchange="get_result()">
				<option value = "Young" >20-40</option>
				<option value = "Middle_aged">41-60</option>
				<option value = "Old">61+</option>
			</select>

      <label for="Question">Select question</label>
			<select id = "select_question" name = "Question" onchange="get_result()">
        <option value = "q1" >What are the most visited spaces?</option>
        <option value = "q2" >What are the most frequently used services?</option>
        <option value = "q3" >What are the services used by the most customers?</option>
      </select>
      <label for="Select time">Would you like to check within the last:</label>
			<select id = "select_time" name = "time" onchange="get_result()">
        <option value = "Month" >Month</option>
        <option value = "Year" >Year</option>
      </select>

		</form>

		<p id = "Output"></p>

	</body>
</html>
