 <!DOCTYPE html>
<html>
    <?php

        include "sql-function.php"; 
        // 1) Input
        // set up html
        echo "<p> Select the agency you want to find the contact info for below</p>";
        // create input form
        $agencies = getAgencies();
        echo "<form action='index.php'>";
        echo "Agency Name: <br/>";
        echo "<select name='agency_select'>";
        echo "<option selected>Choose a department</option>";
        
        // output the options to the html
        for ($index = 0;$index < count($agencies); $index++){
            echo "<option >".strval($agencies[$index])."</option>";
        }
        echo "</select>";
        // create the submit button
        echo "<input type='submit' value='Search'><br/>";
        echo "</input>";
        $agency = $_GET["agency_select"];
        
        // 2) Work
        $contacts = getContacts($agency);
        $cm = $contacts["GM/CM*"];
        $ad = $contacts["AD**"];

        // 3) Output results
        echo "<h2> Contacts for ".$agency." </h2>";
        echo "<p> CM/GM: ".$cm."<br/>AD: ".$ad."<br/></p>";
?>
</html>
