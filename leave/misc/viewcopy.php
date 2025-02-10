<?php
include "connect.php";
$username='';
if(isset($_POST['username']))
{
	$username=$_POST['username'];
}
$password='';
if(isset($_POST['password']))
{
	$password=$_POST['password'];	
}
$empid='';
if(isset($_POST['empid']))
{
	$empid=$_POST['empid'];
}
$emptype='';
if(isset($_POST['emptype']))
{
	$emptype=$_POST['emptype'];	
}
$doj='';
if(isset($_POST['doj']))
{
	$doj=$_POST['doj'];	
}
$dojtype='';
if(isset($_POST['dojtype']))
{
	$dojtype=$_POST['dojtype'];	
}
$rowid='';
if(isset($_POST['rowid']))
{
	$rowid=$_POST['rowid'];	
}
$leavedate='';
if(isset($_POST['leavedate']))
{
	$leavedate=$_POST['leavedate'];	
}




/* echo "Difference: " . $interval->y . " years, " . $interval->m . " months, " . $interval->d . " days<br>";
echo "Months Difference: " . $monthsDifference . "<br>";
echo "Years Worked: " . $yearsWorked = $interval->y . "<br>";
echo "Total Months Worked: " . $totalMonthsWorked . "<br>"; */


$currentDate = new DateTime(); 


/* if($row2['empid']==NULL)
{
	$row2['empid']='';
}
$empid = trim($row2['empid']); 

$leavesTaken1=count($empid=='1000'); */

function getLeavesTakenPerMonth($empid) 
{
	GLOBAL $dojtype,$conn,$totalMonthsWorked;
	
	$sql6 = "select doj from emp with (nolock) where empid='$empid'";
$res6 = sqlsrv_query($conn,$sql6);
$row6 = sqlsrv_fetch_array( $res6, SQLSRV_FETCH_ASSOC);


if($row6['doj']==NULL)
{
	$row6['doj']='';
}
$doj = trim($row6['doj']);
$doj = new DateTime($doj);
$currentDate = new DateTime(); 
$interval = $doj->diff($currentDate);
$monthsDifference = ($interval->y * 12) + $interval->m;
$yearsWorked = $interval->y + ($interval->m > 0 ? 1 : 0);


$totalMonthsWorked = ($interval->y * 12 )+ $interval->m;
$totalLeaveBalance = 0;
	
	$sql = "SELECT 
    YEAR(leavedate) AS year, 
    MONTH(leavedate) AS month, 
    count(empid) AS total_leave_count
FROM 
    leave
WHERE 
    empid = '$empid'
GROUP BY 
    YEAR(leavedate), 
    MONTH(leavedate);";
    $stmt = sqlsrv_query($conn, $sql);

	
    $leavesTakenPerMonth = [];
    if ($stmt !== false) 
	{
        while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) 
		{
			$date = $row['year']."-".$row['month'];
			if($row['total_leave_count']==null){$row['total_leave_count']=0;}
            $leavesTakenPerMonth[$date] = $row['total_leave_count'];
			
        }
        sqlsrv_free_stmt($stmt);

    } 
	else 
	{
        die(print_r(sqlsrv_errors(), true));
    }
	//var_dump($leavesTakenPerMonth);
	
	

	
	$totalLeaveBalance = $totalMonthsWorked;
    $totalLeaveBalance1 = '';
	foreach ($leavesTakenPerMonth as $month => $leavesTaken1) 
{	

// $totalLeaveBalance = $totalMonthsWorked - $leavesTaken1;
	 

    if ($leavesTaken1) 
	{
			$totalLeaveBalance -=$leavesTaken1;
			$totalLeaveBalance1 = $totalLeaveBalance ;	
		

	}
		
	
	
}
//echo $totalLeaveBalance1;
return  (int)$totalLeaveBalance1;
}

//foreach()

/* $totalLeaveBalance1 = getLeavesTakenPerMonth($empid); */

$trdata1 = "";
$trdata2 = "";
$leavedate = "";
$totalLeaveBalance1 = 0;
if($totalLeaveBalance1>=0)
{	
	$trdata1 = "";
}	
else
{
	$trdata2 = "";
}
?>
<html>
<head>
<link rel="icon" href="MEFS.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
<style>
td
{
	text-align:center;
}
.sub
{
	width:15%;
	border-radius:10px;
	background-color:black;
	text-align:center;
	transition:background-color 0.3s;
	height:6%;
	color:white;
}	
.sub:hover 
{
    background:yellow;
	color:black;
}
a:link
{
text-decoration:none;
}
</style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<?php
/* $var="";
if($empid!='999')
{
	$var="and empid=$empid";
} */
if($empid=='999')
{



	$sql5 = "select leavedate,empid from leave with (nolock) where empid='$empid'";
	$res5 = sqlsrv_query($conn,$sql5);
	while($row5 = sqlsrv_fetch_array( $res5, SQLSRV_FETCH_ASSOC))
	{

		if($row5['leavedate']==NULL)
		{
			$row5['leavedate']='';
		} 	
		$leavedate = trim($row5['leavedate']);
		
/* 		if($row5['rowid']==NULL)
		{
			$row5['rowid']='';
		} 	
		$rowid = trim($row5['rowid']);	 */	
		
		if($row2['empid']==NULL)
		{
			$row2['empid']='';
		}
		$empid = trim($row2['empid']);
		
		
?>		
<div>
	<form name="main" method="get" action="viewleavedateadmin.php">
    <input type="hidden" name="empid" id="empid" value="<?php echo $empid; ?>">
    <input type="hidden" name="name" id="name" value="<?php echo $name; ?>">
    <input type="hidden" name="leavedate" id="leavedate" value="<?php echo $leavedate; ?>">
<div>

<br>
<!--<input type="submit" name="submit" value="VIEW LEAVE TAKEN DATES" class="sub">-->

</form>



<?php


	}
	
	
	
	$sql2 = "select * from emp with (nolock) where emptype='EMPLOYEE'";
	$res2 = sqlsrv_query($conn,$sql2);
	while($row2 = sqlsrv_fetch_array( $res2, SQLSRV_FETCH_ASSOC))
	{

if($row2['name']==NULL)
{
	$row2['name']='';
} 
$name = trim($row2['name']); 

if($row2['dob']==NULL)
{
	$row2['dob']='';
}
$dob = trim($row2['dob']); 

if($row2['doj']==NULL)
{
	$row2['doj']='';
}
$doj = trim($row2['doj']); 

if($row2['address']==NULL)
{
	$row2['address']='';
}
$address = trim($row2['address']); 

if($row2['gender']==NULL)
{
	$row2['gender']='';
}
$gender = trim($row2['gender']); 

if($row2['email']==NULL)
{
	$row2['email']='';
}
$email = trim($row2['email']); 

if($row2['mob']==NULL)
{
	$row2['mob']='';
}
$mob = trim($row2['mob']); 

if($row2['designation']==NULL)
{
	$row2['designation']='';
}
$designation = trim($row2['designation']); 

if($row2['dojtype']==NULL)
{
	$row2['dojtype']='';
}
$dojtype = trim($row2['dojtype']); 

if($row2['empid']==NULL)
{
	$row2['empid']='';
}
$empid = trim($row2['empid']);
if($row2['emptype']==NULL)
{
	$row2['emptype']='';
}
$emptype  =  trim($row2['emptype']);




//$totalLeaveBalance1 = getLeavesTakenPerMonth($empid);



$totalLeaveBalance1 = getLeavesTakenPerMonth($empid);
	



$color='background-color:green;';
$plus='+';

$totalLeaveBalance1 = $totalLeaveBalance1 + 1;
if($dojtype=='N')
{
$totalLeaveBalance1=$totalLeaveBalance1-1;	
}
if($totalLeaveBalance1<0)
{
$color='background-color:#f75f54;';
$plus='';
}
$trdata1 .= "
<tr style='background-color:#dbd9d7;font-family:Poppins;'>
<td>$empid</td>
<td>$name</td>
<td>$dob</td>
<td>$doj</td>
<td>$gender</td>
<td>$address</td>
<td>$email</td>
<td>$mob</td>
<td>$designation</td>
<td style='$color color:white;'>$plus $totalLeaveBalance1</td>
<td><a href='viewleavedateadmin.php?empid=$empid&name=$name&leavedate=$leavedate'><img style='width:25px;height:20px;'src='eye.png' class='edit-icon'></a></td>
</tr>
";


}




?>

<center>
<div bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" style="width:auto;height:10%;background:linear-gradient(135deg, #FFA31C , #F87412 70%, #FFA31C);">
<a style=" position: absolute; width: 53px; height: 25px; z-index: 1; left: 12px; top: 18px;" href="login.php"><img border="0" src="home1.png" width="100" height="50"></a>
<h1>
<br>
EMPLOYEE LEAVE REPORT
</h1>
</div>


</center>
<br><br>

<center>
<?php
echo "<b style='font-size:25px;font-family:Poppins;'>Leave Report as per : " . $currentDate->format('d-m-Y') . "</b><br>";
?>
</center>

<br>
<center>
<table border=2>
<tr style='background-color:#f5b482;font-family:Poppins;'>
<td>EMPLOYEE ID</td>
<td>EMPLOYEE NAME</td>
<td>DATE OF BIRTH</td>
<td>DATE OF JOINING</td>
<td>GENDER</td>
<td>ADDRESS</td>
<td>EMAIL ID</td>
<td>MOBILE</td>
<td>DESIGNATION</td>
<td>LEAVE BALANCE</td>
<td>VIEW LEAVE DATES</td>
</tr>

<?php 
echo $trdata1;
?>

</table>
</center>

<center>
<pre>
Note : The leave balance may vary after the calculations of compo leaves are added!
</pre>

</center>




<?php
}





else //INDUVIDUAL 
{

$totalLeaveBalance1 = getLeavesTakenPerMonth($empid);	

	
$sql3 = "select * from emp with (nolock) where empid='$empid'";
$res3 = sqlsrv_query($conn,$sql3);
$row3 = sqlsrv_fetch_array( $res3, SQLSRV_FETCH_ASSOC);


if($row3['name']==NULL)
{
	$row3['name']='';
} 
$name = trim($row3['name']); 

if($row3['dob']==NULL)
{
	$row3['dob']='';
}
$dob = trim($row3['dob']); 

if($row3['doj']==NULL)
{
	$row3['doj']='';
}
$doj = trim($row3['doj']); 

if($row3['address']==NULL)
{
	$row3['address']='';
}
$address = trim($row3['address']); 

if($row3['gender']==NULL)
{
	$row3['gender']='';
}
$gender = trim($row3['gender']); 

if($row3['email']==NULL)
{
	$row3['email']='';
}
$email = trim($row3['email']); 

if($row3['mob']==NULL)
{
	$row3['mob']='';
}
$mob = trim($row3['mob']); 

if($row3['designation']==NULL)
{
	$row3['designation']='';
}
$designation = trim($row3['designation']); 

if($row3['dojtype']==NULL)
{
	$row3['dojtype']='';
}
$dojtype = trim($row3['dojtype']);
if($row3['emptype']==NULL)
{
	$row3['emptype']='';
}
$emptype  =  trim($row3['emptype']); 


	
?>
<center>
<div bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" style="width:auto;height:10%;background:linear-gradient(135deg, #FFA31C , #F87412 70%, #FFA31C);">
<a style=" position: absolute; width: 53px; height: 25px; z-index: 1; left: 12px; top: 18px;" href="login.php"><img border="0" src="home1.png" width="100" height="50"></a>
<h1>
<br>
LEAVE REPORT
</h1>
</div>

<br>
<br>
<br>




<?php
echo "<b style='font-size:25px;font-family:Poppins;'>Leave Report as per : " . $currentDate->format('d-m-Y') . "</b><br>";
?>
</center>
<br><br>

<center>
<table color=black border=2>
<tr style='background-color:#f5b482;font-family:Poppins;'>
<td>EMPLOYEE ID</td>
<td>EMPLOYEE NAME</td>
<td>DATE OF BIRTH</td>
<td>DATE OF JOINING</td>
<td>GENDER</td>
<td>ADDRESS</td>
<td>EMAIL ID</td>
<td>MOBILE</td>
<td>DESIGNATION</td>
<td>LEAVE BALANCE</td>
</tr>

<tr style='background-color:#dbd9d7;font-family:Poppins;'>
<td><?php echo $empid;?></td>
<td><?php echo $name;?></td>
<td><?php echo $dob;?></td>
<td><?php echo $doj;?></td>
<td><?php echo $gender;?></td>
<td><?php echo $address;?></td>
<td><?php echo $email;?></td>
<td><?php echo $mob;?></td>
<td><?php echo $designation;?></td>



<?php

$totalLeaveBalance1 = $totalLeaveBalance1 + 1;
if($dojtype=='Y')
{
if($totalLeaveBalance1>=0)
{
?>
<td style="background-color:green;color:white;"><?php echo "+ ".$totalLeaveBalance1;?></td>
<?php
}
else
{
?>
<td style="background-color:#f75f54;color:white;"><?php echo $totalLeaveBalance1;?></td>	
<?php
}
}
else
{
$totalLeaveBalance1=$totalLeaveBalance1-1;
if($totalLeaveBalance1>=0)
{
?>
<td style="background-color:green;color:white;"><?php echo "+ ".$totalLeaveBalance1;?></td>
<?php
}
else
{
?>
<td style="background-color:#f75f54;color:white;"><?php echo $totalLeaveBalance1;?></td>	
<?php
}
}	
?>
</tr>
</table> 
</center>


<center>
<pre>
Note : The leave balance may vary after the calculations of compo leaves are added!
</pre>

</center>




</body>
</html>

<?php
}
?>

