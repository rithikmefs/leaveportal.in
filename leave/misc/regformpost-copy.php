<?php
include "connect.php";
if (isset($_POST['create'])) { 
    $first_name ='';  if(isset($_POST['fname'])){$first_name = trim(strtoupper($_POST['fname']));}
    $middle_name ='';  if(isset($_POST['mname'])){$middle_name = trim(strtoupper($_POST['mname']));}
    $last_name ='';  if(isset($_POST['lname'])){$last_name = trim(strtoupper($_POST['lname']));}
    $gender ='';  if(isset($_POST['gender'])){$gender = trim($_POST['gender']);}
    $dob ='';  if(isset($_POST['dob'])){$dob = trim($_POST['dob']);}
    $doj ='';  if(isset($_POST['doj'])){$doj = trim($_POST['doj']);}
	$emptype ='';  if(isset($_POST['emptype'])){$emptype = trim($_POST['emptype']);}
	$desig ='';  if(isset($_POST['desig'])){$desig = trim($_POST['desig']);}
    $email ='';  if(isset($_POST['email'])){$email = trim($_POST['email']);}
    $mobile ='';  if(isset($_POST['mobile'])){$mobile = trim($_POST['mobile']);}
    $address ='';  if(isset($_POST['address'])){$address = trim(strtoupper($_POST['address']));}
    $username ='';  if(isset($_POST['username'])){$username = trim($_POST['username']);}
    $password ='';  if(isset($_POST['password'])){ $password = trim($_POST['password']);}
	
	$arr = explode('-',$doj);
	
	$day=(int)$arr[2];
	$dojtype='N';
	if($day <= 10){
		$dojtype='Y';}
		
$name = "$first_name $middle_name $last_name";
if ($address == NULL) {
    $address = '';
}



$sql = "INSERT INTO emp (username, password, name, dob, doj, dojtype, gender, email, address, mob, emptype, designation, flag) 
        VALUES ('$username', '$password', '$name', '$dob', '$doj', '$dojtype', '$gender', '$email', '$address', '$mobile', '$emptype', '$desig', 'Y')";
		


$result = sqlsrv_query($conn, $sql);


if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "<script>alert('Successfully Inserted'); window.location.href='regform.php'</script>";
 
}
}
sqlsrv_close($conn);
?>
	