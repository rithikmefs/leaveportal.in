<html>
<head>
<link rel="icon" href="MEFS.png">
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
.edit-icon 
{
    width: 20px;
    height: 20px;
    display: block;
    margin: auto;
    cursor: pointer;
}
.edit-icon:hover 
{
    transform: scale(1.2); 
}
.report
{
	caret-color:transparent;
}
th,td
{
	padding:2px;
}
</style>
</head>


<?php
include "connect.php";
include "header.html";



$empid='';
if(isset($_POST['empid']))
{
	$empid=$_POST['empid'];
}
/* $name='';
if(isset($_POST['name']))
{
	$name=$_POST['name'];
} */


$var1="YOU HAVE MARKED";
$var2="AS LEAVE ON";


?>



<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">


<?php
$trdata = "";


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
	
	$sql3 = "SELECT name,empid FROM [MISGlobal].[dbo].[emp] WITH (NOLOCK) WHERE empid='$empid'";
	$res3 = sqlsrv_query($conn, $sql3);
	while($res3 && $row3 = sqlsrv_fetch_array($res3, SQLSRV_FETCH_ASSOC))
    {
    	$name = isset($row3['name']) ? trim($row3['name']) : '';
		$empid = isset($row3['empid']) ? trim($row3['empid']) : '';
		
    }


	
	header("Location: markleave.php?empid=$empid&leavedate=$leavedate&name=$name");
    exit();
	
}
$name = isset($_GET['name']) ? $_GET['name'] : '';
$leavedate = isset($_GET['leavedate']) ? $_GET['leavedate'] : '';


?>

<center>
    <br><br><br>
    <form method="post" action="markleave.php">
        <label for="empid" style="font-family:Poppins;margin-left:50px;">Select Employee - </label>
        <input style="width:210px;height:35px;border-radius:8px;" type="text" id="empid" name="empid" required placeholder="Enter the Employee id eg:- 1003"> <br><br>
        <label for="leavedate" style="font-family:Poppins;margin-left:85px;">Select Date - </label>
        <input style="border-color:black;width:200px;height:35px;border-radius:8px;" type="date" id="leavedate" name="leavedate" required placeholder="Select the Date">
        <br><br>
        <input type="submit" value="MARK LEAVE ON THIS DATE" class="sub">
		
<?php
	
	if (isset($name) && $name != '')
	{ 
	?>

	<center>
	<pre>
	<?php echo $var1." ".$name." ".$var2." ".$leavedate; ?>
	</pre>
	</center>
	<?php 

	}	
		
	?>	
		
    </form>
	
</center>




<?php


	$sql2 = "select * from emp with (nolock) where emptype='EMPLOYEE'";
	$res2 = sqlsrv_query($conn,$sql2);
	while($row2 = sqlsrv_fetch_array( $res2, SQLSRV_FETCH_ASSOC))
	{
		if($row2['name']==NULL)
		{
			$row2['name']='';
		} 
		$name = trim($row2['name']); 

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
		
		?>	
	
<?php
	$trdata .= "
	<tr>
	<td align=center style='background-color:#dbd9d7;font-family:Poppins;'>$empid</td>
	<td align=center style='background-color:#dbd9d7;font-family:Poppins;'>$name</td>
	</tr>";
	
	
	
	}
	
?>





<br><br><br>
<center>
<table class="report">
<tr>
<td align=center style='background-color:#f5b482;font-family:Poppins;'>EMPLOYEE ID</td>
<td align=center style='background-color:#f5b482;font-family:Poppins;'>EMPLOYEE NAME</td>
</tr>


<?php 
echo $trdata;

?>


</table>
</center>
</body>
</html>