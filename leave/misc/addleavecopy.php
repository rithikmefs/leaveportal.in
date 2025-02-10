<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
<style>
.sub
{
	width:13%;
	border-radius:10px;
	background-color:black;
	text-align:center;
	transition:background-color 0.3s;
	height:5%;
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
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" style="background-color:#dbd9d7";>	


<div style="width:auto;height:10%;background:linear-gradient(135deg, #FFA31C , #F87412 70%, #FFA31C);">
<a style=" position: absolute; width: 53px; height: 15px; z-index: 1; left: 12px; top: 9px;" href="login.php"><img border="0" src="back.gif" width="84" height="20"></a>
<center>
<h1>
<br>
MARK LEAVE
</h1>
</div>
<?php
include "connect.php";

$empid = isset($_POST['empid']) ? $_POST['empid'] : '';
$leavedate = isset($_POST['leavedate']) ? $_POST['leavedate'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $sql2 = "INSERT INTO [MISGlobal].[dbo].[leave] (empid, leavedate) VALUES ('$empid', '$leavedate')";
    sqlsrv_query($conn, $sql2);



    $sql4 = "SELECT * FROM [MISGlobal].[dbo].[leave] WHERE empid='$empid'";
    $res4 = sqlsrv_query($conn, $sql4);
    while($res4 && $row4 = sqlsrv_fetch_array($res4, SQLSRV_FETCH_ASSOC))
    {
		$leavedate = isset($row4['leavedate']) ? trim($row4['leavedate']) : '';
		$empid = isset($row4['empid']) ? trim($row4['empid']) : '';
	}
	
		$sql3 = "SELECT name FROM emp WITH (NOLOCK) WHERE empid='$empid'";
		$res3 = sqlsrv_query($conn, $sql3);
	while($res3 && $row3 = sqlsrv_fetch_array($res3, SQLSRV_FETCH_ASSOC))
    {
    	$name = isset($row3['name']) ? trim($row3['name']) : '';
    }
	header("Location: addleave.php?empid=$empid&leavedate=$leavedate&name=$name");
    exit();
}
$name = isset($_GET['name']) ? $_GET['name'] : '';
$leavedate = isset($_GET['leavedate']) ? $_GET['leavedate'] : '';


?>

<center>
    <br><br>
    <br><br>
    <form method="post" action="addleave.php">
        <label for="empid" style="font-family:Poppins;margin-left:20px;">Select Employee - </label>
        <input type="text" id="empid" name="empid" required> <br><br>
        <label for="leavedate" style="font-family:Poppins;">Select date - </label>
        <input type="date" id="leavedate" name="leavedate" required>
        <br><br><br>
        <input type="submit" value="MARK LEAVE ON THIS DATE" class="sub">
    </form>
</center>

<?php if (isset($name) && $name != ''){ ?>

    <center>
        <pre>
YOU HAVE MARKED <?php echo $name; ?> AS LEAVE ON <?php echo $leavedate; ?>
        </pre>
    </center>
<?php } ?>



<!--////////////////////////////////////////////-->

<?php

if($empid=='9')
{
?>	
<table>

<tr>
<td> LEAVES TAKEN </td>
</tr>
<?php 
echo $trdata;
?>




		$trdata .="<tr>
		<td>$leavedate</td>
		</tr>";





</center>
</table>

<?php
}
?>