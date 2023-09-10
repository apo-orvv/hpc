<!DOCTYPE html>
<html>
<head>
    <title>Usage Chronicle</title>
    <style>

        .container {
            text-align: center;
            background-color: #ffffff; 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        h1 {
            margin-bottom: 20px;
            color: #333333; 
            font-size: 36px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .options {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }

        .option {
            margin-top: 15px;
            padding: 12px 25px;
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .option:hover {
            background-color: #c0392b; 
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Usage Chronicle</h1>
        <div class="options">
            <a class="option" href="view/activity.php">View Activity</a>
            <a class="option" href="view/usageSoftware.php">Software Interaction Timeline</a>
            <a class="option" href="view/featureDuration.php">Day-to-Day Capability Analysis</a>
        </div>
    </div>
</body>
</html>
