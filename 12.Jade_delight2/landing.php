<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<title>Jade Delight</title> 
<style type="text/css">
	label {
		display: inline-block;
	    text-align: left;
	    vertical-align: middle;
		clear: left;  
		width: 350px; 
	}
	h1 {
		color: green;
		text-align: center;
		border-bottom: 4px dotted #0b840b;
	}
	label, th {
		color: green;
		font-weight: bold;
	}	
	select {
		background-color: #66AA66;
		border-width: 1px solid green; 
	}
	#submitbutton {
		background-color: green; 
		border-width: 0;
		color: white;
		padding: 5px;

	}
</style>
</head>

<body>
    <?php 
	    //establish connection info
	    $server = "localhost";// your server
	    $userid = "uinjthvlu8qjg"; // your user id
	    $pw = "Alc0n0xDetergent"; // your pw
	    $db= "dbk3insp3bkc81"; // your database
	                                
	    // Create connection
	    $conn = new mysqli($server, $userid, $pw );
	    
	    // Check connection
	    if ($conn->connect_error) 
	      die("Connection failed: " . $conn->connect_error);
	    
	    // //select the database
	    $conn->select_db($db);
	    
	    //run a query
	    $sql = "SELECT * FROM Menu";
	    $result = $conn->query($sql);
	    
	    //associative array 
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

	    //close the connection	
	    $conn->close(); //already got info from db
	    
	    function makeSelect($name, $minRange, $maxRange)
	    {
	        $t = ""; 
	        $t = "<select name='".$name."' size='1'>";
	        for ($j = $minRange; $j <= $maxRange; $j++)
	        {
	            $t .= "<option>".$j."</option>";
	        }
	        $t .= "</select>"; 
	        return $t;
	    }
	    
	    function td($content, $className="")
	    {
	        return "<td class = '".$className."'>".$content."</td>";
	    }
	    
	    $to_write = ""; 
		$i = 0;
	    foreach($menuItems as $product => $price)
	    {
	        $to_write .= "<tr>"; 
	        $to_write .= td(makeSelect("quan".$i, 0, 10), "selectQuantity"); 
	        $to_write .= td($product, "itemName");
	        $to_write .= td("$".$price, "cost");
	        $to_write .= td("$<input type = 'text' name = 'cost'>", "totalCost"); 
	        $to_write .= "</tr>"; 
			$i++;
	    }
     ?>

<h1>Jade Delight</h1>
<form method="post" action="landing2.php" onsubmit= "return validateForm()">
	<p class="userInfo"><label>First Name:</label> <input type="text"  name='fname' /></p>
	<p class="userInfo"><label>Last Name*:</label>  <input type="text" name='lname'/></p>
	<p class="userInfo address"><label>Street*:</label> <input type="text" name='street' /></p>
	<p class="userInfo address"><label>City*:</label> <input type="text" name='city' /></p>
	<p class="userInfo"><label>Phone*:</label> <input type="text"  name='phone'/></p>
	<p> 
		<input type="radio"  name="p_or_d" value = "pickup" checked="checked"/>Pickup  
		<input type="radio"  name="p_or_d" value = "delivery"/>Delivery
	</p>
	<table border="0" cellpadding="3">
	  <tr>
	    <th>Select Item</th>
	    <th>Item Name</th>
	    <th>Cost Each</th>
	    <th>Total Cost</th>
	  </tr>
      <?php 
          echo $to_write; 
      ?>
	</table>
    
	<p class="subtotal totalSection"><label>Subtotal:</label> 
	   $<input type="text"  name='subtotal' id="subtotal" />
	</p>
	<p class="tax totalSection"><label>Mass tax 6.25%:</label>
	  $<input type="text"  name='tax' id="tax" />
	</p>
	<p class="total totalSection"><label>Total:</label> $<input type="text"  name='total' id="total" />
	</p>
	<input type = "submit" id = "submitbutton" value = "Submit Order"/>

	<input type="text" id = "message" name = "message" style = "display: none;">
	<input type="text" id = "time" name = "time" style = "display: none;">
</form>


<script type="text/javascript">	
	function MenuItem(name, cost)
	{
		this.name = name;
		this.cost = cost;
	}
	window.onload = function() {
		menuItems = []; 
		<?php 
		$i = 0; 
		$s = "";
		foreach ($menuItems as $product => $price) {	
			$s .= "menuItems[" .$i ."] = new MenuItem('" .$product ."'," .$price .");";
			$i++;
		} 
		echo $s;
		?>
		initialize(); 

		pickup = document.getElementsByName("p_or_d")[0]; 
		pickup.onclick = function(){processOrder("p");};
		deliv = document.getElementsByName("p_or_d")[1]; 
		deliv.onclick = function(){processOrder("d");}; 
		
		$("select[name = quan0]")[0].onchange = function() {recalc(0)};
		$("select[name = quan1]")[0].onchange = function() {recalc(1)};
		$("select[name = quan2]")[0].onchange = function() {recalc(2)};
		$("select[name = quan3]")[0].onchange = function() {recalc(3)};
		$("select[name = quan4]")[0].onchange = function() {recalc(4)};
		}
	
	//recalculates the total cost per item, subtotal, total, and tax everytime
	//user makes a selection 
	function recalc(i)
	{	
		//updating Total Cost for item 
		item_cost = menuItems[i].cost;
		selected = $("select[name = quan" + i + "]")[0].selectedIndex;
		total_cost = (selected * item_cost);
		$("input[name = cost]")[i].value = total_cost;
    
		//updating subtotal
		subtotal = 0;
		for (x = 0; x < menuItems.length; x++)
		{
			//add Total cost of each menu item 
			subtotal += parseFloat($("input[name = cost]")[x].value);
		}
		document.getElementById("subtotal").value = subtotal;
    
		//updating tax
		tax = (subtotal * 0.0625).toFixed(2);
		document.getElementById("tax").value = tax;
    
		//updating total 
		document.getElementById("total").value = subtotal + parseFloat(tax);
	}
	
 //calculates pickup/delivery time  
   function calcTime()
	{	
		pickup = document.getElementsByName("p_or_d")[0].checked;
		
		if (pickup)
		{
			message = "Your estimated pick up time is: "; 
			wait_time = 15;
		}
		else 
		{
			message = "Your order will be delivered at around: "
			wait_time = 30;
		}
		
		var now = new Date();
		var later = new Date(now.getTime() + wait_time*10*6000);
		time = later.getHours() + ":" + later.getMinutes();
		
		document.getElementById("message").value = message;  
		document.getElementById("time").value = time;
	}
   	
	//displays address/city parameters depending on the delivery mode
	function processOrder(p_or_d)
	{
		if (p_or_d == "d")
		{
			document.getElementsByClassName("userInfo address")[0].style.display = "block";
   		 	document.getElementsByClassName("userInfo address")[1].style.display = "block";
		}
		else {
			document.getElementsByClassName("userInfo address")[0].style.display = "none";
   		 	document.getElementsByClassName("userInfo address")[1].style.display = "none";
		}
	}
	
	//sets and displays all values to 0 in the beginning
	 function initialize()
	 {
		 //sets all numbers to 0
		 document.getElementsByClassName("userInfo address")[0].style.display = "none";
		 document.getElementsByClassName("userInfo address")[1].style.display = "none";
		 
		 document.getElementById("subtotal").value = 0;
		 document.getElementById("tax").value = 0; 
		 document.getElementById("total").value = 0;
                  
		 for (i = 0; i < menuItems.length; i++)
		 {
			 document.getElementsByName("cost")[i].value = 0;
		 }
	 }
	
	 //returns false if the given field is not valid
 	 function validateEntry(query, name_of_query)
 	 {
 		 if (query == "")
 		 {
 		 	alert("The " + name_of_query + " must be filled out for us to process your order!");
 			return false;
 		 }
 		else if (name_of_query == "phone number")
 		{
 			//remove non-digits
 			var query = query.replace(/\D/g, "");
 			
 			//if it's neither 7- or 10-digits
 			if ((query.length != 7) && (query.length != 10))
 			{
 				alert("Your phone number must be 7- or 10-digits. Please re-enter and submit again.");
 				return false;
 			}
 		}	
 		return true;
 	 }
 	 
 	 //checks all the necessary fields (phone, last name, selection)
 	 //returns false if any field is not valid 
 	 function validateForm()
 	 {
 		 //checks phone number and last name
 		 a = validateEntry(document.getElementsByName("phone")[0].value, "phone number"); 
 		 b = validateEntry(document.getElementsByName("lname")[0].value, "last name");
 		 c = true, d = true, e = true;
 		 
 		 //if delivery selected, check if street + city are filled 
 		 if (document.getElementsByName("p_or_d")[1].checked)
 		 {
 			 c = validateEntry(document.getElementsByName("street")[0].value, "street address"); 
 			 d = validateEntry(document.getElementsByName("city")[0].value, "city");
 		 }
 		 
 	 	//checks if ANY items are selected
 		 items_selected = 0;
 		 for (i = 0; i < menuItems.length; i++)
 			 items_selected += $("select[name = quan" + i + "]")[0].selectedIndex; 
 		 
 		 if (! items_selected)
 		 {
 		 	alert("You must select at least one item!");
 			e = false;
 		 }
 		 
 		 if ((a + b + c + d + e) < 5)
 			 return false;
 		else 
		{
			calcTime();
 			return true;
		}
 	 }

</script>
</body>
</html>