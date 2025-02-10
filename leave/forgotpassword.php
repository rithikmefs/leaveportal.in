<?php
session_start();
include "connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$sql1="select name from emp with(nolock) where emptype='ADMIN' and designation='HEAD OF OPERATIONS'";
$result1 =sqlsrv_query( $conn, $sql1 ); 					
$row1 = sqlsrv_fetch_array( $result1, SQLSRV_FETCH_ASSOC);
$sname='';if(isset($row1['name'])){$sname=$row1['name'];}	
?>

<html>
<head>
<link rel="icon" href="../leave/images/MEFS.png">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mefs - Leave Portal</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
<style>
a
{
	text-decoration:none;
}

        #frm {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 50px auto;
        }
        
        h3 {
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        td 
		{
            padding: 10px 0;		
        }
        
        input[type="text"] 
		{
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            display: inline-block;
            border: none;
            border-radius: 8px;
            box-sizing: border-box;
			background-color: #ffefd7;
        }

         input[type="email"] 
		{
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            display: inline-block;
            border: none;
            border-radius: 8px;
            box-sizing: border-box;
			background-color: #ffefd7;
        }
		
        input[type="submit"] 
		{
            width:50%;
			margin-left:200px;
			background-color: #FD9719;
			color: #FFF;
			padding: 10px 15px;
			margin: 10px 0;
			border: none;
			border-radius: 4px;
			cursor: pointer;
        }
        
        input[type="submit"]:hover 
		{
            background-color: #FA7E14;
        }
		
</style>
<body class="report" rightmargin="0" leftmargin="0" bottommargin="0" topmargin="0">

	<script>
	function pageload(id)
		{
			if (window.opener != null && !window.opener.closed)
			{ 
				var c='login.php?empid='+id;
				var cl=parent.opener.location.href=c;
			}
			else
			{
				alert('No login Page detected\nClose this window and open the application and login');  
    
			}
			window.close();
			
		}
	</script>
		<?php
		
		$flag = 0;	
		if(isset($_POST['submit']))
		{
			 $user='';  if(isset($_POST['username']))  { $user=$_POST['username'];}
			 $email=''; if(isset($_POST['email']))  {$email=$_POST['email'];}
			 $sql="select * from emp with(nolock)where username='$user' and email='$email'";
			 $result1 = sqlsrv_query($conn,$sql);
			
			   $row1 = sqlsrv_fetch_array($result1,SQLSRV_FETCH_ASSOC);
			   if($row1)
			   {
				   $uname=$row1['username'];
				   $empid=$row1['empid'];
				   $name=$row1['name'];
				   $nameParts = explode(' ', strtolower($name)); // convert to lowercase first
				   $name1 = ucfirst($nameParts[0]);  // capitalize the first letter
				   $password=$uname."".$empid;
				   $update="update emp set password='$password' where empid=$empid";
				   $up1= sqlsrv_query($conn,$update);
				 
					 //mail
					 
					    $sele="select * from [MISGlobal].[dbo].[cmpinfo] with(nolock)";
						$output =sqlsrv_query( $conn, $sele ); 					
						$result = sqlsrv_fetch_array( $output, SQLSRV_FETCH_ASSOC);
						$cmpname='';if(isset($result['cmpname'])){$cmpname=$result['cmpname'];}
						$cmpemail='';if(isset($result['cmpemail'])){$cmpemail=$result['cmpemail'];}
						$cmppass='';if(isset($result['cmppass'])){$cmppass=$result['cmppass'];}
						$cc='';if(isset($result['ccmail'])){$cc=$result['ccmail'];}
						$hostname='';if(isset($result['hostname'])){$hostname=$result['hostname'];}

					$subject = "Temporary Password ";
					$msg="Dear ".$name1.", <br><br>
					The Temporary Password for Login your Profile in <b>Mefs - Leave Portal</b> is <font color='blue'>"
					.$password."</font> <br><br><b> Thank You!</b> <br><br>--<br><b><font color='red'>Thanks and regards,</b></font><br><b>Head of Operations</b><br><b>Middle East Financial Software Solutions</b>,<br><b>Purakkad Square, Vyttila, Kochi</b><br><i>0484 4855329/<font color='blue'><u>info@mefs.in</u></font></i>";
					
					$mail = new PHPMailer(true);
	
					try 
					{
						// Server settings
						$mail->isSMTP(); // Use SMTP
						$mail->Host       = $hostname; 
						$mail->SMTPAuth   = true; 
						$mail->Username   = $cmpemail; 
						$mail->Password   = $cmppass; 
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
						$mail->Port       = 587; 

						// Recipients
						$mail->setFrom($cmpemail, $sname); 
						$mail->addAddress($email, $name); 

						// Content
						$mail->isHTML(true); 
						$mail->Subject = $subject;
						$mail->Body    = "<b>Middle East Financial Software Solutions</b><p>".$msg."</p>";
						//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						// Send email
						$mail->send();
						 echo "<script>alert('Your temporary password has been delivered via mail.'); pageload($empid);</script>";
					} 
					catch (Exception $e) 
					{
						echo "<script>alert('Email could not be sent. Mailer Error: {$mail->ErrorInfo}'); window.location.href = 'forgotpassword.php';</script>";
					}
					
					
			}
			else
			{
				$flag = 1;
				$error = "<b style='color:red;margin-bottom:50px;font-family:poppins'>Please enter valid credentials</b>";
			}
	    
			
	   } 


		?>
				<form name="frm" id="frm" method="POST" >
				<h3 align="center" style='font-family:poppins'>Forgot Password</h3>
				<table align="center">
					<tr>
						<td style='font-family:poppins'>USERNAME</td>
						<td><input type="text" id="username" name="username" value="" required></td>
					</tr>
					<tr>
						<td style='font-family:poppins'>EMAIL ID</td>
						<td><input type="text" id="email" name="email" value="" required></td>
					</tr>
					<tr>						
						<td style='font-family:poppins'></td>	
						<td><input type="submit" style='margin-left:100px;width:80px;' id="submit" name="submit" value="Send"></td>
					</tr>
				</table>
				<?php
				if($flag == 1)
				{		
					echo $error;
				}
				?>
				</form>
	
	</body>
</html>







<?php

?>