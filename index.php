<?php 
require("utilities/db_connect.php");
require("inc/header.php"); 
?>
<body id="homePage">
    <img src="img/beachfinder.gif" alt="Smiley face">
    <!--Populate drop-down menu with country choices-->
    <div id="beachDropDown">
        <form action="./pages/beach_info.php" method="post">
            <select name="dd-menu-country">
                <option>Select Country</option>
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
                <input type="submit" value="Go">
            </form>
        </div>
<?php require("inc/footer.php"); ?>
