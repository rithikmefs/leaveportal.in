<?php
session_start();
include "connect.php";

$empid = '';
if (isset($_SESSION['empid'])) 
{
    $empid = $_SESSION['empid'];
}

$current = '';
if (isset($_POST['current'])) 
{
    $current = $_POST['current'];
}

$new = '';
if (isset($_POST['new'])) 
{
    $new = $_POST['new'];
}

$confirm = '';
if (isset($_POST['confirm'])) 
{
    $confirm = $_POST['confirm'];
}

$submit = '';
if (isset($_POST['submit'])) 
{
    $submit = $_POST['submit'];
}

//echo "CURRENT PASSWORD - ".$current."<br>";
//echo "NEW PASSWORD - ".$new."<br>";
//echo "CONFIRM PASSWORD - ".$confirm."<br>";


		$sql = "select password from emp WITH (NOLOCK) WHERE empid = '$empid'";
	   
		$res = sqlsrv_query($conn, $sql);
		if ($res) 
		{
			while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) 
			{
				$password = isset($row['password']) ? trim($row['password']) : '';
			}
		}


 
	
?>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="../leave/images/MEFS.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"> 
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
   
<style>
.sub1 
{
    width: 7%;
    border-radius: 5px;
    background-color: #665763;
    font-size: 14px;
    transition: background-color 0.3s;
    height: 6%;
    color: white;
    margin: 0;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.2s ease;
}

.sub1:hover 
{
    transform: scale(1.05);
}

.sub2 
{
    width: 7%;
    border-radius: 5px;
    background-color: #28373E;
    font-size: 14px;
    transition: background-color 0.3s;
    height: 6%;
    color: white;
    margin: 0;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.2s ease;
}

.sub2:hover 
{
    transform: scale(1.05);
}

a:link 
{
    text-decoration: none;
}


.input-container input
{
	 padding: 30px;
}


.input-container 
{
    position: relative;
    display: inline-block;
}

.input-container i 
{
	position: absolute;
	top: 50%;
	right:20px;
	transform: translateY(-50%);
	font-size: 20px;
	color: #707070;
}
.input-container.toggle-password 
{
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666;
}
	  .input-container .toggle-password:hover 
	  {
	    color: #333;
		cursor: pointer;
	  }	


</style>

<script>
function togglePasswordVisibility(id) 
{
    const input = document.getElementById(id);
    const icon = document.querySelector(`.toggle-password[data-target='${id}']`);
    
    if (input.type === "password") 
	{
        input.type = "text";
        icon.classList.remove("uil-eye-slash");
        icon.classList.add("uil-eye");
    } 
	else 
	{
        input.type = "password";
        icon.classList.remove("uil-eye");
        icon.classList.add("uil-eye-slash");
    }
}
</script>
</head>

<body style="" bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
    <center>
        <br><br>
        <br><br>
		<h1><b style='font-size:25px;font-family:Poppins;margin-left:-60;'>Reset Password</b></h1>
        <div style='background-color:#FFFFFF;border-radius:10px;width:45%;margin-left:-80;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>
            <br>
            <form method="post" action="">
                <div class="custom-select">
                    <br><br>
                    <!-- Current Password -->
                    <label style="caret-color:transparent;margin-left:0;font-family:poppins;" for="current">
                        <b style="margin-left:50;">Current Password - </b>
                    </label>
                    &nbsp;
                    <div class="input-container">
                        <input style="border-color:black;height:6%;width:245px;font-family:poppins;font-size:14px;padding:10px;" 
                               type="text" placeholder="Enter current password" id="current" name="current" required>
					<!--- 	<i class="uil uil-lock password"></i>	   
                        <i class="uil uil-eye-slash toggle-password" data-target="current" ></i> -->
                    </div>
                    <br><br><br>

                    <!-- New Password -->
                    <label style="caret-color:transparent;margin-left:-8;font-family:poppins;" for="new">
                        <b style="margin-left:85;">New Password - </b>
                    </label>
                    &nbsp;
                    <div class="input-container">
                        <input style="border-color:black;height:6%;width:245px;font-family:poppins;font-size:14px;padding:0 40px 0px 10px;" 
                               type="password" placeholder="Enter new password" id="new" name="new" minlength="6" 
							   title="Password must be at least 6 characters long." required>
						
                        <i class="uil uil-eye-slash toggle-password" data-target="new" onclick="togglePasswordVisibility('new')"></i>
                    </div>
                    <br><br><br>

                    <!-- Confirm Password -->
                    <label style="caret-color:transparent;margin-left:-8;font-family:poppins;" for="confirm">
                        <b style="margin-left:55;">Confirm Password - </b>
                    </label>
                    &nbsp;
                    <div class="input-container">
                        <input style="border-color:black;height:6%;width:245px;font-family:poppins;font-size:14px;padding:0 40px 0px 10px;" 
                               type="password" placeholder="Enter new password" id="confirm" name="confirm" minlength="6" 
							   title="Password must be at least 6 characters long." required>
						   
                        <i class="uil uil-eye-slash toggle-password" data-target="confirm" onclick="togglePasswordVisibility('confirm')"></i>
                    </div>
                </div>
                <br><br><br>
        </div>
		<?php
		if($empid == '999' || $empid == '1108')
		{	
			?>
			<input style="font-family:poppins;font-size:15px;caret-color:transparent;margin-left:-80;text-align:center;display:inline-block;" type="submit" name="submit" value="RESET" class="sub1">
			<?php
		}
		else
		{	
			?>
			<input style="font-family:poppins;font-size:15px;caret-color:transparent;margin-left:-80;text-align:center;display:inline-block;" type="submit" name="submit" value="RESET" class="sub2">
			<?php		
		}
		?>
		</form>
		<br>

<script>

document.querySelector('form').addEventListener('submit', function(e) 
{
    const newPassword = document.getElementById('new').value;
    const regex = /^(?=.*[0-9])(?=.*[\W_]).{6,}$/;

    if (!regex.test(newPassword)) 
	{
        alert("Password must be at least 6 characters long, include at least one number, and one special character.");
        e.preventDefault(); 
    }
});



document.querySelector('form').addEventListener('submit', function(e) 
{
    const newPassword = document.getElementById('confirm').value;
    const regex = /^(?=.*[0-9])(?=.*[\W_]).{6,}$/;

    if (!regex.test(newPassword)) 
	{
        alert("Password must be at least 6 characters long, include at least one number, and one special character.");
        e.preventDefault(); 
    }
});

</script>


<?php

if ($submit) 
{
    if ($password != $current) 
	{
        echo "<div id='msg' style='color:red;font-family:Poppins;margin-left:-92px;'>
                <br><b>Current password is wrong</b><br>
              </div>";
    } 
	elseif ($new == $current) 
	{
        echo "<div id='msg' style='color:red;font-family:Poppins;margin-left:-78px;'>
                <br><b>Current password and New password is same</b><br>
              </div>";
    } 
	elseif ($new != $confirm) 
	{
        echo "<div id='msg' style='color:red;font-family:Poppins;margin-left:-75px;'>
                <br><b>New password and Confirm password vary</b><br>
              </div>";
    } 
	elseif ($new == $confirm) 
	{
        $sql5 = "UPDATE emp SET password='$new' WHERE empid = '$empid'";
        $res5 = sqlsrv_query($conn, $sql5);
        echo "<div id='msg' style='color:green;font-family:Poppins;margin-left:-90px;'>
                <br><b>Password updated successfully</b><br>
              </div>";
    }

    echo "<script>
            setTimeout(function() 
			{
                var msg = document.getElementById('msg');
                if (msg) 
				{
                    msg.style.display = 'none';
                }
            }, 5000); // 5000ms = 5 seconds
          </script>";
}


?>
		
		
    </center>
</body>
</html>
