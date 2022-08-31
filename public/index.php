<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Weighter 3</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
    </head>
    <link href="styles.css" rel="stylesheet">
    <body>
        <h1>Weighter</h1>
        <a href="add-weight.php">Add Weight</a>
        <p>Previously</p>
        <table>
            <tr>
                <th>Date</th>
                <th class="right-align">Weight</th>
            </tr>
            <?php
                require_once 'config.php';
                /* Connect to a MySQL database using driver invocation */
                $dbh = new PDO($dbdsn, $dbusername, $dbpassword);
            
                /* Grab some data */
                $dbquery = 'SELECT id, date, weight FROM weights ORDER BY date DESC LIMIT 8';

                foreach ($dbh->query($dbquery) as $row) {
                    $id = $row['id'];
                    $weekday = date_format(date_create($row['date']), 'l');
                    $month = date_format(date_create($row['date']), 'M');
                    $day = date_format(date_create($row['date']), 'd');
                    $weight = trim($row['weight']);

                    print "<tr>";
                    print '<td>' . $weekday . ' (' . $day . strtoupper($month) . ')' . '</td>';
                    print '<td class="right-align">' . '<a href="edit-weight.php?id=' . $id . '">' . $weight . '</a></td>';
                    print "</tr>";
                }

                $dbh = null;
            ?>
        </table>
    </body>
</html>