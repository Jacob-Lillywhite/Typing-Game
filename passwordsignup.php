<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css?Version=1.7 ">
        <title>WSU CS3750 Assignment #1 - Lillywhite</title>
    </head>
    <header>
            <nav id="navigation">
                    <ul>
               <li><a href="/index.php">Home</a></li>
               <li><a href="/game.php">Play Now</a></li>
               <li><a href="/aboutus.php">About Us</a></li>
               <li><a href="/loginselect.php">Login</a></li>
                    </ul>
                 </nav>
    </header>
    <body>

        <section id="LoginSection">

                <h2>
                    USER SIGNUP
                </h2>
                <hr/>
                <form id="passwordSignupForm" action="php/UserSignup.php" onsubmit="DoSubmit()" method="POST">
                    Password: <input type="text" id="oldPassword" name="password"/><br/>
                    <input type="hidden" name="username" value="<?php session_start(); echo $_SESSION['username'];?>"/>
                    <input type="hidden" name="alteredPassword" id="newPassword"  value=""/>
                    <input type="hidden" name= "userSalt" id="salt" value=""/>
                    <input type="submit" value="Next" id="UsernameSubmit" class="UsernameSubmit"/>
                </form>

                <!-- External JS Hash Library -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.js"></script>
                <?php session_start(); ?>
                <script>
                    function DoSubmit(){
						// Clientside generated Salt;
                        var salt = Math.random().toString(16).substring(2,15);
                        // Set the hidden altered password to a hashed value of the user entered password + the session salt variable
                        var saltedPassword = "" + document.getElementById("oldPassword").value + salt;  // Alternatively A server generated salt: '<?php echo $_SESSION['salt'];?>'
                        document.getElementById("newPassword").value = sha256(saltedPassword);
                        // Clear the entered password so it's not passed to the server on submit.
                        document.getElementById("oldPassword").value = "";
						// Set the hidden salt field
                        document.getElementById("salt").value = salt;
                        // Return true to submit the altered form data.
                        return true;
                    }
                </script>

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