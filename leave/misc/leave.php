<?php
// Define the join date
$joinDate = new DateTime("2024-01-01");

// Get the current date
$currentDate = new DateTime();

// Display the current date
echo "Current Date: " . $currentDate->format('Y-m-d') . "\n";

// Calculate the difference between the two dates
$interval = $joinDate->diff($currentDate);

// Get the difference in months
$monthsDifference = ($interval->y * 12) + $interval->m;

// Calculate the number of years worked
$yearsWorked = $interval->y + ($interval->m > 0 ? 1 : 0);

// Total months worked
$totalMonthsWorked = $yearsWorked * 12 + $interval->m;

// Initialize total leave balance
$totalLeaveBalance = 0;

// Function to simulate fetching leaves taken per month (this would be replaced by a database query in a real application)
function getLeavesTakenPerMonth($employeeId) {
    // Example data for demonstration purposes (replace this with actual data retrieval)
    return [
        "2024-01" => 0,
        "2024-02" => 0,
        "2024-03" => 0,
        "2024-04" => 0,
        "2024-05" => 0
    
        // Add more months as needed for each year
    ];
}

// Simulate fetching leaves taken for a specific employee (replace 123 with actual employee ID)
$employeeId = 123;
$leavesTakenPerMonth = getLeavesTakenPerMonth($employeeId);

// Loop through each month and calculate the leave balance
foreach ($leavesTakenPerMonth as $month => $leavesTaken) {
    if ($leavesTaken >= 0) {
        // If more than 1 leave is taken in a month, subtract the excess leaves from the leave balance
        $totalLeaveBalance -= ($leavesTaken - 1);
    }
}

// Output the leave balance result
echo "Total leave balance after considering leave policy: " . $totalLeaveBalance;
?>