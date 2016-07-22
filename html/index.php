<!DOCTYPE html>
<html lang="en">
<style>
        body{
                background-color:white
            }
</style>


<head>
        <title> Dummy Site </title>
</head>
<body>
        <p>
                Enter the agency you want to find the contact for below
        </p>

        <form action="index.php">
            Agency Name:<br>
            <input type = "text" name = "dep_name"><input type="submit" value="Submit">
        </form>
        <p>
<?php
            $department =  strtoupper($_GET["dep_name"]);
            // Make database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "agency_assignments"; 
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // SQL query for the dropdown box
            $agency_query = "SELECT `Agency` FROM `Assignments`";

            // write the SQL query for the contact
            $cm_query = "SELECT `GM/CM*`, `AD**` FROM `Assignments` WHERE UPPER(Agency)=\"".$department."\" OR UPPER(ABBR2)=\"".$department."\" OR UPPER(ABBR1)=\"".$department."\"";
            if($department != ""){
                // Finds the result when enter is hit
                // check connection
                if ($conn->connect_error){
                    die("Connection Failed: " . $conn->connect_error);
                }
                else{
                    $result = $conn->query($cm_query);
                    $result_text = "<h3>Result</h3>";
                    if ($result->num_rows > 0){
                        $cm = $result->fetch_assoc();
                        $result_text .=  "CM/GM: ".$cm["GM/CM*"]."<br>";
                        $result_text .=  "AD: ".$cm["AD**"];
                    }else{
                        $result_text .= "No result found!";
                    }
                    $conn->close();
                }
            }else{
                $menu_text = "Agency";
                // Create the dropdown list

            }

            // display everything
            echo $result_text;
        ?>
        </p>

</body>
