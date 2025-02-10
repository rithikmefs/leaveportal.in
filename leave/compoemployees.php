<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" href="../leave/images/MEFS.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
<style>
tr.dis:hover 
{
	background-color:#cbcdd1;
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
</style>
<script>

  function Popup(empid) 
  {
      console.log("Popup called with empid:", empid); // Debugging
      if (confirm("Are you sure you want to clear all compo leaves for this employee?")) 
	  {
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "clearcompo.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

          xhr.onreadystatechange = function () 
		  {
              if (xhr.readyState === 4 && xhr.status === 200) 
			  {
                  alert(xhr.responseText);
                  location.reload();
              }
          };
          xhr.send("empid=" + encodeURIComponent(empid));
      }
  }
 
function callPopup(empid) 
{
    if (window.opener && !window.opener.closed) 
	{
      if (confirm("Are you sure you want to clear all compo leaves for this employee?")) 
	  {
          var xhr = new XMLHttpRequest();
          xhr.open("POST", "clearcompo.php", true);
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

          xhr.onreadystatechange = function () 
		  {
              if (xhr.readyState === 4 && xhr.status === 200) 
			  {
                  alert(xhr.responseText);
                  location.reload();
              }
          };
          xhr.send("empid=" + encodeURIComponent(empid));
      }
        window.close();
    } 
	else 
	{
        alert("Try again after sometime.");
    }
}
 

function clearCompoLeave(empid, name) 
{
	
    var firstName = name.split(" ")[0];
    firstName = firstName.charAt(0).toUpperCase() + firstName.slice(1).toLowerCase();

    if (confirm("Are you sure you want to clear all Compo Leaves for " + firstName + "?")) 
	{
        fetch('clearcompo.php',
		{
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'empid=' + encodeURIComponent(empid) + '&name=' + encodeURIComponent(firstName)
        })
        .then(response => response.text())
        .then(data => 
		{
            alert(data.trim());
            location.reload();
            if (data.includes("successfully")) 
			{
                if (window.opener && !window.opener.closed) 
				{
                    window.opener.alertFromPopup(empid); 				
                }
                setTimeout(() => 
				{
                    if (window.self !== window.top) 
					{
                        window.close();
                    } 
					else 
					{
                        console.log('This is the main window, cannot close.');
                    }
                }, 1000); 
            }
                setTimeout(() => 
				{
                    if (window.self !== window.top) 
					{
                        window.close();
                    } 
					else 
					{
                        console.log('This is the main window, cannot close.');
                    }
                }, 1000); 			
        })
        .catch(error => 
		{
            console.error('Error:', error);
            alert("Failed to clear record.");
        });
    }
}

	

 
</script>

</head>
<body style="caret-color:transparent;" bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">	

<?php
session_start();
include "connect.php"; 

date_default_timezone_set("Asia/Kolkata");

$sql1 = "SELECT e.empid, e.name, COALESCE(COUNT(c.compodate), 0) AS compobalance 
		 FROM emp e
		 LEFT JOIN compo c ON e.empid = c.empid
		 WHERE e.empid NOT IN ('1108', '1070') 
		 AND e.emptype != 'TEST' AND e.flag!='N'
		 GROUP BY e.empid, e.name, e.dob
         ORDER BY e.dob;";

$result1 = sqlsrv_query($conn, $sql1);

if ($result1 === false) 
{
    echo "<p style='color: red; text-align: center;'>Error fetching data.</p>";
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($result1)) 
{
    echo "<br><table style='width:100%; border-collapse: collapse;z-index:999;'>";
    echo "<tr style='position:sticky;top:-2px;font-family:poppins;'>
            <th style='border: 1px solid #ccc;font-family:poppins;background-color:#E6EAF0;'>Employee ID</th>
            <th style='border: 1px solid #ccc;font-family:poppins;background-color:#E6EAF0;'>Employee Name</th>
            <th style='border: 1px solid #ccc; font-family:poppins;background-color:#E6EAF0;'>Compo Balance</th>
            <th style='border: 1px solid #ccc;font-family:poppins;background-color:#E6EAF0;'>Action</th>
          </tr>";

    while ($row10 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC)) 
    {
        $empid = $row10['empid'] ?? '';
        $name = $row10['name'] ?? '';
        $compobalance = $row10['compobalance'] ?? '0'; // Default to 0 if NULL
		
		$color = ($compobalance == '0') ? "background-color:#ffe28a;" : 'background-color:#079107;color:#fff;';

		echo "<tr class='dis' style='font-family:poppins;'>
				<td align=center style='border: 1px solid #ccc; font-family:poppins;padding: 6px;'>$empid</td>
				<td align=center style='border: 1px solid #ccc; font-family:poppins;padding: 6px;'>$name</td>
				<td align=center style='$color border: 1px solid #ccc; font-family:poppins;'>$compobalance</td>
				<td style='font-family:Poppins;'>
					<img src='../leave/images/trashbin.png' class='edit-icon' alt='Delete' 
					onclick=\"clearCompoLeave('$empid','$name');\"  
					            title='Clear all compo leaves'>
				</td>
			  </tr>";

    }

    echo "</table>";
} 
else 
{
    echo "<p style='text-align:center;'>No Data.</p>";
}
//onclick='openPopup(\"$empid\")'
?>


</body>
</html>
