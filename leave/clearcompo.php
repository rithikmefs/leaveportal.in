<?php
session_start();
include "connect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["empid"]) && isset($_POST["name"])) 
{
    $empid = $_POST["empid"];
    $name = $_POST["name"];

    $sql = "DELETE FROM compo WHERE empid = ?";
    $params = array($empid);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt) 
	{
        echo "Compensatory leaves for $name have been cleared successfully.";
    }
	else 
	{
        echo "Unable to clear records.";
    }
} 
else 
{
    echo "Invalid request.";
}
?>
