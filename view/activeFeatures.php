<!DOCTYPE html>
<html>
<head>
    <title>Active Features</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f7fb; /* Light Blue */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* White */
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333333; /* Dark Gray */
            font-size: 24px;
            margin-top: 20px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            color: #444444; /* Gray */
            margin-right: 10px;
        }

        input[type="date"] {
            font-size: 16px;
            padding: 8px 12px;
            border: 1px solid #dddddd; /* Light Gray */
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #2980b9; /* Blue */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2471a3; /* Darker Blue */
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dddddd; /* Light Gray */
        }

        th {
            background-color: #3498db; /* Blue */
            color: white;
        }
    </style>
</head>
<body>
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
</body>
</html>
