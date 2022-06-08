<?php
 
function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){

    // Connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

    // Temporary variable, used to store current query
    $templine = '';
    
    // Read in entire file
    $lines = file($filePath);
    
    $error = '';
    try {
        $sql = "DROP DATABASE dbhna";
        $db->query($sql);
    } catch (Exception $error) {
        $error->getMessage();
    }
    
    if (!empty($erorr)) {
        echo $error->getMessage();
    }else {
        
    $sql = "create database dbhna";
    $db->query($sql);
   

    
    
    // Loop through each line
    foreach ($lines as $line){
        // Skip it if it's a comment
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }
        
        // Add this line to the current segment
        $templine .= $line;
        $sql1 = "USE dbhna";
        $db->query($sql1);
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            if(!$db->query($templine)){
                $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
            }
            
            // Reset temp variable to empty
            $templine = '';
        }
    }
    return !empty($error)?$error:true;
    }
    
}
?>