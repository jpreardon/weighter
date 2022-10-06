<?php
    require_once 'functions.php';
    // If there are post parameters, check the username and password, otherwise, just display the page
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_POST['username'] == $username && $_POST['password'] == $password) {
            // If there's a match, set the cookie
            $hashed = password_hash($username . $password, PASSWORD_DEFAULT);
            setcookie('loginhash', $hashed, time()+60*60*24*90, '/', $domain);
             // Redirect to home
             header('Location: index.php');
        } else {
            // If there's no match, display page with error message.
            $error_message = "Wrong username or password";
        }
    } 

    page_top();
?>
    <h2>Login</h2>
    <?php
        if ($error_message) {
            echo '<p>' . $error_message . '</p>';
        }
    ?>
    <form method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <input type="submit" name="login" value="login">
    </form>

<?php
    page_bottom();
?>