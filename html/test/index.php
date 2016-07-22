 <!DOCTYPE html>
<html>
    <?php

        // Defining quality of life functions
        /*
         *  This function querys the database using the passed query 
         *  and returns the resulting table
         */
        function queryDatabase($queryText){
            // establish connection to database
            $servername = "localhost";
            $usr = "root";
            $pass_file=fopen(".mysql-pass","r");
            $pass = trim(fgets($pass_file));
            $db_name = "agency_assignments";
            $db_conn = new mysqli($servername,$usr,$pass,$db_name);
            fclose($myfile);
            return $db_conn->query($queryText);
        }
        /*
         * This function will query for the departments and return an array
         */
        function getAgencies(){
            $agency_query = "SELECT `Agency` FROM `Assignments` WHERE 1";
            $agency_table = queryDatabase($agency_query);
            $index = 0;
            $agency_list = array();
            while($curr_row = $agency_table->fetch_assoc()){
                $agency_list[] = $curr_row["Agency"];
                $index++;
            }
            return $agency_list;
        }
        
        function getContacts($agency){
            // ensure that the search term is in all caps
            $agency = strtoupper($agency);
            $contact_query = "SELECT `GM/CM*`, `AD**` FROM `Assignments`
                                WHERE UPPER(`Agency`) = \"".$agency ."\"";
            $contact_table = queryDatabase($contact_query);
            $result = $contact_table->fetch_assoc();
            return $result;
        }
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
