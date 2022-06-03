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
        $result = $conn->query($sql);

        // account exists
        if ($result->num_rows > 0) 
        {
            // check password
            while($row = $result->fetch_assoc()) 
               {
                   $password_correct = ($row["password"] == $password);
               }
            
            if ($password_correct) 
            {
            ?>
            <!-- account was found, open to main to-do list page -->
            <script>
            const param = "username=<?php echo $username; ?>";
            window.location.replace("index.php?" + param);
            </script>
            <?php
            }
            else 
            {
            ?>
            <!-- password was incorrect, redirect back to login page -->
            <script>
            window.location.replace("log-in.html");
            alert("Invalid password.");
            </script>
            <?php
            }
        } 
        
        // account does not exist 
        else
        {
        ?>
        <!-- login was incorrect, redirect back to login page -->
        <script>
        window.location.replace("log-in.html");
        alert("An account with those credentials does not exist.");
        </script>
        <?php
        }
        
        // close the connection 
        $conn->close();
     ?>
    
</body>
</html>