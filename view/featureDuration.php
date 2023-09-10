<!DOCTYPE html>
<html>
<head>
    <title>Feature Duration</title>
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
        <a href="usageSoftware.php"><b><span>&#8592;</span> Software Interaction Timeline</b></a>
    </div>
    <div class="container">
    <h1>Feature Duration Analysis</h1>
    <form method="post" action="featureAnalysis.php">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date"><br><br>
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date"><br><br>
        
        <label>Choose Feature(s):</label><br>
        <input type="checkbox" id="feature_cadimport" name="features[]" value="CADIMPORT">
        <label for="feature_cadimport">CADIMPORT</label><br>
        
        <input type="checkbox" id="feature_cadimportuser" name="features[]" value="CADIMPORTUSER">
        <label for="feature_cadimportuser">CADIMPORTUSER</label><br>
        
        <!-- Include checkboxes for other features -->
        <input type="checkbox" id="feature_acdc" name="features[]" value="ACDC">
        <label for="feature_acdc">ACDC</label><br>
        
        <input type="checkbox" id="feature_cfd" name="features[]" value="CFD">
        <label for="feature_cfd">CFD</label><br>
        
        <input type="checkbox" id="feature_comsol" name="features[]" value="COMSOL">
        <label for="feature_comsol">COMSOL</label><br>
        
        <input type="checkbox" id="feature_comsolgui" name="features[]" value="COMSOLGUI">
        <label for="feature_comsolgui">COMSOLGUI</label><br>
        
        <input type="checkbox" id="feature_comsoluser" name="features[]" value="COMSOLUSER">
        <label for="feature_comsoluser">COMSOLUSER</label><br>
        
        <input type="checkbox" id="feature_structuralmechanics" name="features[]" value="STRUCTURALMECHANICS">
        <label for="feature_structuralmechanics">STRUCTURALMECHANICS</label><br>
        
        <input type="checkbox" id="feature_matlib" name="features[]" value="MATLIB">
        <label for="feature_matlib">MATLIB</label><br>
        
        <input type="checkbox" id="feature_abaqus" name="features[]" value="abaqus">
        <label for="feature_abaqus">abaqus</label><br>
        
        <input type="checkbox" id="feature_parallel" name="features[]" value="parallel">
        <label for="feature_parallel">parallel</label><br>
        
        <input type="checkbox" id="feature_standard" name="features[]" value="standard">
        <label for="feature_standard">standard</label><br>
        
        <br>
        <input type="submit" value="Submit">
    </form>
    </div>
</body>
</html>
