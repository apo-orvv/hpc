<?php
include('view/header.php');
include('view/lmenu.php');
?>

<title>Active Features</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link type="text/css" href="view/menu.css" rel="stylesheet" />
<link type="text/css" href="view/style.css" rel="stylesheet" />
<div class="container">
    <h2>Select a Date:</h2>
    <form action="" method="post">
        <input type="date" name="selected_date" required>
        <input type="submit" value="Show Data">
    </form>

    <?php
    $selectedDate = '';
    $features = array();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedDate = $_POST['selected_date'];

        // Connection parameters
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'test';

        $connection = mysqli_connect($host, $user, $password, $database);
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT DISTINCT feature FROM licenseusershistory WHERE DATE(timeofmon) = '$selectedDate'";

        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $features[] = $row['feature'];
        }

        mysqli_close($connection);
    }
    ?>

    <h2>Active Features on <?php echo $selectedDate; ?>:</h2>
    <table id="featuresTable" class="display">
        <thead>
            <tr>
                <th>Feature</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($features as $feature) {
                echo "<tr><td>$feature</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#featuresTable').DataTable();
        });
    </script>
</div>