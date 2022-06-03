<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>No. 1</title>
  
        <?php 
        
        function displayAll($conn, $tb_nm)
        {
            global $s; 
            $s = "To do:<form id = 'incomplete'>"; 
            
            $sql = "SELECT * FROM $tb_nm WHERE done = FALSE";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) 
            {
          // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                    $s .= "<input type = 'checkbox' onchange = 'this.form.submit()' class = 'lalala' name = 'chkbx1[]', id ='".$row["task_name"]."' unchecked>"
                       .$row["task_name"]."<br>";
                }            
            } 
            $s.="</form>"; 
            

            $sql = "SELECT * FROM $tb_nm WHERE done = TRUE";
            $result = $conn->query($sql);
            $s .= "<br>Completed tasks: (".$result->num_rows.")<br>";
            $s .= "<form id = 'completed'>"; 
            if ($result->num_rows > 0) 
            {
          // output data of each row
          while($row = $result->fetch_assoc()) 
          {
              $s .= "<input type = 'checkbox' name = 'chkbx2' checked = 'checked' id = '".$row["task_name"]."' checked>"
                 .$row["task_name"]."<br>";
          }
            }
            $s .= "</form>";
        }
        
        function getData($task)
        {
    	    //establish connection info
    	    $server = "localhost";// your server
    	    $userid = "uinjthvlu8qjg"; // your user id
    	    $pw = "//MatrixIsTheBest!"; // your pw
    	    $db= "dbccqg055kvfzk"; // your database
    	                                
    	    // Create connection
    	    $conn = new mysqli($server, $userid, $pw );
    	    
    	    // Check connection
    	    if ($conn->connect_error) 
    	      die("Connection failed: " . $conn->connect_error);
             else 
                echo "console.log('all good, connected');";
    	    
    	    // //select the database
    	    $conn->select_db($db);
            
    	    //run a query
            $tb_nm = "User1";
            $sql = "INSERT INTO $tb_nm (user_id, task_name, done, priority)
            VALUES (1, '$task', FALSE, 'high')";
            if ($conn->query($sql) === TRUE) {
              echo "console.log('insert success');";
            } else {
              echo "console.log($conn->error);";
            }
            
            displayAll($conn, $tb_nm); 
    	    //close the connection	
    	    $conn->close(); //already got info from db
        }
        
        $task = $_REQUEST["input"];
        getData($task);
        ?>
            
        </script>
    </head>
    <body>
        <form class="" action="checkbox2.php" method="post">
            <label for="">Please a task</label>
            <input type="text" id="input" name="input">
            <input type="submit" id="save" name = "save"value = "Save">        
        </form>
            <?php 
                echo $s;
             ?>
    
        
    </body>
</html>