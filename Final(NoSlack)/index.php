<!DOCTYPE html> 
<html data-wf-page="625c5b5cd45c99892f0b122b" data-wf-site="625c5b5cd45c9940660b122a">
<head>
    <meta charset="utf-8">
    <title>NoSlack todo app</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
    <link href="css/normalize.css" rel="<stsheet" type="text/css">
    <link href="css/webflow.css" rel="stylesheet" type="text/css">
    <link rel='stylesheet' type='text/css' href='style.php' />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href="css/noslack-todo-app.webflow.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">WebFont.load({  google: {    families: ["Varela:400","Inter:100,200,300,regular,500,600,700,800,900:cyrillic,latin","DM Serif Display:regular"]  }});</script>
    <!-- [if lt IE 9]><sc<stript src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
    <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
    <script>
  
        function unchecking(i)
        {
            document.getElementById(i).checked = true; 
            document.getElementById(i).form.submit();
        }
      function displayResults()
      {
          // https://www.w3schools.com/jsref/jsref_obj_date.asp
          // https://www.w3docs.com/snippets/javascript/how-to-get-the-current-date-and-time-in-javascript.html
          var dateObj = new Date(); 
          var weekday = dateObj.getDay(); 
              weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]; 
              weekday = weekdays[weekday]; 
          var yyyy = dateObj.getFullYear(); 
          var mm = dateObj.getMonth() + 1; 
              mm = (mm < 10) ? ("0" + mm.toString()) : mm;
          // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Conditional_Operator
          var dd = dateObj.getDate(); 
              dd = (dd < 10) ? ("0" + mm.toString()) : dd;
          var date = weekday + ", " + yyyy + "/" + mm + "/" + dd; 
          document.getElementById("date").innerHTML = date; 
          
          var hr = dateObj.getHours();
              hr = (hr < 10) ? ("0" + hr.toString()) : hr;
          var min = dateObj.getMinutes(); 
              min = (min < 10) ? ("0" + min.toString()) : min;
          var sec = dateObj.getSeconds(); 
              sec = (sec < 10) ? ("0" + sec.toString()) : sec;
          var time = hr + ":" + min + ":" + sec ;
          document.getElementById("time").innerHTML = time; 
 
          refresh();          
      }
      
      function refresh()
      {
          // https://www.w3schools.com/jsref/met_win_setinterval.asp
          var something = setInterval(function () {displayResults()}, 1000);
      }
                  
    </script>
    <style>
    .delBtn
    {
        content = 'x';
        background-color: red;
    }
    .hidden{
        visibility: hidden;
    }
      .form-6
      {
          margin-top: 10%; padding-top: 0; margin-bottom: 0; 
      }
      li 
      {
          color: white; 
      }
      #addTask {
          display: block; 
          margin: 20px;
          width: 35px;
      }
      form{
          margin-top: 5%; margin-bottom: 0;
      }
      #start-timer-button{
          background-color: #8484f4; color: white;
          border: 2px #8484f4 solid;  width: 120px;
          height: 40px; text-align: center;
          border: 2px #a3dff3 0olid; 
          position: absolute; font-size: 18px;
          border-radius: 10px; margin-left: 2%;
          margin-top: 6%; 
      }
      #task 
      {
          margin-left: 2%; margin-right: 4%; width: 330px;
      }
      #select-form
      {
          margin-top: 100px;
      }
      select
      {
          padding: 1%; border-radius: 8px; font-size: 15px;
          height: 45px; border: 2px #8484f4 solid;
      }
      #btn1 
      {
            width: 30%; background: #2E2B63; margin-top: 3%;
            font-size: 15px; 
            color: white; float: left; display: block; 
            font-weight: 800px; padding: 13px 3px;  border-radius: 20px;
            cursor: pointer; z-index: 11;
            border-radius: 8px; border: 2px #8484f4 solid;
        }
        @media (max-width: 938px) {
          #btn1 {
               width: 40%; 
        }
            @media (max-width: 1820px) {
          #btn1 {
               width: 60%; 
                }
            }
           @media (max-width: 958px) {
          #btn1 {
               width: 80%; 

                }
            }
        }
    </style>
</head>
<body class="body" onload = "displayResults()">
    <!-- Get Username From URL -->
    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        var username = urlParams.get('username');
        $(document).ready(function(){
            $('#user').val(username);
        });
    </script>
    <!-- End -->
    
    <!-- PHP Code Begins -->
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
          
          $tb_nm = $_GET['username'];
          
          displayAll($conn, $tb_nm);
          makeSelect($conn, $tb_nm);

          $conn->close(); //already got info from db
      }
          
      function makeSelect($conn, $tb_nm)
      {
          $sql = "SELECT task_name FROM $tb_nm WHERE done = false"; 
          $result = $conn->query($sql);
         
          global $str; 
          $str = ""; 
          if ($result->num_rows > 0) 
          {
              while($row = $result->fetch_assoc()) 
              {
                  $str .= "<option>".$row["task_name"]."</option>";
              }            
          } 
      }
      function displayAll($conn, $tb_nm)
      {
       global $s;    
       $s = "";         
       $sql = "SELECT * FROM $tb_nm WHERE done = FALSE";
       $result = $conn->query($sql);
       
       $s .= "<div style = 'color: #fff; margin-top: 55px;'>Todo list: (".$result->num_rows.")</div>";
       $s .= "<form method = 'post' action = 'mark&delete-final.php'  margin-top: 15px;>"; 
       
       $s .= "<input type='text' name='username' style='display: none;' value='" . $_GET['username'] . "'>";
       $s .= "<ul style = 'margin-top: 0px'; role='list' class='list-3 w-list-unstyled'>";
       
       if ($result->num_rows == 0)
       {
           $s .= "<li class='list-item' style = 'color: #a3dff3;'>Woohoo! All done for now! Add a task to start</li>";
       }
       else if ($result->num_rows > 0) 
       {
           while($row = $result->fetch_assoc()) 
           {
               $s .= "<li class='list-item'>";
               $s .= "<input style = 'margin-right: 5px;' type = 'checkbox' onchange = 'this.form.submit()'";
               $s .= " name = 'chkbx1[]' value ='".$row["task_name"]."' unchecked><span style = 'width: 300px;'>".$row["task_name"]."</span>";
               $s .= "<input type = 'checkbox'  name = 'delete[]' value ='".$row["task_name"]."' onclick = 'this.form.submit()' unchecked>";
               $s .= "</li>";
           }
           $s .= "</ul>";            
       } 
       $s.="</form>";
       
       $sql = "SELECT * FROM $tb_nm WHERE done = TRUE";
       $result = $conn->query($sql);
       $s .= "<div style = 'color: #fff; margin-top: 30px;'>Completed tasks: (".$result->num_rows.")</div>";
       $s .= "<form method = 'post' action = 'mark&delete-final.php'  margin-top: 15px;>"; 
       $s .= "<input type='text' name='username' style='display: none;' value='" . $_GET['username'] . "'>";
       $s .= "<ul style = 'margin-top: 0px'; role='list' class='list-3 w-list-unstyled'>";
       
       $i = 0; 
       if ($result->num_rows > 0) 
       {
       // output data of each row
           while($row = $result->fetch_assoc()) 
           {
               $s .= "<li class='list-item'>";
               $s .= "<input style = 'margin-right: 5px;' type = 'checkbox' onclick = 'unchecking($i);'";
               $s .= "value ='".$row["task_name"]."' checked><span style = 'width: 300px;'>".$row["task_name"]."</span>";
               $s .= "<input class = 'delBtn' type = 'checkbox' name = 'delete[]' value ='".$row["task_name"]."' onclick = 'this.form.submit()' unchecked>";
               $s .="<input type = 'checkbox' value ='".$row["task_name"]."' class = 'hidden' id = $i name = 'chkbx2[]' unchecked>";
               $s .= "</li>";
               $i++;
           }           
       }
       else 
       {
           $s .= "<li class='list-item' style = 'color: #a3dff3;'>Start the timer to get a task done!</li>";
       }
       $s .= "</ul>";           
       $s .= "</form>";
       }
    ?>
    <!-- PHP Code Ends -->
    
  <div class="header wf-section" style = 'z-index: 50;'>
    <div class="container-12 w-container">
      <div class="text-block-2 link-2">
          <a href="index.php" class="link-2">NoSlack.</a>

      </div>
      <div class="text-block-5" id = 'time'></div>
      <div class="text-block-4">|</div>
      <div class="text-block-3" id = 'date'></div>
      <a href="log-in.html" class="link-block w-inline-block">
        <div class="div-block-2"><img src="images/user.svg" loading="lazy" alt="" class="image"></div>
      </a>
    </div>
  </div>
  <div class="div-body">
    <div class="div-taskmanager" >
      <div class="div-block-29"></div>
          <div class="container-8 w-container">
               
                <!-- Add Task Begins -->
              <form name="wf-form-AddTask" data-name="AddTask" method="get" action="add_task.php" class="form-6">
                  <input type="text" name="username" id="user" style="display: none;" value="">
                  <input type="text" class="text-field-4 w-input" style= "width: 310px" name="task" data-name="AddTask" placeholder="Add a task..." id="AddTask">
                  <input type = "submit" name = "submit" value = "Add Task" id="btn1"><br>
              </form>
              
              <?php 
                    echo $s;
              ?>
              <!-- Add Task Ends -->
         </div>
    </div>
    <div class="div-focusspace">
      <div id="w-node-_9647b609-47b2-4ec9-3225-4f54f2fee108-2f0b122b" style = "margin-top: 34px; height: 100px;"class="div-block-19">
          <img src="images/rocket_3-2.svg" loading="lazy" width="70" alt="" class="image-9">
        <div class="text-block-24" style = "margin-bottom: 30px;">Focus Space</div>
        <br>
        <div class="text-block-25" style = "margin-top: 55px; margin-bottom: 30px;">
            What is one outcome you’d like to achieve? Do it as efficiently as you can.
        </div>
        <form id = "select-form" class="" action="landing.php" method="post">
            <select class="" id = "task" name="chosen_task" required>
                <option disabled hidden selected>Select a task</option>
                <?php echo $str; ?>
            </select>
            <select id = "duration" class="" name="duration">
                <option disabled hidden selected>Select duration</option>
                <option value="15">15 minutes</option>
                <option value="30">30 minutes</option>
                <option value="45">45 minutes</option>
                <option value="60">60 minutes</option>
            </select>
            <br>
            <input id = 'start-timer-button' type="submit" name="" value="Start Timer">
        </form>
      </div>
    </div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=625c5b5cd45c9940660b122a" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>