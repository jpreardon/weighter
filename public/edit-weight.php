<?php
    require_once 'functions.php';
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $opt = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

        try {
            $dbh = new PDO($dbdsn, $dbusername, $dbpassword, $opt);
            $STH = $dbh->prepare("UPDATE weights SET date = :date, weight = :weight WHERE id = :id");
            $STH->bindParam(':id', $_POST['id']);
            $STH->bindParam(':date', $_POST['date']);
            $STH->bindParam(':weight', $_POST['weight']);
            $wha = $STH->execute();
            $dbh = null;
            header('Location: index.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    $id = $_GET['id'];
    $dbquery = 'SELECT id, date, weight FROM weights WHERE id = "' . $id .'"';
    $dbh = new PDO($dbdsn, $dbusername, $dbpassword);
    $sth = $dbh->prepare($dbquery);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
?>

<?php
    page_top();
?>
        <a href="index.php">Home</a>
        <h2>Edit Weight</h2>
        <form method="POST">
            <input type="hidden" id="id" name="id" value="<?php print $result['id']; ?>">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="<?php print $result['date']; ?>">
            <label for="weight">Weight</label>
            <input type="text" inputmode="decimal" name="weight" id="weight" value="<?php print $result['weight']; ?>">
            <input type="submit" name="edit weight" value="edit weight">
        </form>
<?php
    page_bottom();
?>