<!DOCTYPE html>
<html>
  <head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Caribbean Beach Finder</title>
	  <script type="text/javascript">
	   var _gaq = _gaq || [];
	   _gaq.push(['_setAccount', 'UA-XXXXXXXX-Y']);
	   _gaq.push(['_trackPageview']);
	   (function()
	   {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	   })();
	  </script>
	  
	  <link rel="stylesheet" type="text/css" href="css/master.css">
	  <?php include '/utilities/db_connect.php';?>
  </head>
	<body background="img/beach.gif">
		
		
		<img src="img/beachfinder.gif" alt="Smiley face">
		<!--Populate drop-down menu with country choices-->
		<div id="beachDropDown">
			<select>
			<option></option>
			<?php 
				$sql = "SELECT NAME FROM COUNTRIES";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) 
				{
				// output data of each row
				while($row = $result->fetch_assoc())
				{
					echo "<option value=\"".$row["NAME"]."\">".$row["NAME"]."</option>\r\n";
				}
				} 
				else 
				{
					echo "0 results";
				}
				
				echo $countries
			?>
			</select>
		</div>
  
	</body>
</html>