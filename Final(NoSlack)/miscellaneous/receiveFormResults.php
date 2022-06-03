<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Receive results</title>
    </head>
    <body>
    <div class="">
        new page
    </div>
        <?php 
        $task = $_POST["input"];
        getData($task);
        echo "<script>console.log('$task');</script>";
        // $task = "hi";
        // getData($task);
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
                echo "<script>console.log('all good, connected');</script>";
    	    
    	    // //select the database
    	    $conn->select_db($db);
            
    	    //run a query
            $tb_nm = "User1";
            $sql = "INSERT INTO $tb_nm (user_id, task_name, done, priority)
            VALUES (1, '$task', TRUE, 'high')";
            if ($conn->query($sql) === TRUE) {
              echo "<script>console.log('insert success');</script>";
            } else {
              echo "<script>console.log($conn->error);</script>";
            }
    	    //close the connection	
    	    $conn->close(); //already got info from db
        }
        ?>
    </body>
</html>