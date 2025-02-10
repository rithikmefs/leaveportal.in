<?php

if(isset($_POST['days']))
{
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Here you would process the form data and save the selected days
    foreach ($_POST['days'] as $month => $days) 
	{
        echo "Month: $month, Days: $days<br>";
        // Save the data to a database or perform any other necessary actions
    }
}	
}
?>
