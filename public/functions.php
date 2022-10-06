<?php
    require_once 'config.php';

    // Top of HTML Page
    function page_top() {
        $html = <<<EOF
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Weighter 3</title>
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <link href="styles.css" rel="stylesheet">
            </head>
            <body>
                <h1>Weighter</h1>
        EOF;

        echo $html;
    }

    // Bottom of HTML Page
    function page_bottom()  {
        $html = <<<EOF
            </body>
        </html>
        EOF;
        
        echo $html;
    }

    // Auth
    function authorize($username, $password) {
        if (!password_verify($username . $password, $_COOKIE['loginhash'])) {
            // If not authorized, redirect to login
            header('Location: login.php');
        }
    }
?>