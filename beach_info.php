<?php 
require("inc/header.php"); 
?>

<body>
<div class="container-fluid">
<?php
    $country_id = $_POST['dd-menu-country'];
    $sql        = "SELECT NAME FROM COUNTRIES WHERE ID = \"" . $country_id . "\"";
    $result     = $conn->query($sql);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $current_country = $row["NAME"];
        }
    }

?>
    <div class="row">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">Caribbean Beach Finder: <?php echo $current_country; ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <!-- Social Menu Links -->
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Change Location <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php
                        $sql = "SELECT ID, NAME FROM COUNTRIES";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<li><a href=\"#\" data-id=\"$row[ID]\">".$row["NAME"]."</a></li>";
                            }
                        } else {
                            echo "<li>No Other Islands Currently Supported</li>";
                        }
                    ?>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
    </div>




	
<div class="row" id="sliders">
<button type="button" class="btn btn-info" onclick="displayAddInfo()">Info</button>
    <?php
        $country_id = $_POST['dd-menu-country'];
        $sql        = "SELECT BEACH_NAME, ID FROM BEACHES WHERE COUNTRY_ID = \"" . $country_id . "\"";
        $result     = $conn->query($sql);
        if ($result->num_rows > 0) {
        echo "<div class=\"col-sm-12 webpage-container\">";
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                //echo $row["BEACH_NAME"];
                $sql         = "SELECT FILE_NAME FROM IMAGES WHERE BEACH_ID = \"" . $row["ID"] . "\"";
                $result2     = $conn->query($sql);
                $num_of_rows = ($result2->num_rows);
                if ($result2->num_rows > 0) {


                    echo "<div class=\"slideshow-container\">";

                    while ($row1 = $result2->fetch_assoc()) {
                        //echo "<img src=\"".$row1["FILE_NAME"]."\" style=\"width:100%;\" alt=\"".$row["BEACH_NAME"]."\">";


                        echo "<div class=\"" . $row["BEACH_NAME"] . " customfade\">";
                        echo "<img src=\"" . $row1["FILE_NAME"] . "\" alt=\"" . $row["BEACH_NAME"] . "\">";
                        //echo "<div class=\"text\">" . $row["BEACH_NAME"] . "</div>
                                    echo "</div>";


                    }
                    echo "<a class=\"prev\" onclick=\"plusSlides(-1, '" . $row["BEACH_NAME"] . "')\">&#10094;</a>
                                    <a class=\"next\" onclick=\"plusSlides(1, '" . $row["BEACH_NAME"] . "')\">&#10095;</a>

                                </div>
                            

                                <div class=\"row clear text-center\">
                                    <div class=\"col-sm-2 col-centered dot-container\">";
                    for ($dots = 1; $dots <= $num_of_rows; $dots++) {
                        echo "<span class=\"dot\" onclick=\"currentSlide(" . $dots . ", '" . $row["BEACH_NAME"] . "')\"></span> ";
                    }

                    echo "</div>
                            </div>";


                    echo "<br>";

                    echo "<script type=\"text/javascript\"> makeSlider(\"" . $row["BEACH_NAME"] . "\")</script>";
                }
            }
            echo "</div>";
        }
        ?>
</div>
  <div class="row" id="additionalInformation" style="display: none; ">

  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>



  <script>
  
  function displayAddInfo() {
    
	
	document.getElementById("additionalInformation").innerHTML = "<button type=\"button\" class=\"btn btn-info\" onclick=\"removeAddInfo()\"><-- Back</button> <h1> Test Beach additional Info</h1> ";
	 
 $("#sliders").fadeOut("slow");	
	$("#additionalInformation").fadeIn("slow");
	 
	 
}


  
  </script>
  
  
  <script>
    function removeAddInfo() {
    
	
	//document.getElementById("additionalInformation").innerHTML = "";
	 
 $("#additionalInformation").fadeOut("slow");	
	$("#sliders").fadeIn("slow");
	 
	 
}
  
  </script>
