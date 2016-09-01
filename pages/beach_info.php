<?php 
require("../utilities/db_connect.php");
require("../inc/header.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/master.css\">";
?>
<body>
<?php
$country_id = $_POST['dd-menu-country'];
$sql        = "SELECT BEACH_NAME, ID FROM BEACHES WHERE COUNTRY_ID = \"" . $country_id . "\"";
$result     = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<div class=\"webpage-container\">";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo $row["BEACH_NAME"];
        $sql         = "SELECT FILE_NAME FROM IMAGES WHERE BEACH_ID = \"" . $row["ID"] . "\"";
        $result2     = $conn->query($sql);
        $num_of_rows = ($result2->num_rows);
        if ($result2->num_rows > 0) {


            echo "<div class=\"slideshow-container\">";

            while ($row1 = $result2->fetch_assoc()) {
                //echo "<img src=\"".$row1["FILE_NAME"]."\" style=\"width:100%;\" alt=\"".$row["BEACH_NAME"]."\">";


                echo "<div class=\"" . $row["BEACH_NAME"] . " fade\">";
                echo "<img src=\"" . $row1["FILE_NAME"] . "\" style=\"width:100%;height:600px;\" alt=\"" . $row["BEACH_NAME"] . "\">";
                echo "<div class=\"text\">" . $row["BEACH_NAME"] . "</div>
							</div>";


            }
            echo "<a class=\"prev\" onclick=\"plusSlides(-1, '" . $row["BEACH_NAME"] . "')\">&#10094;</a>
							<a class=\"next\" onclick=\"plusSlides(1, '" . $row["BEACH_NAME"] . "')\">&#10095;</a>

						</div>
					

						<div style=\"text-align:center\">";
            for ($dots = 1; $dots <= $num_of_rows; $dots++) {
                echo "<span class=\"dot\" onclick=\"currentSlide(" . $dots . ", '" . $row["BEACH_NAME"] . "')\"></span> ";
            }

            echo "</div>";


            echo "<br>";

            echo "<script type=\"text/javascript\"> makeSlider(\"" . $row["BEACH_NAME"] . "\")</script>";
        }
    }
    echo "</div>";
}
?>