<?php
    require_once 'config.php';

    // Top of HTML Page
    function page_top() {
        print '<!DOCTYPE html>';
        print '<html lang="en">';
        print '<head>';
        print '<title>Weighter 3</title>';
        print '<meta name="viewport" content="width=device-width,initial-scale=1">';
        print '</head>';
        print '<link href="styles.css" rel="stylesheet">';
        print '<body>';
        print '<h1>Weighter</h1>';
    }

    // Bottom of HTML Page
    function page_bottom()  {
        print '</body>';
        print '</html>';
    }

    // Auth
    function authorize($username, $password) {
        if (!password_verify($username . $password, $_COOKIE['loginhash'])) {
            // If not authorized, redirect to login
            header('Location: login.php');
        }
    }
?>