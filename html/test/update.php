<!Doctype html>
<html>
    <body>
        <h3>Update Contact</h3>
<?php
/*
 *  This page will update a database entry for an agency
 */

        include 'sql-functions.php';
        // set up html
        echo "<p> Select the agency you want to find the contact info for below</p>";
        // create input form
        $agencies = getAgencies();
        echo "<form action='update.php'>";
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
?>
    </body>
</html>
