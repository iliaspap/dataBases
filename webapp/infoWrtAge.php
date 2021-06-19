<!DOCTYPE html>

<html>
	<head>
		<?php include "./navigation.php" ?>

		<script type='text/javascript'>

			function get_result()
			{
				var age;//Age interval
				var q;//Question

        q = document.getElementById("select_question").value;
				age = document.getElementById("select_age").value;

				const xhttp = new XMLHttpRequest();
				xhttp.onload = function() {
					document.getElementById("Output").innerHTML = this.responseText;
				}

				xhttp.open("GET", "getInfoWrtAge.php?age="+age+"&q="+q);
				xhttp.send();
			}

		</script>

	</head>

	<body>
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


		</form>

		<p id = "Output"></p>

	</body>
</html>
