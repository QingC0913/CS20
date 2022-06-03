<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title>Order Receipt</title> 
		<style type="text/css">
			h1{
				color: green;
				text-align: center;
				border-bottom: 4px dotted #0b840b;
			}
			.col1, .cola, .colb {
				display: inline-block;
			    text-align: left;
			    vertical-align: middle;
				clear: left;  
				width: 350px; 
			}			
			.cola { 
				width: 250px; 
			}
			
			.colb {
				width: 55px; 
			}
			.colc {
				width: 60px;
			}
			hr {
				border-top: 2px solid green;
			}
		</style>
	</head>
	<body>
		<h1>Jade Delight</h1>

		<?php 
		function getDB()
		{
		    $server = "localhost";// your server
		    $userid = "uinjthvlu8qjg"; // your user id
		    $pw = "Alc0n0xDetergent"; // your pw
		    $db= "dbk3insp3bkc81"; // your database
		                                
		    $conn = new mysqli($server, $userid, $pw );
		    
		    if ($conn->connect_error) 
		      die("Connection failed: " . $conn->connect_error);
		    
		    $conn->select_db($db);
		    
		    $sql = "SELECT * FROM Menu";
		    $result = $conn->query($sql);
		    
		    $menuItems = []; 
		    if ($result->num_rows > 0) 
		    {
		        while($row = $result->fetch_assoc()) 
		       {
		           $product = $row["MenuItem"]; 
		           $price = $row["PerItemCost"];
		           $menuItems[$product] = $price; 
		        }
		    } 
	
		    $conn->close(); //already got info from db
	
			return $menuItems;
		}
		
		//get the selected amounts from the main page
		function getAmounts($items)
		{
			$amounts = []; 
			for ($i = 0; $i < count($items); $i++ )
			{
				$name = "quan$i";
				$amount = $_REQUEST[$name]; 
				$amounts[] = $amount;
			}
			return $amounts; 
		}	
		
		//display item name, price, and total 
		function selectedItems($items, $amounts)
		{
			$i = 0; 
			$str = ""; 
			foreach ($items as $key => $value) {
				$str .= "<span class = 'cola'>$key</span>"; 
				$str .= "<span class = 'colb'>$$value</span>";
				$str .= "<span class = 'colc'>* ".$amounts[$i]." = </span>";
				$str .= "<span class = 'col2'>$".($value * $amounts[$i])."</span><br>";
				$i++;
			}
			echo $str;
		}
		
		//get and display tax info 
		function tax_info()
		{
			$subtotal = $_REQUEST['subtotal'];
			$tax = $_REQUEST['tax']; 
			$total = $_REQUEST['total'];
			$str = "<hr>";
			$str .= "<span class = 'col1'>Subtotal: </span>";
			$str .= "<span class = 'col2'>$".$subtotal."</span><br>"; 
			$str .= "<span class = 'col1'>Tax: </span>";
			$str .= "<span class = 'col2'>$".$tax."</span>"; 
			$str .= "<hr>";
			$str .= "<span class = 'col1'>Total: "."</span>";
			$str .= "<span class = 'col2'>$".$total."</span><hr>";
			echo $str; 
			
			return $total; 
		}
		
		//get and display delivery info and time
		function delivery_info()
		{
			$msg = $_REQUEST['message'];
			$time = $_REQUEST['time'];
			$str = $msg.$time; 
			echo $str; 
			$p_or_d = $_REQUEST["p_or_d"]; 
			if ($p_or_d == "delivery")
			{
				$city = $_REQUEST["city"];
				$addr = $_REQUEST["street"]; 
				$str = "Your order will be delivered to: $addr, $city, at around: $time."; 
			}
			return $str; 
		}
		
		$items = getDB(); 
		$amounts = getAmounts($items); 
		selectedItems($items, $amounts); 
		$tot = tax_info();
		$pd_info = delivery_info();		
		
		//email message
		$to = "qing.cheng@tufts.edu"; 
		$subject = "Jade Delight Order"; 
		$message = "Hello Mx.".$_REQUEST["lname"].", ";
		$message .= "thank you for your order! The total is $$tot. ";
		$message .= "$pd_info";

		mail($to, $subject, $message);
		 ?>
	</body>
</html>