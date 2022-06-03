<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Testing</title>
        <script type="text/javascript">
        
            
        <?php 
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
    	    
    	    // //select the database
    	    $conn->select_db($db);
    	    //run a query
            $primary_key = "task_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,"; 
            $tb_nm = "User1";
    	    $sql = "CREATE TABLE $tb_nm ($primary_key
                    user_id INT(5) NOT NULL, 
                    task_name VARCHAR(30) NOT NULL,
                    done BOOLEAN DEFAULT FALSE, 
                    priority VARCHAR(10) DEFAULT 'low', 
                    deadline TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";        
            
            //log errors
            if ($conn->query($sql) === TRUE) {
              echo "console.log('Table $tb_nm created successfully');";
            } else {
              echo "console.log('".$conn->error."');";
            }
    	    //close the connection	
    	    $conn->close(); //already got info from db
        ?>
            
        </script>
    </head>
    <body>
        <h1>create new table</h1>
        
        
    </body>
</html>