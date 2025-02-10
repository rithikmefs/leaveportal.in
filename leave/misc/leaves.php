<?php

$days='';
if(isset($_POST['days']))
{
	$days=$_POST['days'];
}
$dropdown='';

function getLeavesTakenPerMonth($employeeId) 
{
    return [
        "2024-01" => ["days" => 0, "type" => "Vacation"],
        "2024-02" => ["days" => 0, "type" => "None"],
        "2024-03" => ["days" => 0, "type" => "Sick"],
        "2024-04" => ["days" => 0, "type" => "None"],
        "2024-05" => ["days" => 0, "type" => "None"]
    ];
}

// Example usage
$employeeId = 1; // Example employee ID
$leaves = getLeavesTakenPerMonth($employeeId);

// Function to generate dropdown
function generateDaysDropdown($selectedDays) {
    $dropdown = '<select name="days">';
    for ($i = 0; $i <= 31; $i++) {
        $selected = ($i == $selectedDays) ? 'selected' : '';
        $dropdown .= "<option value=\"$i\" $selected>$i</option>";
    }
    $dropdown .= '</select>';
    return $dropdown;
}
echo $dropdown;
// Display the results
echo "<h2>Leaves Taken Per Month for Employee ID: $employeeId</h2>";
echo "<form method=\"post\" action=\"leaves.php\">";
echo "<ul>";
foreach ($leaves as $month => $leave) {
    echo "<li>$month: " . generateDaysDropdown($leave['days']) . " days ({$leave['type']})</li>";
}
echo "</ul>";
echo "<button type=\"submit\">Save</button>";
echo "</form>";
 echo "Month: $month, Days: $days<br>";
?>
