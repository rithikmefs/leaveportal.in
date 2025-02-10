<html>
<head>
<style>

</style>

<?php
include "connect.php";
$empid='';
if(isset($_POST['empid']))
{
	$empid=$_POST['empid'];
}

$name='';
if(isset($_POST['name']))
{
	$name=$_POST['name'];
}


if($empid!='999')
{
	$sql2 = "select name from emp with (nolock) where empid='$empid'";
	$res2 = sqlsrv_query($conn,$sql2);
	while($row2 = sqlsrv_fetch_array( $res2, SQLSRV_FETCH_ASSOC))
	{
		if($row2['name']==NULL)
		{
			$row2['name']='';
		}
		$name = trim($row2['name']);		
	}	
} 
?>


<center>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
<div bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" style="width:auto;height:10%;background:linear-gradient(135deg, #FFA31C , #F87412 70%, #FFA31C);">
<a style=" position: absolute; width: 53px; height: 25px; z-index: 1; left: 12px; top: 18px;" href="login.php"><img border="0" src="home1.png" width="100" height="50"></a>
<h1>
<br>
UPDATE PERSONNAL DETAILS
</h1>
</div>
<br><br>



<?php
echo "HELLO ".$name;
?>

</body>