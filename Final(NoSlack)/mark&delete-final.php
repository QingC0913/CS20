<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>NoSlack</title>
    </head>
    <body> 
        <?php
        $username = $_REQUEST['username'];
        
        function markUnchecked($conn, $tb_nm)
        {
            $to_uncheck = ($_REQUEST['chkbx2']); 
            if(!empty($to_uncheck))
            {
                //https://www.formget.com/php-checkbox/ 
                foreach($to_uncheck as $uncheck)
                {
                    $status = true; 
                    //find curr status (done/not done) of task
                    $sql = "SELECT done FROM $tb_nm WHERE task_name = '$uncheck'";
                    if ($conn->query($sql))
                       $result = $conn->query($sql);
                    if ($result->num_rows > 0) 
                   {
                       while($row = $result->fetch_assoc()) 
                      { 
                          $status = (int)$row['done'];
                       }
                   } 
                   $status = ($status == 1) ? 0 : 1; 
                   $sql = "UPDATE $tb_nm SET done = $status WHERE task_name = '$uncheck'";
                   if ($conn->query($sql) === FALSE) 
                     echo "$conn->error";
                }
            }
        }
        
        function markChecked($conn, $tb_nm)
        {
            global $username;
            
            $to_update = $_REQUEST['chkbx1']; 
        
            if(!empty($to_update))
            {
                //https://www.formget.com/php-checkbox/ 
                foreach($to_update as $selected)
                {
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
        
        function getData($conn, $tb_nm)
        {
            global $username;
            
            $task = $_REQUEST['input'];
            if ($task == "") return;
            $sql = "INSERT INTO $tb_nm (user_id, task_name, done, priority) VALUES (1, '$task', FALSE, 'high')";
            if ($conn->query($sql) === TRUE) {
              echo "<script>console.log('insert success');</script>";
            } else {
              echo "<script>console.log($conn->error);</script>";
            }    
            
        }

        function deleteTask($conn, $tb_nm)
        {
            global $username;
            
            $to_delete = $_REQUEST['delete']; 
            
            if(!empty($to_delete))
            {
                foreach($to_delete as $to_del)
                {
                    $sql = "DELETE FROM $tb_nm WHERE task_name = '$to_del'";
                    $conn->query($sql);
                }
            }
        }
        
        function setConnection()
        {
            global $username;
            
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
            
            $tb_nm = $username;
            
            markChecked($conn, $tb_nm);
            markUnchecked($conn, $tb_nm);
            getData($conn, $tb_nm);
            deleteTask($conn, $tb_nm);
            
            // reload main to-do list page
            $string = "<script>";
            $string .= "var param = 'username=";
            $string .= $username;
            $string .= "';";
            $string .= "window.location.replace('index.php?' + param);";
            $string .= "</script>";
            
            echo $string;
            
            // displayAll($conn, $tb_nm);
            $conn->close(); //already got info from db
        }
        
        setConnection();
        ?>
    </body>
</html>