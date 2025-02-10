<?php
session_start();
include "connect.php";
header('Content-Type: application/json');

if ($conn === false) 
{
    echo json_encode(["success" => false, "message" => "Connection failed: " . sqlsrv_errors()]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

$ltype = '';

$empid = $data['empid'];
$leavedate = $data['leavedate'];
$leavetype = $data['leavetype'];
$reason = $data['reason'];
$compodate1 = $data['compodate'];
$action = 'R';

if($leavetype == 'COMPO')
{
	$ltype = 'Compensatory leave';
}	
if($leavetype == 'CASUAL')
{
	$ltype = 'Casual leave';
}

$date = DateTime::createFromFormat('Y-m-d', $leavedate);
$formattedleavedate = $date->format('d-m-Y');
	
date_default_timezone_set("Asia/Kolkata");
$time = date('Y-m-d H:i:s');	


$sql1 = "INSERT INTO msg (senderid, receiverid, message, timestamp, isread, status, typing) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";//ARUN
$param1 = 
[
    '999',
    $empid,
    "Leave Request Rejected for your $ltype on date - $formattedleavedate",
    $time, 
    '0', 
    'UNREAD',
    'N' 
];

// Execute the query
$stm1 = sqlsrv_query($conn, $sql1, $param1);

if ($stm1 === false) 
{
    die(print_r(sqlsrv_errors(), true));
}


$sql2 = "INSERT INTO leave (empid, leavedate, reason, leavetype, compodate, action) 
        VALUES (?, ?, ?, ?, ?, ?)";
$params2 = array($empid, $leavedate, $reason, $leavetype, $compodate1, $action);

// Execute the query
$stmt2 = sqlsrv_query($conn, $sql2, $params2);

if ($stmt2 === false) 
{
    die(print_r(sqlsrv_errors(), true));
} 


$sql3 = "UPDATE leaverequest set pending = 'N' WHERE empid = ? AND leavedate = ?";

$params = array($empid, $leavedate);
$stmt = sqlsrv_query($conn, $sql3, $params);

if ($stmt === false) 
{
    die(print_r(sqlsrv_errors(), true));
} 

sqlsrv_close($conn);

?>
