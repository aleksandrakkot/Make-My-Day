<!DOCTYPE html>

<head>
    <title>Create plan | MakeMyDay</title>
    <link rel="stylesheet" href="/public/css/rankings_style.css">
    <link rel="stylesheet" href="/public/css/dayplan_style.css">
    <link rel="stylesheet" href="/public/css/add_plan_style.css">
    <script src = "/public/js/createplan.js" type="text/javascript" defer></script>
    <script type="text/javascript" src="/public/js/admin.js" defer></script>
</head>

<body>
<div class="base-container" id="<?=json_decode($_COOKIE['logUser'], true)['is_admin']?>">
    <nav class="menu">
        <ul>
            <li>
                <div class="menu-icons">
                    <a class="nonactive" href="/rankings">
                        <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.0662 26.9231L2 29V4.07692L11.0662 2V26.9231Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.0662 26.9231L20.1534 29V4.07692L11.0662 2V26.9231Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M29.2194 26.9231L20.1533 29V4.07692L29.2194 2V26.9231Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="preview">rankings</span>
                    </a></div>
            </li>
            <li>
                <div class="menu-icons">
                    <a class="nonactive" href="/yourplans">
                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.9817 17.5562C21.9816 19.3017 21.5388 21.0192 20.6941 22.5505C19.8494 24.0818 18.63 25.3778 17.148 26.3191C15.6661 27.2604 13.9692 27.8167 12.2136 27.937C10.4581 28.0573 8.70023 27.7376 7.10189 27.0073C5.50355 26.277 4.11609 25.1597 3.0672 23.7581C2.01832 22.3565 1.34173 20.7157 1.0997 18.9867C0.857672 17.2578 1.05799 15.4962 1.68221 13.8642C2.30644 12.2321 3.33451 10.7821 4.67179 9.64746" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.0293 13.7059C10.8075 14.16 10.6927 14.6582 10.6936 15.1628C10.6908 15.5817 10.7719 15.997 10.9322 16.3846C11.0926 16.7722 11.3289 17.1243 11.6276 17.4206C11.9262 17.7168 12.2812 17.9513 12.672 18.1103C13.0627 18.2694 13.4814 18.3498 13.9037 18.3471C14.3322 18.3471 14.7432 18.5159 15.0461 18.8165C15.3491 19.117 15.5193 19.5246 15.5193 19.9496V27.1716" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M1.14679 19.1588H5.0284C5.45973 19.1476 5.88894 19.2223 6.29071 19.3784C6.69247 19.5345 7.05865 19.7688 7.36764 20.0676C7.67662 20.3663 7.92216 20.7234 8.08977 21.1178C8.25737 21.5122 8.34365 21.9359 8.3435 22.3639V27.4629" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M27.7727 3.96541L25.6745 3.25778C25.5271 3.20809 25.3673 3.20764 25.2195 3.2565C25.0717 3.30535 24.9442 3.40082 24.8563 3.52834L23.3246 5.88015L14.9319 1.71766C14.2686 1.3299 13.5271 1.09235 12.7604 1.02202C11.9938 0.951691 11.2209 1.05031 10.4972 1.31083C9.77344 1.57135 9.11668 1.98732 8.57392 2.52898C8.03115 3.07065 7.61578 3.72462 7.35754 4.44409C7.28636 4.63074 7.25578 4.83021 7.26781 5.02941C7.27984 5.22861 7.3342 5.42303 7.42732 5.59992C7.52045 5.77681 7.65024 5.93216 7.80816 6.05578C7.96609 6.1794 8.14858 6.26849 8.34367 6.31722L13.8199 8.06546L14.3654 8.25278L15.3935 11.7493C15.4265 11.871 15.49 11.9825 15.578 12.0735C15.666 12.1644 15.7758 12.2319 15.8971 12.2696L18.3729 13.0605C18.4993 13.1013 18.6342 13.1093 18.7646 13.0836C18.8949 13.0579 19.0165 12.9994 19.1176 12.9138C19.2187 12.8282 19.2959 12.7182 19.3418 12.5945C19.3878 12.4707 19.4009 12.3374 19.38 12.2071L18.8345 9.60559H19.1912L24.5415 11.333C24.8922 11.4529 25.2764 11.4305 25.6104 11.2707C25.9445 11.1108 26.2013 10.8265 26.325 10.4797L28.2133 4.71466C28.2341 4.55897 28.2021 4.40086 28.1223 4.26521C28.0425 4.12956 27.9196 4.02409 27.7727 3.96541Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="preview">your plans</span>
                    </a></div>
            </li>
            <li>
                <div class="menu-icons">
                    <a class="nonactive" href="/favourites">
                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.6183 28L3.06716 15.5635C-3.21065 8.10165 6.01772 -6.22516 14.6183 5.36563C23.2189 -6.22516 32.4054 8.1514 26.1695 15.5635L14.6183 28Z" stroke="#000001" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="preview">favourites</span>
                    </a></div>
            </li>
            <li>
                <div class="menu-icons">
                    <a class="nonactive" href="/search">
                        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.3484 23.5139C18.616 23.5139 23.6969 18.474 23.6969 12.2569C23.6969 6.0399 18.616 1 12.3484 1C6.08087 1 1 6.0399 1 12.2569C1 18.474 6.08087 23.5139 12.3484 23.5139Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M28.2195 28L20.3677 20.2115" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="preview">search</span>
                    </a>
                </div>
            </li>
            <li>
                <div class="menu-icons">
                    <a class="nonactive" href="/admin" id="moderate-icon">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 8H30V10H16V8ZM6 10.59L3.41 8L2 9.41L6 13.41L14 5.41L12.59 4L6 10.59ZM16 22H30V24H16V22ZM6 24.59L3.41 22L2 23.41L6 27.41L14 19.41L12.59 18L6 24.59Z" stroke="#000001" stroke-width="1" fill="white"/>
                        </svg>
                        <span class="preview">unconfirmed plans</span>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="content">
        <header class="top-site">
            <div id="logo">
                <a href="/rankings">
                    <img src="public/img/logo.svg">
                </a>
            </div>
            <div id="username-logout">
                <a href="/userprofile" class="username-button">
                    <div class="username">
                        <h5><?=
                            json_decode($_COOKIE['logUser'], true)['nick']?>
                        </h5>
                        <svg width="30" height="28" viewBox="0 0 30 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.24 15.6482C19.3178 15.6482 22.6235 12.4022 22.6235 8.39817C22.6235 4.3941 19.3178 1.14816 15.24 1.14816C11.1622 1.14816 7.85651 4.3941 7.85651 8.39817C7.85651 12.4022 11.1622 15.6482 15.24 15.6482Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M29.28 30.1482C28.3262 27.2278 26.4526 24.6802 23.9293 22.8728C21.406 21.0654 18.3634 20.0915 15.24 20.0915C12.1167 20.0915 9.07401 21.0654 6.5507 22.8728C4.02738 24.6802 2.15378 27.2278 1.20001 30.1482H29.28Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </a>
                <a href="/logout" class="log-out-button">
                    <form class="log-out" id="logout" action="logout" method="get">
                        <svg width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.9645 13.4615H29.2074" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24.8523 9L29.2074 13.4615L24.8523 17.9231" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24.9199 21.1596C22.9941 22.8875 20.5117 24.0799 17.7922 24.5835C15.0726 25.0871 12.2402 24.8788 9.65931 23.9854C7.0784 23.092 4.86701 21.5544 3.30959 19.5703C1.75216 17.5862 0.919922 15.2464 0.919922 12.8519C0.919922 10.4573 1.75216 8.11752 3.30959 6.13344C4.86701 4.14936 7.0784 2.61174 9.65931 1.71835C12.2402 0.824956 15.0726 0.616656 17.7922 1.12024C20.5117 1.62383 22.9941 2.81626 24.9199 4.54418" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </form>
                </a>
            </div>
        </header>
        <?php
        ini_set('max_file_uploads', '50');
        ?>
            <form class="create_plan_form" action="addplan/1" method="POST" enctype="multipart/form-data">
                <div class="top10">
                    <h1 id="create-plan">CREATE PLAN</h1>
                    <div class="info">
                        <div class="plan-photo ">
                            <input type="file" name="file" id="file" class="inputfile">
                            <label for="file"><svg width="29" height="23" viewBox="0 0 29 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M28 7.23077C28 6.67993 27.7812 6.15166 27.3917 5.76216C27.0022 5.37266 26.4739 5.15385 25.9231 5.15385H21.7692L18.6538 1H10.3462L7.23077 5.15385H3.07692C2.52609 5.15385 1.99782 5.37266 1.60832 5.76216C1.21882 6.15166 1 6.67993 1 7.23077V19.6923C1 20.2431 1.21882 20.7714 1.60832 21.1609C1.99782 21.5504 2.52609 21.7692 3.07692 21.7692H25.9231C26.4739 21.7692 27.0022 21.5504 27.3917 21.1609C27.7812 20.7714 28 20.2431 28 19.6923V7.23077Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.5002 17.0962C17.0811 17.0962 19.1733 15.0039 19.1733 12.4231C19.1733 9.84221 17.0811 7.75 14.5002 7.75C11.9194 7.75 9.82715 9.84221 9.82715 12.4231C9.82715 15.0039 11.9194 17.0962 14.5002 17.0962Z" stroke="#000001" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </label>
                        </div>
                        <div class="plan-info">
                            <div class="main-input name">
                                <p>Plan's name</p>
                                <input name="day_plan_name" required type="text">
                            </div>
                            <div class="main-input country">
                                <p>Country</p>
                                <select name = "country" id="select-country">
                                    <?php foreach ($countries as $key): ?>
                                        <option value="<?= $key['country_id'] ?>"><?= $key['country_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="main-input city">
                                <p>City</p>
                                <select name = "city" id="select-city">
                                    <?php foreach ($cities as $key): ?>
                                        <option value="<?= $key['city_id'] ?>"><?= $key['city_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detailed-plan-info">
                    <div class="description">
                        <h2>Description</h2>
                        <textarea name="description" class="plan-desc" placeholder="My day was really amazing..."></textarea>
                    </div>
                    <div class="plan-steps">
                        <h2>Day plan</h2>
                        <div class="step-info">
                            <div class="number-time">
                                <p id="number-of-step">1</p>
                                <p>Start time - End time</p>
                                <p id="#time"><input name="milestone_start_time[]" required type="time"> - <input name="milestone_end_time[]" required type="time"></p>
                            </div>
                            <div class="step-description">
                                <div class="milestone-input name">
                                    <p>Milestone name</p>
                                    <input name="milestone_location_name[]" type="text">
                                </div>
                                <div class="milestone-input street">
                                    <div class="street-info st">
                                        <p>Street</p>
                                        <input name="milestone_street_name[]" type="text">
                                    </div>
                                    <div class="street-info nb">
                                        <p>Number</p>
                                        <input name="milestone_street_number[]"  type="text">
                                    </div>
                                </div>
                                <div class="milestone-input description">
                                    <p>Description</p>
                                    <textarea name="milestone_description[]" placeholder="It was fun..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="milestone-buttons">
                        <button type="button" id="add-next-milestone">Add next milestone</button>
                        <button id="save" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

<template id="template_milestone">
    <div class="step-info">
        <div class="number-time">
            <p id="number-of-step">1</p>
            <p>Start time - End time</p>
            <p id="#time"><input name="milestone_start_time[]" type="time" required> - <input name="milestone_end_time[]" type="time" required></p>
        </div>
        <div class="step-description">
            <div class="milestone-input name">
                <p>Milestone name</p>
                <input name="milestone_location_name[]" type="text">
            </div>
            <div class="milestone-input street">
                <div class="street-info st">
                    <p>Street</p>
                    <input name="milestone_street_name[]" type="text">
                </div>
                <div class="street-info nb">
                    <p>Number</p>
                    <input name="milestone_street_number[]"  type="number">
                </div>
            </div>
            <div class="milestone-input description">
                <p>Description</p>
                <textarea name="milestone_description[]" placeholder="It was fun..."></textarea>
            </div>
        </div>
    </div>
</template>
