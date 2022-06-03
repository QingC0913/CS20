<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
<title>NoSlack</title>
</head>

<body>
    <?php 
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        
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
        
        
        // search for password matching an existing username
        $sql = "SELECT password FROM users WHERE username=\"" . $username . "\"";
        echo "query to look for account: " . $sql . "<br>";
        $result = $conn->query($sql);

        // account exists
        if ($result->num_rows > 0) 
        {
            // notify that account with that username exists, redirect back to create account page
            ?>
            <script>
            window.location.replace("create-account.html");
            alert("Username already exists. Please choose a different username.");
            </script>
            <?php
        } 
        
        // account does not exist 
        else
        {
            // add user to the users table
            $sql = "INSERT INTO users (user_id, username, password)
            VALUES (NULL, '$username', '$password')";

            if ($conn->query($sql) === TRUE) {
            } 
            else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            // create a new database table
            $primary_key = "task_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,"; 
            $tb_nm = $username;
            $sql = "CREATE TABLE $tb_nm (
                    $primary_key
                    user_id INT(5) NOT NULL, 
                    task_name VARCHAR(30) NOT NULL,
                    done BOOLEAN DEFAULT FALSE, 
                    priority VARCHAR(10) DEFAULT 'low', 
                    deadline TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";  

            if ($conn->query($sql) === TRUE) {
            } else {
              echo "Error creating table: " . $conn->error . "<br>";
            }
            
            // redirect to main to-do list page
            ?>
            <script>
            const param = "username=<?php echo $username; ?>";
            window.location.replace("index.php?" + param);
            alert("New account created. Welcome!");
            </script>
            <?php
        }
        
        
        // close the connection 
        $conn->close();
     ?>
    
</body>
</html>