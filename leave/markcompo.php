<html>
<head>
<link rel="icon" href="../leave/images/MEFS.png">
<script>

  
</script>

<style>
select 
{
    border-color: black;
	border:5px;
    width: 245px;
    font-family: Poppins;
    font-size: 14px;
    position: relative;
}
select:focus 
{
    transform-origin: top; /* Ensures it opens downward */
}
.sub
{
	width:9%;
	border-radius:8px;
	background-color:#665763;
	text-align:center;
	font-family:poppins;
	font-size:15px;
	transition:background-color 0.3s;
	height:8%;
	color:white;
    margin: 0;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.2s ease;	
}	
.sub:hover 
{
	transform: scale(1.05);
}
.sub1
{
	width:38%;
	border-radius:8px;
	background-color:#665763;
	text-align:center;
	font-family:poppins;
	font-size:14px;
	transition:background-color 0.3s;
	height:8%;
	color:white;
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
	width:13%;
	border-radius:8px;
	background-color:#665763;
	text-align:center;
	font-family:poppins;
	font-size:15px;
	transition:background-color 0.3s;
	height:7%;
	color:white;
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
text-decoration:none;
}

		.close-btn 
		{
			position: absolute;
			top: 0px;
			right: 15px;
			font-size: 40px;
			font-weight: bold;
			color: #333;
			cursor: pointer;
			background: none;
			border: none;
			outline: none;
		}
		
		.close-btn:hover 
		{
			color: #f44336; /* Red on hover */
		}

</style>
</head>
<body style="caret-color:transparent;" bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">	



<?php
session_start();
include "connect.php";


if(isset($_POST['empid']))
{
    $empid = $_POST['empid'];
}

$compodate='';
if(isset($_POST['compodate']))
{
    $compodate = $_POST['compodate'];
}


if(isset($_POST['compodate']))
{
    $compodate = $_POST['compodate'];
	$_SESSION['selectedcompodate'] = $compodate;
}


    $options = [];////////////////////
		
	$sql3 = "SELECT name,empid FROM emp WITH (NOLOCK) WHERE flag='Y' AND empid!='1118' AND empid!='1119' ORDER BY name";
	$res3 = sqlsrv_query($conn, $sql3);
	if ($res3) 
	{
		
        while ($row3 = sqlsrv_fetch_array($res3, SQLSRV_FETCH_ASSOC)) 
		{
			$empid1 = isset($row3['empid']) ? trim($row3['empid']) : '';
			$name1 = isset($row3['name']) ? trim($row3['name']) : '';
			$options[] = "<option value='$empid1'>$name1</option>";
        }
	}	


ob_start();
include "header2.html";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $empid = isset($_POST['empid']) ? trim($_POST['empid']) : '';
    $compodate = isset($_POST['compodate']) ? trim($_POST['compodate']) : '';

    if (!empty($empid) && !empty($compodate)) 
    {
		
        $sql2 = "INSERT INTO [MISGlobal].[dbo].[compo] (empid, compodate)
                 SELECT ?, ? 
                 WHERE NOT EXISTS 
                 (SELECT 1 FROM [MISGlobal].[dbo].[compo] WHERE empid = ? AND compodate = ?)";

        $params = [$empid, $compodate, $empid, $compodate];
        $res2 = sqlsrv_query($conn, $sql2, $params);

        $date = DateTime::createFromFormat('Y-m-d', $compodate);
        $cd = $date ? $date->format('d-m-Y') : '';

        $sql5 = "SELECT name FROM emp WITH (NOLOCK) WHERE empid = ?";
        $res5 = sqlsrv_query($conn, $sql5, [$empid]);

        $name = "";
        if ($res5 && $row5 = sqlsrv_fetch_array($res5, SQLSRV_FETCH_ASSOC)) 
        {
            $name = isset($row5['name']) ? trim($row5['name']) : '';
        }
    
	    $rowsAffected = sqlsrv_rows_affected($res2);
        
		if ($rowsAffected > 0) 
		{
            $_SESSION['message'] = "<p style='color:black;caret-color:transparent;font-family:poppins;margin-left:350;'>You have marked <strong>$cd</strong> as compensatory attendance for <strong>$name</strong></p>";
			
			date_default_timezone_set("Asia/Kolkata");
			$time = date('Y-m-d H:i:s');	


			$sql1 = "INSERT INTO msg (senderid, receiverid, message, timestamp, isread, status, typing) 
					VALUES (?, ?, ?, ?, ?, ?, ?)";//ARUN
			$param1 = 
			[
				'999',
				$empid,
				"Compo Attendance marked for you on $cd. Thankyou!",
				$time, 
				'0', 
				'UNREAD',
				'N' 
			];

			// Execute the query
			$stm1 = sqlsrv_query($conn, $sql1, $param1);			
			
        } 
		else 
		{
            $_SESSION['message'] = "<b><p style='color:red;caret-color:transparent;font-family:poppins;margin-left:320;'>Compensatory attendance has already been marked for $name on $cd</p></b>";
        }
    }

    header("Location: markcompo.php");
    exit();
}

// Prevent unwanted output from affecting headers
ob_end_flush();

$selectedcompodate = isset($_SESSION['selectedcompodate']) ? $_SESSION['selectedcompodate'] : '';


?>
    
	<br><br>
	<b style='font-size:25px;font-family:Poppins;font-weight:bold;margin-left:516;'>Compensatory Attendance</b>
	<br><br><br>
<button type="button" class="sub2" style="margin-left:800px;" onclick="eligibleEmployees()">COMPO EMPLOYEES</button>

<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;"></div>

<script>
var compoPopup;

function eligibleEmployees() 
{
    compoPopup = window.open("compoemployees.php", "CompoPopup", "width=800,height=600");

    if (!compoPopup || compoPopup.closed || typeof compoPopup.closed == "undefined") 
	{
        alert("Popup blocked! Please allow popups for this site.");
    }
}

function alertFromPopup(empid) 
{
    //alert("Compo Leaves for Employee ID " + empid + " have been cleared successfully!");
                setTimeout(() => 
				{
                    window.close();
                },  1000); 	
}


/* window.onload = function() 
{
    
	var message = "<?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?>"; 
    if (message !== '') 
	{
        document.body.insertAdjacentHTML('beforeend', message);
        setTimeout(function() 
		{
            var messageElement = document.getElementById('compMessage');
            if (messageElement) 
			{
                messageElement.style.display = 'none';
            }
        }, 3000);  
    }
}; */


</script>

	
	<br><br>
	<div style='background-color:#FFFFFF;border-radius:10px;width:45%;margin-left:350;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>
    <form method="post" action="">
	<div class="custom-select">
	<br><br>
        
		<div style="position: relative;">
		<label style="caret-color:transparent;margin-left:0;" for="empid"><b style="margin-left:113;">Select Employee - </b></label>	
		&nbsp;
		<select style="border-color:black;width:245px;font-family:poppins;font-size:14px;position:absolute;top:-8px;" name="empid" id="empid" required>
		<option value="" disabled selected>Select an Employee</option>
		<?php 
		foreach($options as $option) 
		{
			echo $option;
		} 
		?>
		</select>
		</div>

		
       &nbsp;&nbsp;
       &nbsp;&nbsp;
	   
	   <br><br><br>
	   
        <label style="caret-color:transparent;margin-left:-14;" for="compodate"><b style="margin-left:111;">Compensate Date - </b></label>
        &nbsp;
		<input style="border-color:black;height:6%;width:245px;font-family:poppins;font-size:14px;padding:10px;margin-left:-2;" type="date" placeholder="Pick a Date" id="compodate" name="compodate" value="<?php echo $selectedcompodate; ?>"  required>
		
		

        &nbsp;&nbsp;
        &nbsp;&nbsp;
		
		<br><br>
		
		
	</div>
	<br>
	</div>
        
        <input style="caret-color:transparent;margin-left:610;" type="submit" value="MARK COMPO" class="sub" >
    </form>
	
	<?php 
	if (isset($_SESSION['message'])) 
	{
        echo "<p>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
	}
	?>

</center>
<br><br>
<script>

</script>


</body>

</html>

<!--////////////////////////////////////////////-->
