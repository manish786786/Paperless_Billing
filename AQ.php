<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill_db";
$a=0;
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT max(id) FROM invoice";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$a=$row["max(id)"]+1;
    }
} else {
    echo "0 results";
}
$conn->close();
?>




<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Editable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    
        $.post("getcustomer.php",
        {
          name: "",
          city: ""
        },
        function(data,status){
			$("#cus").append(data);
           
			
        });
	

$("#cus").keyup(function(){
		$.ajax({
		type: "POST",
		url: "search.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#cus").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#cus").css("background","#FFF");
		}
		});
	});

	
 $("#cus").change(function(){
        
		 $.post("getemail.php",
        {
          name: $("#cus").val(),
          city: ""
        },
        function(data,status){
			$("#em").text(data);
        });
		
		
		
    });	

 $("#cus").change(function(){
        
		 $.post("getmobile.php",
        {
          name: $("#cus").val(),
          city: ""
        },
        function(data,status){
			$("#mob").text(data);
        });
		
    });		
	


	
	
		
		
$("#send2").click(function(){
   
$(".a,.cost , .qty , .price ,#cus").each(function(){
	var a = $(this).val();
		$(this).html(a);
		//alert(a);
	});

	
	
	
   var a = $("#page-wrap").html();

	//$("#asd").html(a);
	
	 $.post("send_form_email.php",
        {
          email: $("#em").text(),
          msg: a,
		  name: $("#cus").val(),
		  date:$("#date").text(),
		  tot:$("#tot").text(),
		  iid:$("#iid").text()
        },
        function(data,status){
			
			alert(data);
        });
	
	
});
		
   
});


function selectCountry(val) {
$("#cus").val(val);
$("#suggesstion-box").hide();
}
</script>





<body>




	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
				
	
		<div id="identity">
		
            <h4 id="address">S.GARMENTS
CHITORALI ROAD<br>
NEAR MATA MANDIR, BADKAS SQUARE<br>
MAHAL, NAGPUR<br>
Mobile: 7507502810
</h4>

            <div id="logo">

              <img id="image" src="images/logo.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">
<div class="frmSearch">
	<input type="text" id="cus" placeholder="Customer Name" />
	<div id="suggesstion-box"></div>
</div>
			<br><br>
			<h4 id="em"><h4>
		<br>
			<h4 id="mob"><h4>
			<br>
		<button class="btn btn-primary" id="send2">Send</button>
<button onclick="myFunction()">Print this page</button>

<script>
function myFunction() {
    window.print();
}
</script>
	

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea id="iid"><?php echo $a;?></textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date"><?php echo date("Y/m/d");?></textarea></td>
                </tr>
               

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Sr. no.</th>
		      <th>Particular</th>
		      <th>Rate</th>
			  <th>Quantity</th>
		      
		      <th>Amount</th>
		  </tr>
		  
		<div id="idincr">
		  <tr class="item-row">
		      <td class="item-name" ><div class="delete-wpr"><textarea class="a">click to edit</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>

		      <td class="description"><textarea class="a">click to edit</textarea></td>
		      <td><textarea class="cost" >₹0.00</textarea></td>
		      <td><textarea class="qty">1</textarea></td>
		      <td><span class="price">₹0.00</span></td>
		  </tr>
		  </div>
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">₹0.00</div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">₹0.00</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">₹0.00</textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance" id="tot"><div class="due">₹0.00</div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Thank You For Shopping With Us</h5>
		  <textarea>Hope to See You Soon....</textarea>
		</div>
	
	</div>
	
<div id="asd">
</div>	
</body>

</html>