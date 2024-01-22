<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../img/logo.PNG" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/login.css">
        <title>Login - Sign Up</title>
    </head>
    <body>
        
        <input type="checkbox" id="chk-signup" aria-hidden="true">
        <input type="checkbox" id="chk-login" aria-hidden="true">

        <main>  	
            <img src="../img/logo.PNG" alt="">
            
            <form class="signup">
                <label for="chk-signup" aria-hidden="true">Sign up</label>
                <label for="txt">User name</label>
                <input type="text" id="txt" name="txt" placeholder="User name" required="">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required="">
                <label for="pswd">Password</label>
                <input type="password" id="pswd" name="pswd" placeholder="Password" required="">
                <button>Sign up</button>
            </form>
            
            <form class="login">
                <label for="chk-login" aria-hidden="true" id="loginLabel">Login</label>
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" placeholder="Email" required="">
                <label for="login-pswd">Password</label>
                <input type="password" id="login-pswd" name="pswd" placeholder="Password" required="">
                <button>Login</button>
            </form>        
                
        </main>
        
        <footer>
            <a href="homePreview.html">Home</a>
            <!-- Aggiungi altri link secondo necessità -->
            <p>Copyright © 2023 All Rights Reserved by ArtHub.</p>
        </footer>

        <script src="../js/login.js"></script>

    </body>
</html>