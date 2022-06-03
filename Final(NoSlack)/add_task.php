<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
<title>NoSlack</title>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
        <link rel='stylesheet' type='text/css' href='style.php' />
</head>

<body>
    <?php 
        $task_name = $_REQUEST['task'];
        $username = $_REQUEST['username'];
        
        //establish connection info
    	$server = "localhost";// your server
    	$userid = "uinjthvlu8qjg"; // your user id
    	$pw = "//MatrixIsTheBest!"; // your pw
    	$db= "dbccqg055kvfzk"; // your database 
        // Create connection
        $conn = new mysqli($server, $userid, $pw );
        // Check connection
        if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
        }
        // select the database
        $conn->select_db($db);
        
        // get the user_id
        $sql = "SELECT user_id FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
               {
                   $user_id = $row["user_id"];
               }
        } 
        
        // insert the new task
        $sql = "INSERT INTO $username (task_id, user_id, task_name, done, priority, deadline)
        VALUES (NULL, '$user_id', '$task_name', 0, NULL, NULL)";

        if ($conn->query($sql) === TRUE) {
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        // close the connection 
        $conn->close();
     ?>
     
     <!-- go back to to-do list page -->
     <script>
     const param = "username=<?php echo $username; ?>";
     window.location.replace("index.php?" + param);
     </script>
    
</body>
</html>