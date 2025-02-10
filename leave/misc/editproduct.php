
<?php
session_start();
include "connect.php";
$token =''; if(isset($_SESSION["accessToken"])){$token=$_SESSION["accessToken"];}
$user =''; 	if(isset($_SESSION['user'])){ $user= $_SESSION['user'];}
//echo $token;
/*  if ($token=='') {
   header("Location: index.php");
    exit();
}  */


$countryoption = '';
$currencyoption='';
$imtprductoption='';
$imtproductarr=array();
$currencyarr=array();


$gcountry='';  if(isset($_GET['country'])){$gcountry=trim($_GET['country']);} 
$gproductmode = ''; if(isset($_GET['productmode'])){$gproductmode=trim($_GET['productmode']);}
$gproduct = ''; if(isset($_GET['product'])){$gproduct=trim($_GET['product']);}
$gdelivery = ''; if(isset($_GET['delivery'])){$gdelivery=trim($_GET['delivery']);}
$gcurrency = ''; if(isset($_GET['currency'])){$gcurrency=trim($_GET['currency']);}
$gstatus = ''; if(isset($_GET['status'])){$gstatus=trim($_GET['status']);}

  if(isset($_POST['country'])){$gcountry=trim($_POST['country']);} 
if(isset($_POST['delmode'])){$gproductmode=trim($_POST['delmode']);}
 if(isset($_POST['product'])){$gproduct=trim($_POST['product']);}
if(isset($_POST['deltype'])){$gdelivery=trim($_POST['deltype']);}
 if(isset($_POST['currency'])){$gcurrency=trim($_POST['currency']);}
 $gagentid='';	if(isset($_POST['agentid'])){$gagentid=trim($_POST['agentid']);}
 $accessOption='';	if(isset($_POST['accessOption'])){$accessOption=trim($_POST['accessOption']);}
//echo "$gcountry::$gproductmode::$gproduct::$gdelivery::$gcurrency";
if($accessOption=='enable'){$accessOption='';}
if($accessOption=='disable'){$accessOption='D';}


$deltype=$gdelivery;
if($gdelivery=="ACCOUNT"){$gdelivery='AC';}
if($gdelivery=="CASH"){$gdelivery='CP';}
if($gdelivery=="MOBILE"){$gdelivery='MOB';}



$sql = "select * from instaproduct";
$res = sqlsrv_query($conn,$sql);
while($row = sqlsrv_fetch_array($res,SQLSRV_FETCH_ASSOC)){
	$imtprodcd = $row['prodcd'];
	$imtprodname= $row['prodname'];
	$imtproductarr[$imtprodcd]=$imtprodname;
	
}

$sql1 = "select * from country where txn<>'D'"; 
$res1 = sqlsrv_query($conn,$sql1);
 while($row1 = sqlsrv_fetch_array($res1, SQLSRV_FETCH_ASSOC)){
	 $ccode = $row1['ccode3'];
	 $currency = $row1['currency'];
	 $country = $row1['cname'];
	 $currencyarr[$ccode]=$currency;
	 
	 if($ccode==$gcountry){$sel='selected';}else{$sel='';}
	 $countryoption.="<option value='$ccode' $sel>$country</option>";
 }
 
 
 
 if($gcountry!='' ){
$sql4 = "select distinct currency from instaforex  where ccode3='$gcountry'";

$res4 = sqlsrv_query($conn,$sql4);
while($row4 = sqlsrv_fetch_array($res4, SQLSRV_FETCH_ASSOC)){
	$currency = $row4['currency'];
	if($gcurrency==$currency){$selc='selected';}else{$selc='';}
	$currencyoption.="<option value='$currency' $selc >$currency</option>";
} 
}






 $table = 'instaproduct';



 $cond='';
if($gproductmode=='TT'){
	$table='product';
	$deltyp = $gdelivery;
	if($gdelivery=="AC"){$deltyp='TT';}
	$cond="and country='$gcountry' and cur='$gcurrency' and subtyp='$deltyp'";
}
/* if($gproductmode=='IMT'){
$sql6 = "SELECT DISTINCT prodcd, currency, country
FROM instaagent
WHERE country = '$gcountry' AND currency = '$gcurrency';";
//echo $sql6."<br>";
$res6 = sqlsrv_query($conn,$sql6);
while($row6 = sqlsrv_fetch_array($res6,SQLSRV_FETCH_ASSOC)){
	$prodcd=$row6['prodcd'];
	
	if($prodcd=="TERRAPAY" ){$prodcd='GMEXPRESS';}
	if (!array_key_exists($prodcd, $imtproductarr)) {
		continue;
	}
	
	if($prodcd==''){continue;}
	$prodname = $imtproductarr[$prodcd];
	if($gproduct==$prodcd){$seli='selected';}else{$seli='';}
	$imtprductoption .="<option value='$prodcd'$seli >$prodname</option>";
	
}
} */




$productoption = '';
$sql3="select * from $table where flag <> 'D' $cond";
$res3 = sqlsrv_query($conn,$sql3);
 while($row3 = sqlsrv_fetch_array($res3, SQLSRV_FETCH_ASSOC)){
	 $prodcd= $row3['prodcd'];
	 $prodname=$row3['prodname'];
	 
	 if( $gproduct== $prodcd){$seld='selected';}else{$seld='';}
	 $productoption.="<option value='$prodcd' $seld>$prodname</option>";
	 
 }
 
 $imptprodcond='';
 if($gdelivery=='AC'){
	 $imptprodcond="and (sambank='Y' OR othrbank='Y')";
 }
 if($gdelivery=='CP'){
	 $imptprodcond="and cash='Y' ";
 }
  if($gdelivery=='MOB'){
	 $imptprodcond="and mobtxn='Y' ";
 }

 

$agnetcdoption = '';


	
$sql5 = "select agentcd from instaagent where prodcd='$gproduct' and country='$gcountry' and currency='$gcurrency' $imptprodcond";
$res5 = sqlsrv_query($conn, $sql5);
while($res5 && $row5 = sqlsrv_fetch_array($res5, SQLSRV_FETCH_ASSOC)){
	$agentcd = $row5['agentcd'];
	$agnetcdoption.="<option value='$agentcd'>$agentcd</option>";
}


$submit = ''; if(isset($_POST['add'])){$submit=$_POST['add'];}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$res=updateProd();
	echo $res;
	$arr = explode("~",$res);
	$sts=$arr[0];
	$stscode=$arr[1];
	$stsremark= $arr[2];
	if($sts=="S"){
		echo "<script>alert('$stsremark')</script>";
	}else{
		echo "<script>alert('$stsremark')</script>";
		if($stscode=='355' || $stscode==355){
			//header("Location: logout.php");
			//exit;
		}
	}
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="../static/style/editproduct-styles.css">
    <style>
        .error-msg {
            font-size: 12px;
            color: #ff3333;
        }
    </style>
</head>
<body>


    <div class="main">
    

        <div class="container">
            <span style="text-align: center; font-size: 12px; color: red;" id="errormsg"></span>
            <div class="title">Edit Product</div>
            
            <form action="" name="productform" method="post"> 

                <div class="addproductDetails">

                    <div class="input-box">
                        <label for="country" class="details">Country</label>
                        <select name="country" id="country" onchange="change()" required disabled>
                            <option value=""  >Select Country</option>
                            <?php echo $countryoption?>
                        </select> 	
                        <span id="clientTypeError" class="error-msg"></span>
                    </div>

                    <div class="input-box">
                        <label for="currency" class="details">Currency</label>
                        <select id="currency" name="currency" onchange='changeCurrency()'required disabled>
                            <option value="" selected >Select Currency</option>
                            <?php echo $currencyoption?>
                        </select>
                        <span id="clientTypeError" class="error-msg"></span>
                    </div>

                    <div class="input-box">
                        <label for="deltype" class="details">Delivery Type</label>
                        <select id="deltype" name="deltype" onchange="changeDelType()" required disabled>
                            <option value="" selected>Select delivery type</option>
                            <option <?php if($gdelivery=="AC"){echo "selected";}?> value="AC">Account Transfer</option>
                            <option <?php if($gdelivery=="CP"){echo "selected";}?> value="CP">Cash Pickup</option>		
                            <option <?php if($gdelivery=="MOB"){echo "selected";}?> value="MOB">Mobile Transfer</option>
                        </select>
                        <span id="clientTypeError" class="error-msg"></span>
                    </div>

                    <div class="input-box">
                        <label for="delmode" class="details">Product Type</label>
                        <select id="delmode" name="delmode" required onchange='changeMode()'>
                            <option value=""  >Select delivery type</option>
                            <option <?php if($gproductmode=="TT"){echo "selected";}?> value="TT">TT</option>
                            <option <?php if($gproductmode=="IMT"){echo "selected";}?> value="IMT">IMT</option>
                        </select>
                        <span id="clientTypeError" class="error-msg"></span>
                    </div>

                    <div class="input-box">
                        <label for="product" class="details">Product</label>
                        <select id="product" name="product" onchange="changeProductCode()"required>
                            <option value=""  selected>Select Product</option>
                            <?php if($gproductmode=="TT"){echo $productoption;}?>
                            <?php //if($gproductmode=="IMT"){echo $imtprductoption;}?>
							<?php if($gproductmode=="IMT"){?>
							<option <?php if($gproduct=="MGI"){echo 'selected';}?> value='MGI' >MONEYGRAM REMIT</option>
							<option  <?php if($gproduct=="TRANSFAST"){echo 'selected';}?> value='TRANSFAST' >TRANSFAST</option>
							<?php }?>
							
                        </select>
                        <span id="clientTypeError" class="error-msg"></span>
                    </div>

                    <div class="input-box">
                        <label for="agentid" class="details">Agent ID</label>
                        <select id="agentid" name="agentid" >
                            <option value="" disabled selected>Select Agent ID</option>
                            <?php echo $agnetcdoption?>
                        </select>
                        <span id="clientTypeError" class="error-msg"></span>
                    </div>

                    <div class="access">
                <label class="radio-container">Enable
                    <input type="radio" name="accessOption" value="enable">
                    <span class="checkmark"></span>
                </label>

                <label class="radio-container">Disable
                    <input type="radio" name="accessOption" value="disable" checked>
                    <span class="checkmark"></span>
                </label>               
            </div>

                    

                    
                </div>
                
                
                <div class="button">
                    <input type="button" id='submitbtn' value="Update" name="add" onclick="submit()"/>
                </div>
            </form>
        </div>	
    </div>
	
	<?php 
	function updateProd(){
		//echo  $gcurrency,$deltype,$gproduct,$gproductmode,$gcountry,$gstatus;
		global $gcurrency,$deltype,$gproduct,$gproductmode,$gcountry,$gstatus,$user,$accessOption,$gagentid,$token;
		
		//if($accessOption=="enable")
		
		$curl = curl_init();

		curl_setopt_array($curl, [
		CURLOPT_PORT => "8081",
		CURLOPT_URL => "http://192.168.1.34:8081/v1/prod/updateproduct",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{
			\"Header\": {
			\"clientId\": \"jinoy\"
			},
			\"ProductList\": [
				{        
				\"receiveCountry\": \"$gcountry\",
				\"receiveCurrency\": \"$gcurrency\",
				\"deliveryType\": \"$deltype\",
				\"deliveryChannel\": \"$gproductmode\",
				\"productCode\": \"$gproduct\",
				\"status\": \"$accessOption\",
				\"agentId\": \"$gagentid\"
				} 
				]
			}",
		CURLOPT_HTTPHEADER => [
		"Accept-Language: en",
		"Content-Type: application/json",
		"Access-Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjbGllbnRJZCI6Imppbm95IiwidXNlck1vYmlsZSI6Ijc1NjMyNTg4IiwidXNlcklkTm8iOiI5NDc4NjcyNiIsInVzZXJVSUQiOiI2MDAyNiIsImlhdCI6MTcxODc4MzEwNSwiZXhwIjoxNzE5Mzg3OTA1fQ.6uBR_1Icp9rncCIU7XnIQ0tfR8aixkLy712u25trh4w"
		],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		 $data = json_decode($response, true);
		//var_dump($data);
		 $stscode= $data['ResponseStatus']['statusCode'];
		 $stsremark = $data['ResponseStatus']['statusRemark'];
		if ($err) {
				return "F~~something went wrong!";
		} else {
		
			if($stscode == "100" || $stscode == 100){
				return "S~$stscode~$stsremark";
			}
			else{
				return "F~$stscode~$stsremark";
			}
		
		}
		
	}
	?>
	
	<script>
	
	
	 function change() {
            var country = document.getElementById('country').value;
			//let curr = document.getElementById('currency').value;
			updateURLParameter('country', country);
			//updateURLParameter('currency', curr);
			
        }

        function changeDelType() {
            var delivery = document.getElementById('deltype').value;
            updateURLParameter('delivery', delivery);
        }

        function changeMode() {
            var productmode = document.getElementById('delmode').value;
            updateURLParameter('productmode', productmode);
        }
		 function changeCurrency(){
			let cur = document.getElementById('currency').value;
			updateURLParameter('currency', cur);
		} 
		function changeProductCode(){
			let product = document.getElementById('product').value;
			updateURLParameter('product', product);
		} 
	
	  function updateURLParameter(param, value) {
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            // Update or add the parameter
            if (value) {
                params.set(param, value);
            } else {
                params.delete(param);
            }

            // Construct the new URL with the updated parameters
            var newUrl = `${url.origin}${url.pathname}?${params.toString()}`;

            // Reload the page with the new URL
            window.location.href = newUrl;
        }
		
		function submit(){
			let form = document.productform;
			form.action="editproduct.php";
			form.submit();
			//console.log(form,"ffdfdf");
		}
		
	</script>
	
</body>
</html>
