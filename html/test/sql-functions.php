

<?php
/*
 * This file holds several php functions for acessing the agency assignments
 */
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
        fclose($pass_file);
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
?>
