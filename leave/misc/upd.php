<?php
include "connect.php";
$username = '';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
$password = '';
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
$empid = '';
if (isset($_POST['empid'])) {
    $empid = $_POST['empid'];
}
$name = '';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
$emptype = '';
if (isset($_POST['emptype'])) {
    $emptype = $_POST['emptype'];
}
$doj = '';
if (isset($_POST['doj'])) {
    $doj = $_POST['doj'];
}
$dojtype = '';
if (isset($_POST['dojtype'])) {
    $dojtype = $_POST['dojtype'];
}
$leavedate = '';
?>

<html>
<head>
<link rel="icon" href="MEFS.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
<style>
.edit-icon {
    width: 20px;
    height: 20px;
    display: block;
    margin: auto;
    cursor: pointer;
}
.edit-icon:hover {
    transform: scale(1.2);
}
.report {
    caret-color: transparent;
}
</style>
</head>
<body class="report" bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">

<?php
$trdata = "";
if ($empid == '999') {
    $sql = "select * from leave with (nolock) where empid='$empid'";
    $res = sqlsrv_query($conn, $sql);
    while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
        if ($row['leavedate'] == NULL) {
            $row['leavedate'] = '';
        }
        $leavedate = trim($row['leavedate']);
        
        if ($row['empid'] == NULL) {
            $row['empid'] = '';
        }
        $empid = trim($row['empid']);
    }

    $sql2 = "select * from emp with (nolock) where emptype='EMPLOYEE'";
    $res2 = sqlsrv_query($conn, $sql2);
    while ($row2 = sqlsrv_fetch_array($res2, SQLSRV_FETCH_ASSOC)) {
        if ($row2['name'] == NULL) {
            $row2['name'] = '';
        }
        $name = trim($row2['name']);

        if ($row2['empid'] == NULL) {
            $row2['empid'] = '';
        }
        $empid = trim($row2['empid']);
        if ($row2['emptype'] == NULL) {
            $row2['emptype'] = '';
        }
        $emptype = trim($row2['emptype']);
        
        $trdata .= "
        <tr>
        <td align=center style='background-color:#dbd9d7;font-family:Poppins;'>$empid</td>
        <td align=center style='background-color:#dbd9d7;font-family:Poppins;'>$name</td>
        <td style='background-color:#dbd9d7;font-family:Poppins;'>
            <a href=\"update_form.php?empid=$empid&name=$name&doj=$doj&leavedate=$leavedate&dojtype=$dojtype\">
                <img src='editicon.png' class='edit-icon'>
            </a>
        </td>
        </tr>";
    }
}
?>

<center>
<?php include "header.html"; ?>
<br><br>
<br><br>
<table border=2>
<center>
<tr>
<td align=center style='background-color:#f5b482;font-family:Poppins;'>EMPLOYEE ID</td>
<td align=center style='background-color:#f5b482;font-family:Poppins;'>EMPLOYEE NAME</td>
<td align=center style='background-color:#f5b482;font-family:Poppins;'>ACTION</td>
</tr>

<?php echo $trdata; ?>

</center>
</table>
</center>

</body>
</html>
