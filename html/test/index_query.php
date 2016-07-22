<?php
/*
*  This function querys the database using the passed query 
 *  and returns the resulting table
 */
function queryDatabase($queryText){
    // establish connection to database
    $servername = "localhost";
    $usr = "root";
    $pass = "Scout16";
    $db_name = "agency_assignments";
    $db_conn = new mysqli($servername,$usr,$pass,$db_name);

    return $db_conn->query($queryText);
}

function getContacts($agency){
    // ensure that the search term is in all caps
    $agency = strtoupper($agency);
    $contact_query = "SELECT `GM\CM*`, `AD**` FROM `Assignments`
                        WHERE UPPER(Agency) = \"".$agency ."\"";
    $contact_table = queryDatabase($contact_query);
    return $contact_table->fetch_assoc();
}
echo "query";
?>
