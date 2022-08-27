
<?php
    include 'config.php';
    /* Connect to a MySQL database using driver invocation */
    $dbh = new PDO($dbdsn, $dbusername, $dbpassword);

    /* Grab some data */
    $dbquery = 'SELECT date, weight FROM weights ORDER BY date DESC LIMIT 7';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Weighter 3</title>
    </head>
    <style>
        body {
            font-family: sans-serif;
        }

        td, th {
            padding: .25rem .75rem .25rem 0;
            text-align: left;
        }

        .right-align {
            text-align: right;
        }     
        
        /* Colors */
        body {
            background-color: #fff;
            color: #444;
        }
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #222;
                color: #fff;
            }
        }
    </style>
    <body>
        <h1>Weighter</h1>
        <p>Last 7 Weights</p>
        <table>
            <tr>
                <th>Date</th>
                <th class="right-align">Weight</th>
            </tr>
            <?php
                foreach ($dbh->query($dbquery) as $row) {
                    $weekday = date_format(date_create($row['date']), 'l');
                    $month = date_format(date_create($row['date']), 'M');
                    $day = date_format(date_create($row['date']), 't');
                    $weight = trim($row['weight']);

                    print "<tr>";
                    print '<td>' . $weekday . ' (' . $day . strtoupper($month) . ')' . '</td>';
                    print '<td class="right-align">' . $weight . '</td>';
                    print "</tr>";
                }
            ?>
        </table>
    </body>
</html>