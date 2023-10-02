<!DOCTYPE html>
<html>
<head>
    <title>License Statistics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue; 
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff; /* White */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: #333333; /* Dark Gray */
            font-size: 32px;
            text-align: center;
        }

        form {
            text-align: center;
        }

        label {
            font-size: 18px;
            color: #444444; /* Gray */
            margin-right: 10px;
        }

        select {
            font-size: 16px;
            padding: 8px 12px;
            border: 1px solid #dddddd; /* Light Gray */
            border-radius: 5px;
        }

        #submit-button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #2980b9; /* Blue */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #submit-button:hover {
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
        <a href="usageSoftware.php"><b><span>&#8592;</span> Software Interaction Timeline</b></a>
        <a href="featureDuration.php"><b>Day-to-Day Capabality Analysis <span>&#8594;</span></b></a>
    </div>
    <div class="container">
        <h1>License Statistics</h1>
        <form method="post">
            <label for="dropdown">Parameter:</label>
            <select id="dropdown" name="sopt">
                <option value="User">User</option>
                <option value="Feature">Feature</option>
            </select><br><br>
            <input id="submit-button" type="submit" value="Submit">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedOption = $_POST["sopt"];
        if ($selectedOption == "User") {
            header("Location: activeUsers.php");
            exit;
        } elseif ($selectedOption == "Feature") {
            header("Location: activeFeatures.php");
            exit;
        }
    }
    ?>
</body>
</html>
