<!DOCTYPE html>
<!--  Last Published: Mon Apr 25 2022 01:43:14 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="6260afefbc3411fc38e611b9" data-wf-site="625c5b5cd45c9940660b122a">
<head>
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
  <style type="text/css">
      #pauseButton, #done{
          background-color: #8484f4;
          color: white;
          border: 2px #a3dff3 solid; 
          width: 120px;
          height: 40px;
          text-align: center;
          position: absolute;
          font-size: 18px;
          top: 95%; border-radius: 10px;
      }
      #pauseButton
      {
          left: 27%;
      }
      #done
      {
          right: 15%;
          padding-top: 1%;
          list-style: none;
          text-decoration: none;

      }
      .text-block-20
      {
          margin-top: 7%;
      }
      #timer{
          margin-top: 5%; font-family: 'DM Serif Display', sans-serif; font-size: 30px;
          position: absolute; color: white; background-color: #ffffff00; 
          opacity: 100%; width: 18%; top: 20%;}
  </style>
  <meta charset="utf-8">
  <title>Landing</title>
  <meta content="Landing" property="og:title">
  <meta content="Landing" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/noslack-todo-app.webflow.css" rel="stylesheet" type="text/css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script> -->
  <script type="text/javascript">WebFont.load({  google: {    families: ["Varela:400","Inter:100,200,300,regular,500,600,700,800,900:cyrillic,latin","DM Serif Display:regular"]  }});</script>
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>        
  <link rel="stylesheet" type="text/css" href="css/jquery.countdown.css"> 
  <script type="text/javascript" src="js/jquery.plugin.js"></script> 
  <script type="text/javascript" src="js/jquery.countdown.js"></script>
   <script>  
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
  <?php 
    $task =  $_REQUEST['chosen_task'];
    $time = $_REQUEST['duration'];
   ?>
  <script>  
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
</head>
<body class="body-2" onload = 'displayResults()'>
    <div class = 'text-block-21' id="timer"></div>

    <script type="text/javascript">
        var secs = 60;
        var mins_to_add = <?php echo $time ?>; 
        $('#timer').countdown({until: secs * mins_to_add, format: 'HMS', compact: true, padZeroes: true,
                                onExpiry: timeUp}); //call back func!
            
        function timeUp()
        {
            alert("time is up!");
        }  
    </script>
  <div class="header wf-section">
    <div class="container-12 w-container">
        <div class="text-block-2">
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
  <div class="wf-section">

    <div class="div-focusmain">
      <div class="div-block-21">

        <h1 class="heading-3">You are making progress!</h1>
        <div class="div-block-23">
          <div class="text-block-27"><?php echo $task ?></div>
        </div><img src="images/FocusPageMain.svg" loading="lazy" alt="" class="image-10">
        <button  id = "pauseButton" >Pause</button>

        <script type="text/javascript">
        $('#pauseButton').click(function() 
        { 
            var pause = $(this).text() === 'Pause'; 
            $(this).text(pause ? 'Resume' : 'Pause'); 
            var heading = $(".heading-3").text() === "You are making progress!"; 
            $(".heading-3").text(heading ? 'Timer Paused' : 'You are making progress!'); 
            $('#timer').countdown(pause ? 'pause' : 'resume'); 
        }); 
        </script> 
        <a href = "task-completed.html" id = "done">Done</a>

        <!-- <a href="task-completed.html" class="link-block-5 w-inline-block"><img src="images/im-done.svg" loading="lazy" alt="" class="image-11"></a> -->
      </div>
      <div class="text-block-20">Target Duration: <?php echo $time ?> min</div>
      
    </div>
  </div>
  <!-- <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=625c5b5cd45c9940660b122a" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script> -->
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>