<?php
    require_once 'config.php';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $opt = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

        try {
            $dbh = new PDO($dbdsn, $dbusername, $dbpassword, $opt);
            $STH = $dbh->prepare("INSERT INTO weights (date,weight) VALUES (:date,:weight)");
            $STH->bindParam(':date', $_POST['date']);
            $STH->bindParam(':weight', $_POST['weight']);
            $STH->execute();
            $dbh = null;
            header('Location: index.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Weighter 3 - Add Weight</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link href="styles.css" rel="stylesheet">
    </head>
    <style>
        
    </style>
    <body>
        <h1>Weighter</h1>
        <a href="index.php">Home</a>
        <h2>Add Weight</h2>
        <form method="POST">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="<?php print date('Y-m-d'); ?>">
            <label for="weight">Weight</label>
            <input type="text" inputmode="decimal" name="weight" id="weight">
            <input type="submit" name="add weight" value="add weight">
        </form>
    </body>
</html>