<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>No. 1</title>
             
        <?php 
        setConnection(); 

        function setConnection()
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
            
            //select the database
            $conn->select_db($db);
            
            $tb_nm = "User1";
            
            
            markChecked($conn, $tb_nm);
                
            displayAll($conn, $tb_nm);
            $conn->close(); //already got info from db
        }
        
        function markChecked($conn, $tb_nm)
        {
            $to_update = ($_REQUEST['chkbx1']); 
            
            if(!empty($to_update))
            {
                //https://www.formget.com/php-checkbox/ 
                foreach($to_update as $selected)
                {
                    echo $selected."</br>";
                    $status = false; 
                    //find curr status (done/not done) of task
                    $sql = "SELECT done FROM $tb_nm WHERE task_name = '$selected'";
                    $result = $conn->query($sql); 
                    if ($result->num_rows > 0) 
                   {
                       while($row = $result->fetch_assoc()) 
                      { 
                          $status = $row['done'];
                       }
                   } 
                   // $status = !$status; //reverse the status
                   $status = ($status) ? false : true; 
                   $sql = "UPDATE $tb_nm SET done = $status WHERE task_name = '$selected'";
                   if ($conn->query($sql) === TRUE) 
                   {
                   } else 
                   {
                     echo "<script>console.log($conn->error);</script>";
                   }
                }
            }
        }
        
        
        function displayAll($conn, $tb_nm)
        {
            global $s; 
            $s = "To do:<form name = 'forms[]' value = 'check' method = 'post' action = 'mark_completed2.php'>"; 
            
            $sql = "SELECT * FROM $tb_nm WHERE done = FALSE";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) 
            {
                // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                    $s .= "<input type = 'checkbox' onchange = 'this.form.submit()' name = 'chkbx1[]', value ='".$row["task_name"]."' unchecked>"
                       .$row["task_name"]."<br>";
                }            
            } 
            $s.="</form>"; 
            
            $sql = "SELECT * FROM $tb_nm WHERE done = TRUE";
            $result = $conn->query($sql);
            $s .= "<br>Completed tasks: (".$result->num_rows.")<br>";
            $s .= "<form name = 'forms[]' value = 'uncheck' method = 'post' action = 'mark_completed2.php' value = 'update'>";
            if ($result->num_rows > 0) 
            {
            // output data of each row
                while($row = $result->fetch_assoc()) 
                {
                    $s .= "<input type = 'checkbox' onchange = 'this.form.submit()' name = 'chkbx2[]', value ='".$row["task_name"]."' checked>"
                       .$row["task_name"]."<br>";
                }            
            } 
            $s .= "</form>";
        }
        ?>
            
    </head>
    <body>
        <form class="" action="mark_completed2.php" method="post">
            <label for="">Please a task</label>
            <input type="text" id="input" name="input">
            <input type="submit" id="save" name = "save"value = "Save">        
        </form>
            <?php 
                echo $s;
             ?>
    
        
    </body>
</html>