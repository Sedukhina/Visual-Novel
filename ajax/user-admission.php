<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="/ajax/forms.js"></script>

    <!--Registration form-->
    <div class="userForm" id="regForm">
        <form action="/ajax/registration.php" method="POST">
            <button type="button" class="closeButton" onclick="closeForm('regForm')">x</button>
            <label for="email"> Email </label>
            <input type="text" name="email" placeholder="Type your email here" id="email" required>
            <label for="username"> Username </label>
            <input type="text" name="username" placeholder="Your in game name" id="username" required>
            <div class = "column">
                <input type="radio" name = "gender" id = "female" value = Female>
                <label for="female">Female</label>
            </div>
            <div class = "column">
                <input type="radio" name = "gender" id = "male" value = Male>
                <label for="female">Male</label>
            </div>
            <label for="birthday"> Birthday </label>
            <input type="date" name="birthday" min="1900-01-01" max = "2010-01-01" id="birthday" required>
            <label for="password"> Password </label>
            <input type="password" name="password" placeholder="********" id="password" required>
            <p><button class="formSubmission" type="submit" value="Log In">Next</button></p>
        </form>
    </div>

    <!--Sign in form-->
    <div class="userForm" id="loginForm">
        <form action="/ajax/login.php" method="POST">
            <button type="button" class="closeButton" onclick="closeForm('loginForm')">x</button>
            <label for="email"> Email </label>
            <input type="text" name="email" placeholder="Type your email here" id="email" required>
            <label for="password"> Password </label>
            <input type="password" name="password" placeholder="********" id="password" required>
            <p><button class="formSubmission" type="submit" value="Log In">Log In</button></p>
        </form>
    </div>
    </head>

<body>
    <div class="box topmargin width100">
        <button onclick="openForm('loginForm')">Sign In</button>
        
        <button onclick="openForm('regForm')">Sign Up</button>
    </div>
</body>
</html>