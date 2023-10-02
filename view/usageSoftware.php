<!DOCTYPE html>
<html>
<head>
    <title>Usage Statistics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: lightblue; /* Light Blue */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* White */
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333; /* Dark Gray */
            font-size: 30px;
            margin-bottom: 20px;
        }

        form {
            margin-top: 10px;
        }

        label {
            font-size: 18px;
            color: #444444; /* Gray */
            display: block;
            margin-top: 15px;
        }

        input[type="date"], select {
            font-size: 16px;
            padding: 8px 12px;
            border: 1px solid #dddddd; /* Light Gray */
            border-radius: 5px;
            width: 100%;
            margin-top: 5px;
            box-sizing: border-box; /* Adjust box sizing to include padding */
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
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #2471a3; /* Darker Blue */
        }
        .top-buttons {
            display: flex;
            justify-content: space-between;
            width: 100%; 
            position: absolute; 
            top: 0; 
            padding: 20px; 
            box-sizing: border-box; 
        }

        .top-buttons a {
            background-color: #FFED9B;
            color: black;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .top-buttons a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <!-- Top buttons -->
    <div class="top-buttons">
        <a href="activity.php"><b><span>&#8592;</span> View Activity</b></a>
        <a href="featureDuration.php"><b>Day-to-Day Capabality Analysis <span>&#8594;</span></b></a>
    </div>
    <div class="container">
        <h1>Usage Statistics</h1>
        <form method="post">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">
            
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">
            
            <label for="software_type">Software Type:</label>
            <select id="software_type" name="software_type">
                <option value="Abaqus">Abaqus</option>
                <option value="COMSOL">COMSOL</option>
            </select>
            
            <label for="distribution_type">Distribution Type:</label>
            <select id="distribution_type" name="distribution_type">
                <option value="User">User</option>
                <option value="Machine">Machine</option>
            </select>
            
            <input type="submit" value="Submit">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $startDate = $_POST["start_date"];
        $endDate = $_POST["end_date"];
        $softwareType = $_POST["software_type"];
        $distributionType = $_POST["distribution_type"];
        
        if ($distributionType == "User") {
            header("Location: usageUser.php?start_date=$startDate&end_date=$endDate&software_type=$softwareType");
            exit;
        } elseif ($distributionType == "Machine") {
            header("Location: usageMachine.php?start_date=$startDate&end_date=$endDate&software_type=$softwareType");
            exit;
        }
    }
    ?>
</body>
</html>
