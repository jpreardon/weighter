<?php
    require_once 'functions.php';
    authorize($username, $password);
    page_top();
?>
        <a href="add-weight.php">Add Weight</a>
        <p>Previously</p>
        <table>
            <tr>
                <th>Date</th>
                <th class="right-align">Weight</th>
            </tr>
            <?php
                /* Connect to a MySQL database using driver invocation */
                $dbh = new PDO($dbdsn, $dbusername, $dbpassword);
            
                /* Grab some data */
                $dbquery = 'SELECT id, date, weight FROM weights ORDER BY date DESC LIMIT 8';

                $num_rows = 0;
                $total_weight = 0;

                foreach ($dbh->query($dbquery) as $row) {
                    $id = $row['id'];
                    $weekday = date_format(date_create($row['date']), 'l');
                    $month = date_format(date_create($row['date']), 'M');
                    $day = date_format(date_create($row['date']), 'd');
                    $weight = trim($row['weight']);

                    // TODO - This average business should really come from the database
                    // Variables to calculate average
                    $num_rows++;
                    $total_weight += $weight;

                    print "<tr>";
                    print '<td>' . $weekday . ' (' . $day . strtoupper($month) . ')' . '</td>';
                    print '<td class="right-align">' . '<a href="edit-weight.php?id=' . $id . '">' . $weight . '</a></td>';
                    print "</tr>";
                }

                $dbh = null;
            ?>
        </table>

        <p>Average: <strong><?php print round($total_weight/$num_rows, 2); ?></strong></p>

<?php
    page_bottom();
?>