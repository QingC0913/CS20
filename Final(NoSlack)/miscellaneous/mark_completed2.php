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
            
            
            getData($conn, $tb_nm);
            markChecked($conn, $tb_nm);
            // markChecked($conn, $tb_nm, "chkbx2");
                
            displayAll($conn, $tb_nm);
            $conn->close(); //already got info from db
        }
        
        function markChecked($conn, $tb_nm)
        {
            // echo "insde markchecked, the name is $checkbox_name <br>";
            // if ($checkbox_name == "chkbx2")
            // {
            //     echo "<br>time to uncheck boxes!!!<br>";
            //     // echo "<script> checkboxes = document.getElementsByName('chkbx2'); for (i = 0; i < checkboxes.length; i++) {status = checkboxes[i].checked;  checkboxes[i].checked = status ? false : true; }console.log('alskdfjalskdfjsakldf');</script>";
            // }
            $to_update = ($_REQUEST['chkbx1']); 
            echo "size" . count($to_update). "<br>";
            
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
                          echo "current status: " . $status . "<br>";
                       }
                   } 
                   // $status = !$status; //reverse the status
                   $status = ($status) ? false : true; 
                   echo "now status: ".$status."<br>";
                   $sql = "UPDATE $tb_nm SET done = $status WHERE task_name = '$selected'";
                   if ($conn->query($sql) === TRUE) 
                   {
                     echo "console.log('update success');";
                   } else 
                   {
                     echo "console.log($conn->error);";
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
        
        function getData($conn, $tb_nm)
        {
            $task = $_REQUEST['input'];
    	    if ($task == "") return;
            $sql = "INSERT INTO $tb_nm (user_id, task_name, done, priority)
            VALUES (1, '$task', FALSE, 'high')";
            if ($conn->query($sql) === TRUE) {
              echo "console.log('insert success');";
            } else {
              echo "console.log($conn->error);";
            }    
            
        }

        ?>
            
        </script>
    </head>
    <body>
        <form name = "forms[]" value = "insert" action="mark_completed2.php" method="post">
            <label for="">Please a task</label>
            <input type="text" id="input" name="input">
            <input type="submit" id="save" name = "save"value = "Save">        
        </form>
            <?php 
                echo $s;
             ?>
    
        
    </body>
</html>