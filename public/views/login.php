<!DOCTYPE html>

<head>
    <title>Login | MakeMyDay</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;400&family=Nunito+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
    <script type="text/javascript" src="../js/login-registration-scripts.js" defer></script>
</head>

<body>
<div class="base-container">
    <div id="left">
        <img src="/public/img/logo.svg" alt="logo">
        <img src="/public/img/pic.png" alt="obrazek">
    </div>
    <div id="right">
        <div id="upper_btns">
            <a id="sign_in" class="active">Sign in</a>
            <a id="sign_up">Sign up</a>
        </div>
        <div id="head_welcome">
            <h1>Welcome</h1>
            <p>Please sign in.</p>
        </div>
        <form id="" action="login" method="POST">
            <div class="div-inp">
                <p>Email</p>
                <input name="email" type="text">
            </div>
            <div class="div-inp">
                <p>Password</p>
                <div class="field">
                    <input name="password" type="password">
                    <span class="showBtn"><img src="https://img.icons8.com/material-sharp/24/000000/visible.png"/></span>
                </div>
            </div>
            <button class = "btn" id="submit">Sign in</button>
            <div class="create-account">
                <p>Don't have an account? <a id="create-new-account" href="#">Create</a></p>
            </div>
        </form>
    </div>
</div>
</body>