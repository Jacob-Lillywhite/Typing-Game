<?php
session_start(); // Start Session to access Session Variables
// If the username is invalid redirect the guest to the login page.
if($_SESSION['username']==null){
    header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/loginselect.php'); 
}
// Otherwise Load up the Word Array from the Database
else{

    include 'php/Connect.php';
    include 'php/Sql.php';
    // Database words come from Moby Project - 2 syllable adjectives (5187 words)
    $result = mysqli_query($con, $wordsSQL) or die("BAD QUERY");
                while($row = mysqli_fetch_assoc($result))
                {
                    $rows[]=$row['COL 1'];
                }
}
?>

<!--  __________________________________     -->
<!-- |               HTML               |    -->
<!-- |__________________________________|    -->
<html>
  <head>
    <title>JQuery Typing Game</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="game.css?Version=3.3 ">
    <!-- External JQUERY libraries on the google CDN -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
<!--  __________________________________     -->
<!-- |           JAVASCRIPT             |    -->
<!-- |__________________________________|    -->
<!-- | DESCRIPTION: Script to play      |    -->
<!-- | the typing game.                 |    -->
<!-- |__________________________________|    --> 
    <script>

        //Wait for the webpage to be ready
        $(document).ready(function() 
        {

            //  ________________________________
            // |    RANDOM NUMBER GENERATOR     |
            // |________________________________|
            // | DESCRIPTION:                   |
            // | A function to generate a       |
            // | random number on a given       |
            // | range.                         |
            // |________________________________|
            function randomFromTo(from, to)
            {
                return Math.floor(Math.random() * (to - from + 1) + from);
            }
            var arrstring = <?php echo json_encode($rows); ?> // Grab the words Array from the Database
            //  __________________________________ 
            // |    JAVASCRIPT-HTML NAVIGATION    |
            // |__________________________________|
            // | DESCRIPTION: Script to set the   |
            // | navigation bar according to the  |
            // | SESSION's state.                 |
            // |__________________________________|
                var username = "<?php echo $_SESSION['username']; ?>"; 
                if(username!= null && username!= ""){
                    document.getElementById("navigation").innerHTML = "<ul><li><a href= '/index.php'>Home</a></li><li><a href='/game.php'>Play Now</a></li><li><a href='/aboutus.php'>About Us</a></li><li><a>"+username+"<span class='caret'></span></a><div><ul><li><a href='php/Logout.php'>LOGOUT</a></li></ul></div></li></ul>";
                }
                else
                {
                    document.getElementById("navigation").innerHTML = "<ul><li><a href= '/index.php'>Home</a></li><li><a href='/game.php'>Play Now</a></li><li><a href='/aboutus.php'>About Us</a></li><li><a href='/loginselect.php'>Login</a></li></ul>";
                }

        
                //  ________________________________
                // |           VARIABLES            |
                // |________________________________|

                var children = $("#container").children();          // Variable that keeps track of the CHILDREN of the game CONTAINER (for looping)
                var child = $("#container div:first-child");        // Variable that keeps track of the FIRST child (for looping) 
                var lastChild = $("#container div:last-child");     // Variable that keeps track of the LAST child (for looping)
                var animatedElements;                               // Variable to store ELEMENTS with the ANIMATEDBOX Id (<divs> that contain the words in <spans>)
                // --ELEMENT MOVEMENT VARIABLES--
                var movement = "70%";                               // Variable to dictate the animatedboxes MOVEMENT DISTANCE (horizontally)
                var left_position = "15%";                          // Variable to dictate the animatedboxes STARTING POSITION
                var speed = 10000;                                  // Variable that determines word ANIMATION SPEED.
                // --GAMEPLAY VARIABLES--
                var timer;                                          // Variable that holds the counter/timer INTERVAL
                var time = 0;                                       // Variable that contains the counter's TIME for arithmetic.
                var difficultyCheck;                                // Variable to determine whether difficulty increases (modulus math)
                var scorespan = document.getElementById("score");   // Variable to hold the SPAN LOCATION where score/counter/time is displayed.
                // -- CONTAINER POSITION VARIABLES
                var con_height = $("#container").height();          // Variable that holds the Container's Height
                var con_pos = $("#container").position();           // Variable that holds the Container's Position
                var min_top = con_pos.top;                          // Variable that holds the Minimum top position (for word animations)
                var max_top = min_top + con_height - 56;            // Variable that holds Maximum top position (for word animations)

                // Move animated boxes to the starting positions
                $(".animatedbox").css("left", left_position); 
        
                //  _________________________________
                // |        PLAY BUTTON ONCLICK      |
                // |_________________________________|
                // | DESCRIPTION: Function that      |
                // | dictates the btnPlay onclick()  |
                // |_________________________________|
                $("#btnplay").click(function() 
                {
                    if ($(this).text() == "Play")                  //Check if the game has been set to play
                    {   
                        timer = setInterval(function()              
                        {
                            time++                                 // Start the timer function
                            scorespan.innerText=time;                       
                        }, 1000);                       
                        startGame();                                // start the game
                        $(this).text("");                           // remove the play button
                    }
                        return false;                               // Otherwise it failed.
                });

    
                //  _________________________________
                // |        STARTGAME FUNCTION       |
                // |_________________________________|
                // | DESCRIPTION: Function that      |
                // | initializes the game.           |
                // |_________________________________|
                function startGame() 
                {
                    child = $("#container div:first-child");                                    // Start by looking at the first CHILD in the array
                    for (i=0; i<children.length; i++) 
                    {
                        var delaytime = 500 *i;                                                 // Variable to DELAY initial word creation/animation
                        var animationTimeout = setTimeout(function() 
                        {
                            randomIndex = randomFromTo(0, arrstring.length - 1);                // Generates a random number to grab a WORD from the array
                            randomTop = randomFromTo(min_top, max_top);                         // Generates a random number to determine the word's VERTICAL position
                            child.animate({"top": randomTop+"px"}, 'slow');                     // -- VERTICAL ANIMATION --
                            child.find(".match").text("");                                      // Set the matched text to none
                            child.find(".unmatch").text(arrstring[randomIndex]);                // Set the unmatched text to a random word
                            child.show();                                                       // Show the initialized word
                            child.animate({left: "+="+movement}, speed, "linear", function()    // -- HORIZONTAL ANIMATION --
                            {
                                // If a word reaches out-of-bounds stop the game and move the highscore page
                                clearInterval(timer);                                                                       // Stop the timer
                                clearTimeout(animationTimeout);                                                             // Stop the animations' Timeouts
                                $(document).find(".animatedbox").stop();                                                    // Stop the animated boxes/words 
                                document.getElementById("userscore").value = (document.getElementById("score").innerText);  // Set the score value to the timer value
                                document.getElementById("scoreForm").submit();                                              // Submit the data to the server/database
                            });
                            child = child.next();   // increment to the NEXT CHILD in the array of children
                        }, delaytime);          
                    }          
                }

                //  _________________________________
                // |        STARTGAME FUNCTION       |
                // |_________________________________|
                // | DESCRIPTION: Function that      |
                // | animates the newly created      |
                // | words similar to the            |
                // | initilization startGame()       |
                // | function, but for the words     |
                // | that come afterwards.           |
                // |_________________________________|
                function animateChild()
                {
                    var delaytime = 0;
                            var animationTimeout = setTimeout(function() 
                            {
                                randomIndex = randomFromTo(0, arrstring.length - 1);                       // Generates a random number to grab a WORD from the array
                                randomTop = randomFromTo(min_top, max_top);                                // Generates a random number to determine the word's VERTICAL position
                                lastChild.animate({"top": randomTop+"px"}, 'slow');                        // -- VERTICAL ANIMATION --
                                lastChild.find(".match").text("");                                         // Set the matched text to none
                                lastChild.find(".unmatch").text(arrstring[randomIndex]);                   // Set the unmatched text to a random word
                                lastChild.show();                                                          // Show the initialized word
                                lastChild.animate({left: "+="+movement}, speed, "linear", function()       // -- HORIZONTAL ANIMATION --
                                {   
                                        clearInterval(timer);                                                                       // Stop the timer
                                        clearTimeout(animationTimeout);                                                             // Stop the animations' Timeouts
                                        $(document).find(".animatedbox").stop();                                                    // Stop the animated boxes/words
                                        document.getElementById("userscore").value = (document.getElementById("score").innerText);  // Set the score value to the timer value
                                        document.getElementById("scoreForm").submit();                                              // Submit the data to the server/database
                                });
                            }, delaytime);
                }
        //  ________________________________
        // |      ON-KEY-PRESS FUNCTION     |
        // |________________________________|
        $(document).keypress(function(event) 
        {
            animatedElements = $(".animatedbox");                // Variable to grab all the ANIMATEDBOXES
            var arr3 = Array.from(animatedElements);             // Variable to store the ANIMATEDBOXES in an ARRAY
            var matchSpan = animatedElements.find(".match");     // Variable to grab all the animated boxes' MATCHED TEXT
            var arr2 = Array.from(matchSpan);                    // Variable to store all the MATCHED TEXT in an ARRAY
            var unmatchSpan = animatedElements.find(".unmatch"); // Variable to grab all the animated boxes' UNMATCHED TEXT
            var arr = Array.from(unmatchSpan);                   // Variable to hold all the UNMATCHED TEXT in an ARRAY
            var arrln = arr.length;                              // Variable to grab the UNMATCHED TEXT ARRAY LENGTH

            for (i=0; i<arrln; i++) 
            {
                compareText(arr[i].innerHTML, i);               //Loop through the unmatched spans and compare the inputkey to the first letter of the span
            }

            function compareText(param1, param2)
            {   
                var unmatchText = param1                                // Variable to store the unmatched text of the given word
                var inputChar = String.fromCharCode(event.charCode);    // Variable to store the typed key

                // IF the keypress matches a words first letter:
                if (inputChar == unmatchText.charAt(0))
                {
                    var str = unmatchText.replace(inputChar, "");      // Remove the first letter if it matches the keypress
                    unmatchSpan[param2].innerHTML = str;
                    arr2[param2].append(inputChar);                    // Add the first letter to the matched text if it matches 

                    // If it word is completely matched:
                    if (unmatchSpan[param2].innerHTML == "")  
                    {
                        arr3[param2].className = "animatedbox explodable";                                                                  // Set the word to be explodable
                        var nextToExplode = $(".explodable");                                                                               // Grab all the explodable words
                        nextToExplode.stop().effect("explode", 500);                                                                        // Apply the explode animation
                        nextToExplode.remove();                                                                                             // Destroy the exploded <div>
                        $("#container").append("<div class='animatedbox'><span class='match'></span><span class='unmatch'></span></div>");  // Create a new <div> to replace the destroyed one
                        children = $("#container").children();                                                                              // Make sure the children are updated to match the new <div>
                        lastChild = $("#container div:last-child");                                                                         // Make sure the last <div> in the newly added <div>
                        time =  parseInt(document.getElementById("score").innerText); // Parse the int from the timer.
                        difficultyCheck = time%20;                                    // See if the difficulty needs to increase (check how much time has elapsed)
                        if( difficultyCheck == 0)
                        {
                            speed= speed-1000;                                        // Increase the difficulty (increase word speed)
                        }
                        animateChild();                                               // Animate the newly created <div>
                    }
                }
                else
                {
                    // Take the unmatched letters and concat the matched characters to the unmatched characters to restore the original word
                    unmatchSpan[param2].innerHTML = matchSpan[param2].innerHTML + unmatchSpan[param2].innerHTML;
                    matchSpan[param2].innerHTML = "";
                }
            }
        });
    });
    </script>
    
<!--  __________________________________     -->
<!-- |               HTML               |    -->
<!-- |__________________________________|    -->    
  </head>
  <body>
        <nav id="navigation">
        </nav>
      <div id="toolbar">
          <div id="boxscore">
            <span>Score:</span><span id="score">0</span>
          </div>
          <div id="instructions">
          INSTRUCTIONS: Type the words before they leave the right side of the box. <br/>
          Background image <a href="http://www.freepik.com">designed by macrovector / Freepik</a>
          </div>
          <div id="boxcontrol">
            <a href="" id="btnplay">Play</a>
          </div>
          <div class="clear">
          </div>
      </div>
      <div id="container">
          <div class="animatedbox">
              <span class="match"></span><span class="unmatch"></span>
          </div>

          <div class="animatedbox">
              <span class="match"></span><span class="unmatch"></span>
          </div>

          <div class="animatedbox">
              <span class="match"></span><span class="unmatch"></span>
          </div>

          <div class="animatedbox">
              <span class="match"></span><span class="unmatch"></span>
          </div>
          <div class="animatedbox">
              <span class="match"></span><span class="unmatch"></span>
          </div>
      </div>
                <form type = "hidden" id="scoreForm" action="php/Highscore.php" method="POST">
                    <input type="hidden" name="userScore" id="userscore"  value=""/>
                </form>
  </body>
  <footer>
        <a href="https://www.youtube.com" target="_blank">
            <img alt="Youtube logo" src="/images/youtube.png" width="50" height="50">
            </a>
            <a href="https://www.facebook.com" target="_blank">
            <img alt="Facebook logo" src="/images/facebook.png" width="50" height="50">
            </a>
            <a href="https://www.twitter.com" target="_blank">
            <img alt="Twitter logo" src="/images/twitter.png" width="50" height="50"></a>
</footer> 
</html>