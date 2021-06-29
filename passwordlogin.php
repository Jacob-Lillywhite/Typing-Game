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
                    USER LOGIN
                </h2>
                <hr/>
                <form id="passwordLoginForm" action="php/UserLogin.php" onsubmit="DoSubmit()" method="POST">
                    Password: <input id="oldPassword" type="text" name="password"/><br/>
                    <input type="hidden" name="username" value="<?php session_start(); echo $_SESSION['username'];?>"/>
                    <input id="newPassword" type="hidden" name="alteredPassword" value=""/>
                    <input type="submit" value="Next" id="UsernameSubmit" class="UsernameSubmit"/>
                </form>
                                <!-- External JS Hash Library -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/js-sha256/0.9.0/sha256.js"></script>
                <?php session_start(); ?>
                <script>
                    function DoSubmit(){
                        // Set the hidden altered password to a hashed value of the user entered password + the session salt variable
                        var errorCheck = "<?php echo $_SESSION['loginerror'];?>"
                        var saltedPassword = "" + document.getElementById("oldPassword").value + '<?php echo $_SESSION['userSalt'];?>';
                        document.getElementById("newPassword").value = sha256(saltedPassword);
                        // Clear the entered password so it's not passed to the server on submit.
                        document.getElementById("oldPassword").value = "";
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