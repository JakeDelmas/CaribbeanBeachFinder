<?php
//Refirect to homepage if no country selected to prevent blank beach_info page from showing up
if (!isset($_POST['dd-menu-country'])) {
  header("Location: index.php");
}

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
              <a class="navbar-brand" href="index.php">Caribbean Beach Finder: &nbsp;<small><?php echo $current_country; ?></small> |</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <!-- Social Menu Links -->
                <li><a href="#"><i class="fa fa-facebook fa-lg"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter fa-lg"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram fa-lg"></i></a></li>
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

<div class="top-buffer"></div>

<div class="row">

    <div class="col-lg-2 beach-name-nav">

      <ul class="nav nav-pills nav-stacked">
          <li role="presentation" class="active"><a href="#">Beaches in <?php echo $current_country; ?>&nbsp;:</a></li>
    

    <?php
    // Query to load all beaches in country into sidebar


      $country_id = $_POST['dd-menu-country'];
      $sql        = "SELECT BEACH_NAME, ID FROM BEACHES WHERE COUNTRY_ID = \"" . $country_id . "\"";
      $result     = $conn->query($sql);
      if ($result) {
        while ($row = $result->fetch_assoc()) {
          echo "<li role=\"presentation\" data-id=\"". $row["ID"] ."\"><a href=\"#\">". $row["BEACH_NAME"] ."</a></li>";
        }
      }
    ?>
      </ul>
    </div>


    <!--  Bootstrap Carousel  -->

    <div class="col-sm-12 col-lg-6 col-lg-offset-1">

      <div id="my-slider" class="carousel slide" data-ride="carousel">

         
        <!--  Wrapper to hold all slides  -->
        <div class="carousel-inner" role="listbox">  

        <?php
          $indicator_count = 0;
          $active_flag = 1;
          $active_flag2 = 1;
          $country_id = $_POST['dd-menu-country'];
          $sql2        = "SELECT BEACH_NAME, ID FROM BEACHES WHERE COUNTRY_ID = \"" . $country_id . "\"";
          $result2     = $conn->query($sql2);
          if ($result2) {

            while ($row2 = $result2->fetch_assoc()) {

              // Now get file name for images of specific beaches

              $sql3 = "SELECT FILE_NAME,BEACH_ID FROM IMAGES WHERE BEACH_ID = \"" . $row2["ID"] . "\"";
              $result3 = $conn->query($sql3);
              
              $sql4 = "SELECT DISTINCT BEACH_ID FROM IMAGES";
              $result4 = $conn->query($sql4);
              
              if ($result3) {

                if ($result4) {
                  // Store number of indicators will be needed
                  $indicator_count = $result4->num_rows;
                }else{
                  $indicator_count = 0;
                }
                
                
                
                //<!--  Indicators  dot nav   -->
                if ($indicator_count > 0) {
                  echo "<ol class=\"carousel-indicators\">";
                    for ($i=0; $i < $indicator_count ; $i++) { 
                      if ($active_flag2) {
                        echo "<li data-target=\"#my-slider\" data-slide-to=\"" . $i . "\" class=\"active\"></li>";
                        $active_flag2 = 0;
                      }else{
                        echo "<li data-target=\"#my-slider\" data-slide-to=\"" . $i . "\" class=\"\"></li>";
                      }
                    }
                  echo "</ol>";
                }

                //Will only load first image per beach ONLY into Carousel
                $row3 = $result3->fetch_assoc();

                //If no images, break
                if (!$row3["FILE_NAME"]) {
                  break;
                }
                
                //<!--  Each slide is represented by one of these divs  -->

                //Set active class only to first slide
                if ($active_flag) {
                  echo "<div class=\"item active\">";
                }else{
                  echo "<div class=\"item\">";
                }

                echo "
                  <img src=\"" . $row3["FILE_NAME"] . "\" alt=\"beach1\">
                  <div class=\"carousel-caption\">
                    <h3>" . $row2["BEACH_NAME"] . "</h3>
                    <p>About Beach 1</p>
                  </div>
                </div>";

                //Stop applying active class to Carousel items
                $active_flag = 0; 
                
              }
            }
          }

        ?>
        </div> <!-- Ends carousel-inner -->
        
        
        
        <?php
          

        ?>
        

        

        <!--  Controls next and prev  -->
        <a class="left carousel-control" href="#my-slider" role="button" data-slide="prev">
          <span class="icon-prev" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>


        <a class="right carousel-control" href="#my-slider" role="button" data-slide="next">
          <span class="icon-next" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>


      </div>

    </div>

    <!-- End Bootstrap Carousel -->

    <div class="row" id="additionalInformation" style="display: none; ">

    </div>
    
</div>


	

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>



  <script>
  
  function displayAddInfo(id,beachName) {
    
	
	document.getElementById("additionalInformation").innerHTML = "<button type=\"button\" class=\"btn btn-info\" onclick=\"removeAddInfo()\"><-- Back</button> <h1> Test Beach additional Info for: <br> Beach ID: "+id+"<br> Beach Name: "+beachName+"</h1> ";
	 
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
  
  
  <?php 
require("inc/footer.php"); 
?>

