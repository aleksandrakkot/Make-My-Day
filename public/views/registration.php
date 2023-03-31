<!DOCTYPE html>

<head>
    <title>Register | MakeMyDay</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;400&family=Nunito+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style.css">
    <script type="text/javascript" src="/public/js/login-registration-scripts.js" defer></script>
</head>

<body>
<div class="base-container">
    <div id="left">
        <img src="/public/img/logo.svg" alt="logo">
        <img src="/public/img/pic.png" alt="obrazek">
    </div>
    <div id="right">
        <div id="upper_btns">
            <div>
                <a id="sign_in" href="/login">Sign in</a>
            </div>
            <div>
                <a id="sign_up" class="active" href="/registration">Sign up</a>
            </div>
        </div>
        <div id="head_welcome">
            <h1>Welcome</h1>
            <p>Please create your account.</p>
        </div>
        <form class="multi-step-form" action="register" method="POST" data-multi-step>
            <?php if(isset($messages)){
                foreach ($messages as $message ){
                    echo $message;
                }
            }
            ?>
            <div class="step " data-step>
                <div class="div-inputs">
                    <div class="div-inp">
                        <p>Email:</p>
                        <input name="email" type="text">
                    </div>
                    <div class="div-inp">
                        <p>Nick:</p>
                        <input name="nick" type="text">
                    </div>
                    <div class="div-inp">
                        <p>Password:</p>
                        <div class="field">
                            <input name="password" type="password">
                            <span class="showBtn"><img src="https://img.icons8.com/material-sharp/24/000000/visible.png"/></span>
                        </div>
                    </div>
                    <div class="div-inp">
                        <p>Confirm password:</p>
                        <input name="confirm_password" type="password">
                    </div>
                </div>
                    <div class="div-btn">
                        <button type="button" class="btn" data-next>Next</button>
                    </div>
            </div>
            <div class="step" data-step>
                <div class="div-inputs">
                    <div class="div-inp2">
                        <p>Imię:</p>
                        <input name="imie" type="text">
                    </div>
                    <div class="div-inp2">
                        <p>Nazwisko:</p>
                        <input name="nazwisko" type="text">
                    </div>
                    <div class="div-inp2">
                        <p>Country:</p>
                        <select name = "country" id="select-country">
                            <?php foreach ($country as $key): ?>
                                <option value="<?= $key['country_id'] ?>"><?= $key['country_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="div-btn">
                    <button id="submit-reg" class="btn">Create account</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
