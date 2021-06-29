<?php
session_start(); // Start Session to access Session Variables
?>

<!--  __________________________________     -->
<!-- |               HTML               |    -->
<!-- |__________________________________|    -->
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css?Version=1.9 ">
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
        <section id="GreetingSection">
            
                <img src="/images/keypout3.png"/>
                <h2>
                    A Typing Game
                </h2>
                <hr/>
                <br/>
                <a  href="/game.php"><input type="image" src="/images/startbutton.png" name="StartButton" class="StartButton"/></a>

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

<!--  __________________________________     -->
<!-- |           JAVASCRIPT             |    -->
<!-- |__________________________________|    -->
<!-- | DESCRIPTION: Script to set the   |    -->
<!-- | navigation bar according to the  |    -->
<!-- | SESSION's state.                 |    -->
<!-- |__________________________________|    -->
<script>
    var username = "<?php echo $_SESSION['username']; ?>";
    if(username!= null && username!= "")
        {
            document.getElementById("navigation").innerHTML = "<ul><li><a href= '/index.php'>Home</a></li><li><a href='/game.php'>Play Now</a></li><li><a href='/aboutus.php'>About Us</a></li><li><a>"+username+"<span class='caret'></span></a><div><ul><li><a href='php/Logout.php'>LOGOUT</a></li></ul></div></li></ul>";
        }
    else{
            document.getElementById("navigation").innerHTML = "<ul><li><a href= '/index.php'>Home</a></li><li><a href='/game.php'>Play Now</a></li><li><a href='/aboutus.php'>About Us</a></li><li><a href='/loginselect.php'>Login</a></li></ul>";
        }
</script>