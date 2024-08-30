<?php
    require_once 'functions.php';
    authorize();
    page_top();

    /* Connect to a MySQL database using driver invocation */
    $dbh = new PDO(DBDSN, DBUSERNAME, DBPASSWORD);

    // Get the dates
    if (array_key_exists('toDate', $_GET) && array_key_exists('fromDate', $_GET)) {
        // If they exist in the URL, use them
        $toDate = date_create($_GET['toDate']);
        $fromDate = date_create($_GET['fromDate']);
    } else {
        // If they don't default to the last year
        $toDate = date_create();
        $fromDate = date_create();
        date_sub($fromDate, date_interval_create_from_date_string("1 year"));
    }

    /* Grab the data */
    $dbquery = 'SELECT date, weight FROM weights WHERE date >= :fromDate AND date <= :toDate ORDER BY date';

    $sth = $dbh->prepare($dbquery);
    $sth->execute(['fromDate' => $fromDate->format('Y-m-d'), 'toDate' => $toDate->format('Y-m-d')]);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    $dbh = null;

?>

<a href="index.php">Home</a>

<div id="myplot"></div>

<script src="https://cdn.jsdelivr.net/npm/d3@7"></script>
<script src="https://cdn.jsdelivr.net/npm/@observablehq/plot@0.6"></script>
<script>

    // JSON_NUMERIC_CHECK is important here, otherwise the weights are strings
    var weights = <?php echo json_encode($result, JSON_NUMERIC_CHECK); ?>;

    // Coerce date strings to specific type per https://observablehq.com/plot/features/scales
    weights.forEach(element => element.date = new Date(element.date));

    const lineColor = "#4775de";
    const dotFillColor = "silver";
    const dotStrokeColor = "#4775de";

    const plot = Plot.plot({
        x: { label: "Date" },
        y: { grid: true, label: "Weight" },
        color: {},
        title: "Weight History",
        width: window.innerWidth,
        marks: [
            Plot.lineY(weights, {
                x: "date",
                y: "weight",
                stroke: lineColor
            })
        ]
    })
        
    const div = document.querySelector("#myplot");
    div.append(plot);
</script>

<form>
    <label for="fromDate">From Date</label>
    <input id="fromDate" name= "fromDate" type="date" value="<?php echo $fromDate->format('Y-m-d'); ?>" />
    <label for="toDate">To Date</label>
    <input id="toDate" name= "toDate" type="date" value="<?php echo $toDate->format('Y-m-d'); ?>" />
    <input type="submit" value="Update" />
</form>

<?php
    page_bottom();
?>