<?php 
require("inc/header.php"); 
?>

<body id="homePage">
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <!--<img src="img/beachfinder.gif" alt="Smiley face">-->
            <h1 class="text-center">CARIBBEAN BEACH FINDER</h1>
        </div>
    </div>
    
    <!--Populate drop-down menu with country choices-->
    <div class="row">
        <div class="col-sm-4 text-center" id="beachDropDown">
            <form action="./beach_info.php" method="post">
                <select class="selectpicker" data-width="70%" name="dd-menu-country">
                    <option value="0" >Find Your Beach</option>
                    <?php
                        $sql    = "SELECT ID, NAME FROM COUNTRIES";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value=\"" . $row["ID"] . "\">" . $row["NAME"] . "</option>\r\n";
                            }
                        } else {
                            echo "0 results";
                        }
                    ?>
                </select>
                <button type="submit" class="btn btn-default btn-sm" href="#"><i class="fa fa-search fa-lg"></i></button>
               
            </form>

        </div>
    </div>
</div><!-- End Bootstrp Container-fluid div -->
<?php require("inc/footer.php"); ?>
