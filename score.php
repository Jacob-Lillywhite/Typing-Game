<?php
session_start();
// If the username is invalid redirect the guest to the login page.
if($_SESSION['username']==null){
    header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/loginselect.php'); 
}
// If no score is available redirect to the homepage
if($_SESSION['myUserScore']==null){
    header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/index.php'); 
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="score.css?Version=1.6">
        <title>WSU CS3750 Assignment #1 - Lillywhite</title>
    </head>
    <body>
        <nav id="navigation">
            <ul>
               <li><a href="/index.php">Home</a></li>
               <li><a href="/game.php">Play Now</a></li>
               <li><a href="/aboutus.php">About Us</a></li>
               <li><a href="/loginselect.php">Login</a></li>
            </ul>
         </nav>
        <section id="ScoresSection">
                        <img src="/images/keypout3.png"/>
                <h2>
                    A Typing Game
                </h2>
                <hr/>
                <div id="myscores"></div>
                <h1>High Scores</h1>
                <hr/>
                <div id="highscores"></div>
        </section>  
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
<script>
var username = "<?php echo $_SESSION['username']; ?>";
if(username!= null && username!= ""){
             document.getElementById("navigation").innerHTML = "<ul><li><a href= '/index.php'>Home</a></li><li><a href='/game.php'>Play Now</a></li><li><a href='/aboutus.php'>About Us</a></li><li><a>"+username+"<span class='caret'></span></a><div><ul><li><a href='php/Logout.php'>LOGOUT</a></li></ul></div></li></ul>";
}
                else{
document.getElementById("navigation").innerHTML = "<ul><li><a href= '/index.php'>Home</a></li><li><a href='/game.php'>Play Now</a></li><li><a href='/aboutus.php'>About Us</a></li><li><a href='/loginselect.php'>Login</a></li></ul>";
                }
                var usernamesArr = <?php echo json_encode($_SESSION['usernames']); ?> // Grab the Words Array
                var userScoresArr = <?php echo json_encode($_SESSION['userscores']); ?> // Grab the Words Array
                var myUsernamesArr = <?php echo json_encode($_SESSION['myUsernames']); ?> // Grab the Words Array
                var myUserScore = <?php echo json_encode($_SESSION['myUserScore']); ?> // Grab the Words Array
                document.getElementById("highscores").innerHTML = highscoresFunction();
                document.getElementById("myscores").innerHTML = myScoresFunction();
        
                function highscoresFunction(){
                var highscoresString ="";
                    for(i=0; i<usernamesArr.length; i++)
                    {
                        var j = i+1;
                       highscoresString+= j+". "+usernamesArr[i] +": "+ userScoresArr[i]+ "<br/>";
                    }
                    return highscoresString;
                }
                function myScoresFunction(){
                    
                var myScoresString ="<h1><?php echo $_SESSION['username'];?>"+"\'s Score:</h1><hr/> YOUR SCORE: "+myUserScore+"<hr/>"; 
                    return myScoresString;
                }

</script>